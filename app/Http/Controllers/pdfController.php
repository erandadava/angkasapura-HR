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
    public function make_pdf($tabel,Request $request){
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $tabel = \Crypt::decrypt($tabel);
        $isinya = [];
        setlocale(LC_TIME, 'id');
        \Carbon\Carbon::setLocale('id');
        switch ($tabel) {
            case 'karyawan_os':
                $user = Auth::user();
                $roles = $user->getRoleNames();
                if($roles[0] == "Vendor"){
                    $id_vendor = \App\Models\vendor_os::where('email','=',$user->email)->first();
                    $get = \App\Models\karyawan_os::with(['fungsi','unitkerja'])->where('id_vendor','=',$id_vendor->id)->get();
                }else{
                    $get = \App\Models\karyawan_os::with(['fungsi','unitkerja'])->get();
                }
                $head = ['Nama', 'Fungsi', 'Unit Kerja', 'Tanggal Lahir', 'Usia', 'Jenis Kelamin', 'Penempatan'];
                $title = 'Karyawan Outsourcing';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => $value['nama'],
                        1 => $value['fungsi']['nama_fungsi'],
                        2 => $value['unitkerja']['nama_uk'],
                        3 => \Carbon\Carbon::parse($value['tgl_lahir'])->formatLocalized('%d %B %Y'),
                        4 => $value['usia'],
                        5 => $value['gender'],
                        6 => $value['penempatan']
                    ];   
                }
                break; 
                case 'karyawan':
                $get = \App\Models\karyawan::with(['klsjabatan','jabatan','unitkerja'])->get();
                $head = ['NIK','Nama', 'Jabatan', 'Unit Kerja', 'Kelas Jabatan', 'Gender', 'Tanggal Lahir'];
                $title = 'Karyawan';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => $value['nik'],
                        1 => $value['nama'],
                        2 => $value['jabatan']['nama_jabatan'],
                        3 => $value['unitkerja']['nama_uk'],
                        4 => $value['klsjabatan']['nama_kj'],
                        5 => $value['gender'],
                        6 => \Carbon\Carbon::parse($value['tgl_lahir'])->formatLocalized('%d %B %Y'),
                    ];   
                }
            break; 
            case 'formasi':
                if($request->f && $request->key){
                    if($request->key=="asc"){
                        if($request->s){
                            if($request->dari && $request->sampai){
                                $dari = $request->dari;
                                $sampai = $request->sampai;
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->whereBetween('tmt_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->orWhere('nama_uk','LIKE','%'.$request->s.'%')->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount('karyawan')->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->orWhere('nama_uk','LIKE','%'.$request->s.'%')->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                            
                        }else{
                            if($request->dari && $request->sampai){
                                $dari = $request->dari;
                                $sampai = $request->sampai;
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->whereBetween('tmt_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount('karyawan')->with('kategori_unit_kerja')->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                            
                        }
                    }else{
                        if($request->s){
                            if($request->dari && $request->sampai){
                                $dari = $request->dari;
                                $sampai = $request->sampai;
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->whereBetween('tmt_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->orWhere('nama_uk','LIKE','%'.$request->s.'%')->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->orderByDesc('tblkategoriunitkerja.nama_kategori_uk', 'DESC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount('karyawan')->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->orWhere('nama_uk','LIKE','%'.$request->s.'%')->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->orderByDesc('tblkategoriunitkerja.nama_kategori_uk', 'DESC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                            
                        }else{
                            if($request->dari && $request->sampai){
                                $dari = $request->dari;
                                $sampai = $request->sampai;
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->whereBetween('tmt_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->orderBy('tblunitkerja.id', 'ASC')->get()->sortByDesc(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount('karyawan')->with('kategori_unit_kerja')->orderBy('tblunitkerja.id', 'ASC')->get()->sortByDesc(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                        }
                    }
                }elseif($request->s){
                    if($request->dari && $request->sampai){
                        $dari = $request->dari;
                        $sampai = $request->sampai;
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                            $query->whereBetween('tmt_date', [$dari, $sampai]);
                        }])->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                            $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                       })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->orWhere('nama_uk','LIKE','%'.$request->s.'%')->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->orderBy('tblunitkerja.id', 'ASC')->get();
                    }else{
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount('karyawan')->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                            $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                       })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->orWhere('nama_uk','LIKE','%'.$request->s.'%')->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->orderBy('tblunitkerja.id', 'ASC')->get();
                    }
                    
                }else{
                    if($request->dari && $request->sampai){
                        $dari = $request->dari;
                        $sampai = $request->sampai;
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->with('kategori_unit_kerja')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                            $query->whereBetween('tmt_date', [$dari, $sampai]);
                        }])->orderBy('tblunitkerja.id', 'ASC')->get();
                    }else{
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->with('kategori_unit_kerja')->withCount('karyawan')->orderBy('tblunitkerja.id', 'ASC')->get();
                    }
                    
                }

                $head = ['Unit Kerja','Formasi', 'Eksis', 'Lowong', 'Kekuatan SDM','Pejabat','Karyawan','PKWT','KMPG','Total Eksis'];
                
                $title = 'Laporan Kekuatan SDM KCU BSH';
                $group = [];
                foreach ($get as $key => $value) {
                    $id_pkwt = \App\Models\klsjabatan::where('nama_kj','=','PKWT')->first();
                    if($request->dari && $request->sampai){
                        $dari = $request->dari;
                        $sampai = $request->sampai;
                        $pkwt = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_pkwt,$dari, $sampai){
                            $q->where('id_klsjabatan', $id_pkwt->id)->whereBetween('tmt_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $pkwt = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_pkwt){
                            $q->where('id_klsjabatan', $id_pkwt->id);
                        }])->first();
                    }
                    

                    $id_19 = \App\Models\klsjabatan::where('nama_kj','=','19')->first();
                    $id_20 = \App\Models\klsjabatan::where('nama_kj','=','20')->first();
                    $id_21 = \App\Models\klsjabatan::where('nama_kj','=','21')->first();
                    $id_pkwt = \App\Models\klsjabatan::where('nama_kj','=','PKWT')->first();
                    $id_kmpg = \App\Models\klsjabatan::where('nama_kj','=','KMPG')->first();
                    if($request->dari && $request->sampai){
                        $dari = $request->dari;
                        $sampai = $request->sampai;
                        $karyawan = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_19,$id_20,$id_21,$id_pkwt,$id_kmpg,$dari, $sampai){
                            $q->where([['id_klsjabatan','!=', $id_19->id??null],['id_klsjabatan','!=', $id_20->id??null],['id_klsjabatan','!=', $id_21->id??null],['id_klsjabatan','!=', $id_pkwt->id??null],['id_klsjabatan','!=', $id_kmpg->id??null]])->whereBetween('tmt_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $karyawan = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_19,$id_20,$id_21,$id_pkwt,$id_kmpg){
                            $q->where([['id_klsjabatan','!=', $id_19->id??null],['id_klsjabatan','!=', $id_20->id??null],['id_klsjabatan','!=', $id_21->id??null],['id_klsjabatan','!=', $id_pkwt->id??null],['id_klsjabatan','!=', $id_kmpg->id??null]]);
                        }])->first();
                    }
                    

                    $id_kmpg = \App\Models\klsjabatan::where('nama_kj','=','KMPG')->first();
                    if($request->dari && $request->sampai){
                        $dari = $request->dari;
                        $sampai = $request->sampai;
                        $kmpg = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_kmpg,$dari, $sampai){
                            $q->where('id_klsjabatan', $id_kmpg->id)->whereBetween('tmt_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $kmpg = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_kmpg){
                            $q->where('id_klsjabatan', $id_kmpg->id);
                        }])->first();
                    }
                    
                    if($request->dari && $request->sampai){
                        $dari = $request->dari;
                        $sampai = $request->sampai;
                        $pejabat = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_19,$id_20,$id_21,$dari, $sampai){
                            $q->where('id_klsjabatan', $id_19->id??null)->whereBetween('tmt_date', [$dari, $sampai])->orWhere('id_klsjabatan', $id_20->id??null)->orWhere('id_klsjabatan', $id_21->id??null);
                        }])->first();
                    }else{
                        $pejabat = \App\Models\unitkerja::where('id','=',$value->id)->with(['karyawan' => function($q) use($id_19,$id_20,$id_21){
                            $q->where('id_klsjabatan', $id_19->id??null)->orWhere('id_klsjabatan', $id_20->id??null)->orWhere('id_klsjabatan', $id_21->id??null);
                        }])->first();
                    }
                    

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
                $tabel = 'laporan_kekuatan_SDM KCU BSH';
                $pdf = PDF::loadview('pdf.index_formasi',['head'=>$head,'title'=>$title,'value'=>$values,'group'=>$group])->setPaper('a4', 'landscape');
                // return $pdf->download($tabel.time().'.pdf');
                return $pdf->stream($tabel.time().'.pdf', array("Attachment" => false));
            break; 
            case 'mpp':
                $get = \App\Models\karyawan::with(['jabatan','unit','fungsi','unitkerja','klsjabatan'])->get();
                $head = ['NIK','Nama','Jabatan','Unit Kerja','Rencana MPP','Fungsi', 'Status Pensiun', 'Status MPP'];
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
                        0 => $value['nik'],
                        1 => $value['nama'],
                        2 => $value['jabatan']['nama_jabatan'],
                        3 => $value['unitkerja']['nama_uk'],
                        4 => \Carbon\Carbon::parse($value['rencana_mpp'])->formatLocalized('%d %B %Y'),
                        5 => $value['fungsi']['nama_fungsi'],
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
