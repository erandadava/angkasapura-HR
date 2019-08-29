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
                    $get = \App\Models\karyawan_os::with(['fungsi','unitkerja','vendor'])->where('id_vendor','=',$id_vendor->id)->get();
                }else{
                    $get = \App\Models\karyawan_os::with(['fungsi','unitkerja','vendor'])->get();
                }
                $head = ['Nama', 'Fungsi', 'Unit Kerja', 'Tanggal Lahir',  'Jenis Kelamin', 'Nama Vendor'];
                $title = 'Karyawan Outsourcing';
                foreach ($get as $key => $value) {
                    $isinya[$key]=[
                        0 => $value['nama'],
                        1 => $value['fungsi']['nama_fungsi'],
                        2 => $value['unitkerja']['nama_uk'],
                        3 => \Carbon\Carbon::parse($value['tgl_lahir'])->formatLocalized('%d %B %Y'),
                        4 => $value['gender'],
                        5 => $value['vendor']['nama_vendor']
                    ];   
                }
                break; 
                case 'karyawan':
                $get = \App\Models\karyawan::with(['klsjabatan','jabatan','unitkerja'])->get();
                $head = ['NIK','Nama', 'Jabatan', 'Unit Kerja', 'Kelas Jabatan', 'Gender', 'Tanggal Lahir'];
                $title = 'Karyawan';
                foreach ($get as $key => $value) {
                    $cek_log = $this->check_log($value['id']);
                    if($cek_log != null){
                        $value['jabatan']['nama_jabatan'] = $cek_log['jabatan']['nama_jabatan'];
                        $value['unitkerja']['nama_uk']= $cek_log['unitkerja']['nama_uk'];
                        $value['klsjabatan']['nama_kj'] = $cek_log['klsjabatan']['nama_kj'];
                        $value['pend_akhir']= $cek_log['pend_akhir'];
                        $value['gender']= $cek_log['gender'];
                        $value['tgl_lahir']= $cek_log['tgl_lahir'];
                    }
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
                $myString = $request->export_id;
                $arr_export = explode(',', $myString);
                if($request->f && $request->key){
                    if($request->key=="asc"){
                        if($request->s){
                            if($request->dari && $request->sampai){
                                $dari = new Carbon($request->dari);
                                $sampai = new Carbon($request->sampai);
                                $sampai = $sampai->endOfMonth();
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                                    return $query->whereBetween('update_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('nama_uk','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query){
                                    $query->doesnthave('log_karyawan');
                                }])->withCount('log_karyawan')->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('nama_uk','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                            
                        }else{
                            if($request->dari && $request->sampai){
                                $dari = new Carbon($request->dari);
                                $sampai = new Carbon($request->sampai);
                                $sampai = $sampai->endOfMonth();
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                                    return $query->whereBetween('update_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query){
                                    $query->doesnthave('log_karyawan');
                                }])->withCount('log_karyawan')->with('kategori_unit_kerja')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                            
                        }
                    }else{
                        if($request->s){
                            if($request->dari && $request->sampai){
                                $dari = new Carbon($request->dari);
                                $sampai = new Carbon($request->sampai);
                                $sampai = $sampai->endOfMonth();
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                                    return $query->whereBetween('update_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('nama_uk','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orderByDesc('tblkategoriunitkerja.nama_kategori_uk', 'DESC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query){
                                    $query->doesnthave('log_karyawan');
                                }])->withCount('log_karyawan')->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                                    $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                                })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('nama_uk','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orderByDesc('tblkategoriunitkerja.nama_kategori_uk', 'DESC')->get()->sortBy(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                            
                        }else{
                            if($request->dari && $request->sampai){
                                $dari = new Carbon($request->dari);
                                $sampai = new Carbon($request->sampai);
                                $sampai = $sampai->endOfMonth();
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                                    $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                                    return $query->whereBetween('update_date', [$dari, $sampai]);
                                }])->with('kategori_unit_kerja')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get()->sortByDesc(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }else{
                                $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query){
                                    $query->doesnthave('log_karyawan');
                                }])->withCount('log_karyawan')->with('kategori_unit_kerja')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get()->sortByDesc(function ($product, $key) use($request){
                                    return $product[$request->f];
                                });
                            }
                        }
                    }
                }elseif($request->s){
                    if($request->dari && $request->sampai){
                        $dari = new Carbon($request->dari);
                        $sampai = new Carbon($request->sampai);
                        $sampai = $sampai->endOfMonth();
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                            $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                        }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                            return $query->whereBetween('update_date', [$dari, $sampai]);
                        }])->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                            $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                       })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('nama_uk','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get();
                    }else{
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->withCount(['karyawan' => function($query){
                            $query->doesnthave('log_karyawan');
                        }])->withCount('log_karyawan')->with('kategori_unit_kerja')->whereHas('kategori_unit_kerja', function ($query) USE($request) {
                            $query->where('nama_kategori_uk', 'LIKE', '%'.$request->s.'%');
                       })->where('tblunitkerja.id','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('nama_uk','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orWhere('jml_formasi','LIKE','%'.$request->s.'%')->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get();
                    }
                    
                }else{
                    if($request->dari && $request->sampai){
                        $dari = new Carbon($request->dari);
                        $sampai = new Carbon($request->sampai);
                        $sampai = $sampai->endOfMonth();
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->with('kategori_unit_kerja')->withCount(['karyawan' => function($query) use ($dari, $sampai){
                            $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                        }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                            return $query->whereBetween('update_date', [$dari, $sampai]);
                        }])->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get();
                    }else{
                        $get = \App\Models\unitkerja::leftjoin('tblkategoriunitkerja', 'tblunitkerja.id_kategori_unit_kerja_fk', '=', 'tblkategoriunitkerja.id')->with('kategori_unit_kerja')->withCount(['karyawan' => function($query){
                            $query->doesnthave('log_karyawan');
                        }])->withCount('log_karyawan')->with(['kategori_unit_kerja'])->whereIn('tblunitkerja.id',$arr_export)->orderBy('tblunitkerja.id', 'ASC')->get();
                    }
                    
                }

                $head = ['Unit Kerja','Formasi', 'Eksis', 'Lowong', 'Kekuatan SDM','Pejabat','Karyawan','PKWT','KMPG','Total Eksis'];
                
                $title = 'Laporan Kekuatan SDM KCU BSH';
                $group = [];
                $hasil_lowong = 0;
                $hasil_kekuatan = 0;
                $hasil_pejabat = 0;
                $hasil_karyawan = 0;
                $hasil_pkwt = 0;
                $hasil_kmpg = 0;
                $hasil_total_eksis_kanan = 0;
                foreach ($get as $key => $value) {
                    $id_pkwt = \App\Models\tipekar::where('nama_tipekar','LIKE','%PKWT%')->first();
                    if($request->dari && $request->sampai){
                        $dari = new Carbon($request->dari);
                        $sampai = new Carbon($request->sampai);
                        $sampai = $sampai->endOfMonth();
                        $pkwt_entry_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($q) use($id_pkwt,$dari, $sampai){
                            $q->doesnthave('log_karyawan')->where('id_tipe_kar', $id_pkwt->id)->whereBetween('entry_date', [$dari, $sampai]);
                        }])->first();
                        $pkwt_update_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['log_karyawan' => function($q) use($id_pkwt,$dari, $sampai){
                            $q->where('id_tipe_kar', $id_pkwt->id)->whereBetween('update_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $pkwt = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($query) use ($id_pkwt){
                            $query->doesnthave('log_karyawan')->where('id_tipe_kar', $id_pkwt->id);
                        }])->withCount(['log_karyawan' => function($query) use ($id_pkwt){
                            return $query->where('id_tipe_kar', $id_pkwt->id);
                        }])->first();
                    }
                    

                    $non_pejabat = \App\Models\tipekar::where('nama_tipekar','LIKE','%Non Pejabat%')->first();
                    if($request->dari && $request->sampai){
                        $dari = new Carbon($request->dari);
                        $sampai = new Carbon($request->sampai);
                        $sampai = $sampai->endOfMonth();
                        $karyawan_entry_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($q) use($non_pejabat,$dari, $sampai){
                            $q->doesnthave('log_karyawan')->where('id_tipe_kar', $non_pejabat->id)->whereBetween('entry_date', [$dari, $sampai]);
                        }])->first();
                        $karyawan_update_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['log_karyawan' => function($q) use($non_pejabat,$dari, $sampai){
                            $q->where('id_tipe_kar', $non_pejabat->id)->whereBetween('update_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $karyawan = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($query) use ($non_pejabat){
                            $query->doesnthave('log_karyawan')->where('id_tipe_kar', $non_pejabat->id);
                        }])->withCount(['log_karyawan' => function($query) use ($non_pejabat){
                            return $query->where('id_tipe_kar', $non_pejabat->id);
                        }])->first();
                    }
                    

                    $id_kmpg = \App\Models\tipekar::where('nama_tipekar','LIKE','%KMPG%')->first();
                    if($request->dari && $request->sampai){
                        $dari = new Carbon($request->dari);
                        $sampai = new Carbon($request->sampai);
                        $sampai = $sampai->endOfMonth();
                        $kmpg_entry_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($q) use($id_kmpg,$dari, $sampai){
                            $q->doesnthave('log_karyawan')->where('id_tipe_kar', $id_kmpg->id)->whereBetween('entry_date', [$dari, $sampai]);
                        }])->first();
                        $kmpg_update_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['log_karyawan' => function($q) use($id_kmpg,$dari, $sampai){
                            $q->where('id_tipe_kar', $id_kmpg->id)->whereBetween('update_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $kmpg = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($query) use ($id_kmpg){
                            $query->doesnthave('log_karyawan')->where('id_tipe_kar', $id_kmpg->id);
                        }])->withCount(['log_karyawan' => function($query) use ($id_kmpg){
                            return $query->where('id_tipe_kar', $id_kmpg->id);
                        }])->first();
                    }
                    
                    $id_pejabat = \App\Models\tipekar::where('nama_tipekar','LIKE','%Pejabat%')->first();
                    if($request->dari && $request->sampai){
                        $dari = new Carbon($request->dari);
                        $sampai = new Carbon($request->sampai);
                        $sampai = $sampai->endOfMonth();
                        $pejabat_entry_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($q) use($id_pejabat,$dari, $sampai){
                            $q->doesnthave('log_karyawan')->where('id_tipe_kar', $id_pejabat->id)->whereBetween('entry_date', [$dari, $sampai]);
                        }])->first();
                        $pejabat_update_date = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['log_karyawan' => function($q) use($id_pejabat,$dari, $sampai){
                            $q->where('id_tipe_kar', $id_pejabat->id)->whereBetween('update_date', [$dari, $sampai]);
                        }])->first();
                    }else{
                        $pejabat = \App\Models\unitkerja::where('id','=',$value->id)->withCount(['karyawan' => function($query) use ($id_pejabat){
                            $query->doesnthave('log_karyawan')->where('id_tipe_kar', $id_pejabat->id);
                        }])->withCount(['log_karyawan' => function($query) use ($id_pejabat){
                            return $query->where('id_tipe_kar', $id_pejabat->id);
                        }])->first();
                    }
                    
                    
                    $lowong = (int) $value->jml_formasi - ((int) $value->karyawan_count + $value->log_karyawan_count);
                    $hasil_lowong += $lowong;
                    $kekuatan = round((((int) $value->karyawan_count + $value->log_karyawan_count) / (int) $value->jml_formasi)*100)."%";
                    $hasil_kekuatan += (int)$kekuatan;
                    if($request->dari && $request->sampai){  
                        $hasil_pejabat += $pejabat_entry_date->karyawan_count + $pejabat_update_date->log_karyawan_count;
                        $hasil_karyawan += $karyawan_entry_date->karyawan_count + $karyawan_update_date->log_karyawan_count;
                        $hasil_pkwt += $pkwt_entry_date->karyawan_count + $pkwt_update_date->log_karyawan_count;
                        $hasil_kmpg += $kmpg_entry_date->karyawan_count + $kmpg_update_date->log_karyawan_count;
                        $hasil_total_eksis_kanan += $pkwt_entry_date->karyawan_count + $pkwt_update_date->log_karyawan_count + $kmpg_entry_date->karyawan_count + $kmpg_update_date->log_karyawan_count + $karyawan_entry_date->karyawan_count + $karyawan_update_date->log_karyawan_count + $pejabat_entry_date->karyawan_count + $pejabat_update_date->log_karyawan_count;
                        $isinya[$key]=[
                            0 => $value['nama_uk'],
                            1 => $value['jml_formasi'],
                            2 => (int) $value['karyawan_count'] + (int) $value['log_karyawan_count'],
                            3 => $lowong,
                            4 => $kekuatan,
                            5 => $pejabat_entry_date->karyawan_count + $pejabat_update_date->log_karyawan_count,
                            6 => $karyawan_entry_date->karyawan_count + $karyawan_update_date->log_karyawan_count,
                            7 => $pkwt_entry_date->karyawan_count + $pkwt_update_date->log_karyawan_count,
                            8 => $kmpg_entry_date->karyawan_count + $kmpg_update_date->log_karyawan_count,
                            9 => $pkwt_entry_date->karyawan_count + $pkwt_update_date->log_karyawan_count + $kmpg_entry_date->karyawan_count + $kmpg_update_date->log_karyawan_count + $karyawan_entry_date->karyawan_count + $karyawan_update_date->log_karyawan_count + $pejabat_entry_date->karyawan_count + $pejabat_update_date->log_karyawan_count,
                        ];
                    }else{
                        $hasil_pejabat += $pejabat->karyawan_count + $pejabat->log_karyawan_count;
                        $hasil_karyawan += $karyawan->karyawan_count + $karyawan->log_karyawan_count;
                        $hasil_pkwt += $pkwt->karyawan_count + $pkwt->log_karyawan_count;
                        $hasil_kmpg += $kmpg->karyawan_count + $kmpg->log_karyawan_count;
                        $hasil_total_eksis_kanan += $pkwt->karyawan_count + $pkwt->log_karyawan_count + $karyawan->karyawan_count + $karyawan->log_karyawan_count + $kmpg->karyawan_count + $kmpg->log_karyawan_count + $pejabat->karyawan_count + $pejabat->log_karyawan_count;
                        $isinya[$key]=[
                            0 => $value['nama_uk'],
                            1 => $value['jml_formasi'],
                            2 => (int) $value['karyawan_count'] + (int) $value['log_karyawan_count'],
                            3 => $lowong,
                            4 => $kekuatan,
                            5 => $pejabat->karyawan_count + $pejabat->log_karyawan_count,
                            6 => $karyawan->karyawan_count + $karyawan->log_karyawan_count,
                            7 => $pkwt->karyawan_count + $pkwt->log_karyawan_count,
                            8 => $kmpg->karyawan_count + $kmpg->log_karyawan_count,
                            9 => $pkwt->karyawan_count + $pkwt->log_karyawan_count + $karyawan->karyawan_count + $karyawan->log_karyawan_count + $kmpg->karyawan_count + $kmpg->log_karyawan_count + $pejabat->karyawan_count + $pejabat->log_karyawan_count,
                        ];  
                    }
                    
                    $group[$key]= [
                        0 => $value['id_kategori_unit_kerja_fk'],
                        1 => $value['kategori_unit_kerja']['nama_kategori_uk']
                    ];

                    
                }
                //Untuk generate total
                $total[0] = "<b>TOTAL</b>";
                $total[1] = "<b>".$get->sum('jml_formasi')."</b>";
                $sum_eksis = 0 ;
                if($get){
                    foreach ($get as $key => $value) {
                        // dd((int) $value['karyawan_count'] + (int) $value['log_karyawan_count']);
                        $sum_eksis += (int) $value['karyawan_count'] + (int) $value['log_karyawan_count'];
                    }
                    
                }
                $total[2] = "<b>".$sum_eksis."</b>";
                $total[3] = "<b>".$hasil_lowong."</b>";
                $total[4] = "<b>".round($hasil_kekuatan).'%'."</b>";
                $total[5] = "<b>".$hasil_pejabat."</b>";
                $total[6] = "<b>".$hasil_karyawan."</b>";
                $total[7] = "<b>".$hasil_pkwt."</b>";
                $total[8] = "<b>".$hasil_kmpg."</b>";
                $total[9] = "<b>".$hasil_total_eksis_kanan."</b>";

                $values = $isinya; 
                $tabel = 'laporan_kekuatan_SDM KCU BSH';
                $pdf = PDF::loadview('pdf.index_formasi',['head'=>$head,'title'=>$title,'value'=>$values,'group'=>$group,'total'=>$total])->setPaper('a4', 'landscape');
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

    public function check_log($id_karyawan){
        $cek = \App\Models\log_karyawan::where('id_karyawan_fk','=',$id_karyawan)->with(['fungsi','jabatan','unitkerja','tipekar','unit','klsjabatan'])->latest('update_date')->first();
        if($cek){
            return $cek;
        }else{
            return null;
        }
    }  
}
