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
                        3 => $value['tgl_lahir'],
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
                        3 => $value['tgl_lahir'],
                        4 => $value['jabatan']['nama_jabatan'],
                        5 => $value['klsjabatan']['nama_kj'],
                        6 => $value['unitkerja']['nama_uk'],
                    ];   
                }
            break; 
            case 'formasi':
                $get = \App\Models\unitkerja::get();
                $head = ['Unit Kerja','Formasi', 'Eksis', 'Lowong', 'Kekuatan SDM'];
                $title = 'Formasi vs Eksisting';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => $value['nama_uk'],
                        1 => $value['jml_formasi'],
                        2 => $value['jml_existing'],
                        3 => $value['lowongan'],
                        4 => $value['kekuatansdm'],
                    ];   
                }
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
                        5 => $value['rencana_mpp'],
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
                        0 => $value['tanggal_pelaporan'],
                        1 => $value['keluhan'],
                        2 => $value['tanggal_penyelesaian'],
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
        return $pdf->download($tabel.time().'.pdf');

    }
}
