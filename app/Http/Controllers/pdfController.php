<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRole;
use Auth;
use Carbon\Carbon;
class pdfController extends Controller
{
    public function make_pdf($tabel){
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $tabel = \Crypt::decrypt($tabel);
        $isinya = [];
        setlocale(LC_TIME, 'id');
        \Carbon\Carbon::setLocale('id');
        switch ($tabel) {
            case 'karyawan_os':
                $get = \App\Models\karyawan_os::with(['fungsi','unitkerja'])->get();
                $head = ['Nama', 'Fungsi', 'Unit Kerja', 'Tanggal Lahir', 'Usia', 'Jenis Kelamin'];
                $title = 'Karyawan Outsourcing';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => $value['nama'],
                        1 => $value['fungsi']['nama_fungsi'],
                        2 => $value['unitkerja']['nama_uk'],
                        3 => \Carbon\Carbon::parse($value['tgl_lahir'])->formatLocalized('%d %B %Y'),
                        4 => $value['usia'],
                        5 => $value['gender'],
                    ];   
                }
                break; 
                case 'karyawan':
                $get = \App\Models\karyawan::with(['klsjabatan','jabatan','unitkerja'])->get();
                $head = ['NIK','Nama', 'Gender', 'Tanggal Lahir', 'Jabatan', 'Kelas Jabatan', 'Unit Kerja'];
                $title = 'Karyawan';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => $value['nik'],
                        1 => $value['nama'],
                        2 => $value['gender'],
                        3 => \Carbon\Carbon::parse($value['tgl_lahir'])->formatLocalized('%d %B %Y'),
                        4 => $value['jabatan']['nama_jabatan'],
                        5 => $value['klsjabatan']['nama_kj'],
                        6 => $value['unitkerja']['nama_uk'],
                    ];   
                }
            break; 
            case 'formasi':
                $get = \App\Models\unitkerja::withCount('karyawan')->with('kategori_unit_kerja')->orderBy('id_kategori_unit_kerja_fk', 'DESC')->get();
                $head = ['Unit Kerja','Formasi', 'Eksis', 'Lowong', 'Kekuatan SDM','Pejabat','Karyawan','PKWT','KMPG','Total Eksis'];
                
                $title = 'Formasi vs Eksisting';
                $group = [];
                foreach ($get as $key => $value) {
                    $id_pkwt = \App\Models\klsjabatan::where('nama_kj','=','PKWT')->first();
                    $pkwt = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_pkwt){
                        $q->where('id_klsjabatan', $id_pkwt->id);
                    }])->first();

                    $id_19 = \App\Models\klsjabatan::where('nama_kj','=','19')->first();
                    $id_20 = \App\Models\klsjabatan::where('nama_kj','=','20')->first();
                    $id_21 = \App\Models\klsjabatan::where('nama_kj','=','21')->first();
                    $id_pkwt = \App\Models\klsjabatan::where('nama_kj','=','PKWT')->first();
                    $id_kmpg = \App\Models\klsjabatan::where('nama_kj','=','KMPG')->first();
                    $karyawan = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_19,$id_20,$id_21,$id_pkwt,$id_kmpg){
                        $q->where([['id_klsjabatan','!=', $id_19->id??null],['id_klsjabatan','!=', $id_20->id??null],['id_klsjabatan','!=', $id_21->id??null],['id_klsjabatan','!=', $id_pkwt->id??null],['id_klsjabatan','!=', $id_kmpg->id??null]]);
                    }])->first();

                    $id_kmpg = \App\Models\klsjabatan::where('nama_kj','=','KMPG')->first();
                    $kmpg = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_kmpg){
                        $q->where('id_klsjabatan', $id_kmpg->id);
                    }])->first();

                    $pejabat = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_19,$id_20,$id_21){
                        $q->where('id_klsjabatan', $id_19->id??null)->orWhere('id_klsjabatan', $id_20->id??null)->orWhere('id_klsjabatan', $id_21->id??null);
                    }])->first();

                    $lowong = (int) $value->jml_formasi - (int) $value->karyawan_count;
                    $kekuatan = round(((int) $value->karyawan_count / (int) $value->jml_formasi)*100)."%";
                    $isinya[$key]=[
                        0 => $value['nama_uk'],
                        1 => $value['jml_formasi'],
                        2 => $value['karyawan_count'],
                        3 => $lowong,
                        4 => $kekuatan,
                        5 => count($pejabat->karyawan),
                        6 => count($karyawan->karyawan),
                        7 => count($pkwt->karyawan),
                        8 => count($kmpg->karyawan),
                        9 => count($pejabat->karyawan)+count($karyawan->karyawan)+count($pkwt->karyawan)+count($kmpg->karyawan),
                    ];  
                    $group[$key]= [
                        0 => $value['id_kategori_unit_kerja_fk'],
                        1 => $value['kategori_unit_kerja']['nama_kategori_uk']
                    ];   
                }

                $values = $isinya; 
                $pdf = PDF::loadview('pdf.index_formasi',['head'=>$head,'title'=>$title,'value'=>$values,'group'=>$group])->setPaper('a4', 'landscape');
                // return $pdf->download($tabel.time().'.pdf');
                return $pdf->stream($tabel.time().'.pdf', array("Attachment" => false));
            break; 
            case 'mpp':
                $get = \App\Models\karyawan::with(['jabatan','unit','fungsi','klsjabatan'])->get();
                $head = ['Unit','Jabatan', 'Fungsi', 'Nama', 'NIK', 'Rencana MPP', 'Status Pensiun', 'Status MPP'];
                $title = 'MPP';
                foreach ($get as $key => $value) {
                    if ($value['Age'] == 0){ $age = 'Belum Masa MPP';}
                    if ($value['Age'] == 1){ $age = "Masa MPP Akan Datang";}
                    if ($value['Age'] == 2){ $age = "Sudah Masa MPP";}
                    if ($value['status_pensiun'] == 'A'){ $pensiun = "Sudah Pensiun";}
                    if ($value['status_pensiun'] == 'R'){ $pensiun = "Pensiun Tidak Diambil";}
                    if ($value['status_pensiun'] == 'M'){ $pensiun = "Menunggu Waktu Aktif Pensiun";}
                    if ($value['status_pensiun'] == 'N'){ $pensiun = "Belum Pensiun";}
                    $isinya[$key]=[
                        0 => $value['unit']['nama_unit'],
                        1 => $value['jabatan']['nama_jabatan'],
                        2 => $value['fungsi']['nama_fungsi'],
                        3 => $value['nama'],
                        4 => $value['nik'],
                        5 => \Carbon\Carbon::parse($value['rencana_mpp'])->formatLocalized('%d %B %Y'),
                        6 => $pensiun,
                        7 => $age,
                    ];   
                }
            break; 
            case 'osperformance':
                $get = \App\Models\Osperformance::get();
                $head = ['Tanggal Pelaporan','Keluhan', 'Tanggal Penyelesaian', 'Hasil'];
                $title = 'OS Performance';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => \Carbon\Carbon::parse($value['tanggal_pelaporan'])->formatLocalized('%d %B %Y'),
                        1 => $value['keluhan'],
                        2 => \Carbon\Carbon::parse($value['tanggal_penyelesaian'])->formatLocalized('%d %B %Y'),
                        3 => $value['hasil'],
                    ];   
                }
            break; 
            default:
                null;
                break;
        }
        $values = $isinya;
        $pdf = PDF::loadview('pdf.index',['head'=>$head,'title'=>$title,'value'=>$values]);
        // return $pdf->download($tabel.time().'.pdf');
        return $pdf->stream($tabel.time().'.pdf', array("Attachment" => false));

    }
}
