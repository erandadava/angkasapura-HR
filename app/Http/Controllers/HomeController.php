<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawan;
use App\Models\fungsi;
use App\Models\fungsi_os;
use App\Models\klsjabatan;
use App\Models\unitkerja;
use DB;
use Carbon\Carbon;
use Flash;
use Auth;
use App\Models\karyawan_os;
use App\Models\vendor_os;
use App\Models\log_karyawan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['data_fungsi'] = fungsi::pluck('nama_fungsi','id');
        $this->data['data_unit_kerja'] = unitkerja::pluck('nama_uk','id');
        $this->data['data_vendor_os'] = vendor_os::where('is_active','=',1)->pluck('nama_vendor','id');
        $this->middleware('auth');
        $karyawan = \DB::table('tblkaryawan')
                  ->where([['tgl_aktif_pensiun', '=' ,\Carbon\Carbon::now()->format('Y-m-d')],['status_pensiun','=','M']])
                  ->get();
        foreach($karyawan as $dt){
            \DB::table('tblkaryawan')
                  ->where('id','=',$dt->id)
                  ->update(['status_pensiun' => 'A']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        
        if($roles[0] == "Vendor"){
            $id_vendor = \App\Models\vendor_os::where('email','=',$user->email)->first();
            if($id_vendor){
                //if all null
                $this->data['jk_laki'] = karyawan_os::select('gender')->where([['gender','=','Laki-laki'],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                $this->data['jk_perempuan'] = karyawan_os::select('gender')->where([['gender','!=','Laki-laki'],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                $this->data['unit_kerja'] = unitkerja::withCount(['karyawan_os' => function ($query) use($id_vendor){
                    $query->where([['id_vendor','=',$id_vendor->id],['is_active','=','A']]);
                }])->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                $this->data['umur_31sd40'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                $this->data['umur_41sd50'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                $this->data['umur_51sd54'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                $this->data['umur_lebihdari55'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();

                //if range tanggal not null and fungsi null
                if($request->dari != null && $request->value_unit == null){
                    $dari = $request->dari;
                    $sampai = $request->sampai;
                    $this->data['dari'] = $request->dari;
                    $this->data['sampai'] = $request->sampai;
                    if($request->dari == null || $request->sampai == null){
                        Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                        return view('home_vendor')->with($this->data);
                    }

                    $this->data['jk_laki'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','=','Laki-laki'],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                    $this->data['jk_perempuan'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','!=','Laki-laki'],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                    $this->data['unit_kerja'] = unitkerja::whereHas('karyawan_os', function($query) use ($dari, $sampai, $id_vendor) {
                        $query->whereBetween('created_at', [$dari, $sampai])->where([['id_vendor','=',$id_vendor->id],['is_active','=','A']]);
                    })->withCount(['karyawan_os' => function ($query) use($dari, $sampai, $id_vendor){
                        $query->whereBetween('created_at', [$dari, $sampai])->where([['id_vendor','=',$id_vendor->id],['is_active','=','A']]);
                    }])->get()->toJson();
                    $this->data['umur_kurangdari30'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_31sd40'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_41sd50'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_51sd54'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_lebihdari55'] = karyawan_os::where([['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    return view('home_vendor')->with($this->data);

                //if range tanggal and fungsi not null
                }elseif($request->dari != null && $request->value_unit != null){
                    $dari = $request->dari;
                    $sampai = $request->sampai;
                    $value_unit = $request->value_unit;
                    $this->data['value_unit'] = $request->value_unit;
                    $this->data['dari'] = $request->dari;
                    $this->data['sampai'] = $request->sampai;
                    if($request->dari == null || $request->sampai == null){
                        Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                        return view('home_vendor')->with($this->data);
                    }
                    $this->data['jk_laki'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','=','Laki-laki'],['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                    $this->data['jk_perempuan'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','!=','Laki-laki'],['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                    $this->data['unit_kerja'] = unitkerja::whereHas('karyawan_os', function($query) use ($dari, $sampai, $value_unit,$id_vendor) {
                        $query->where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('created_at', [$dari, $sampai]);
                    })->withCount(['karyawan_os' => function ($query) use($dari, $sampai, $value_unit,$id_vendor){
                        $query->where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('created_at', [$dari, $sampai]);
                    }])->get()->toJson();
                    $this->data['umur_kurangdari30'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_31sd40'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_41sd50'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_51sd54'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    $this->data['umur_lebihdari55'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    return view('home_vendor')->with($this->data);

                //if tanggal null and fungsi not null
                }elseif($request->dari == null && $request->sampai == null && $request->value_unit != null){
                    $value_unit = $request->value_unit;
                    $this->data['value_unit'] = $request->value_unit;
                    $this->data['jk_laki'] = karyawan_os::select('gender')->where([['gender','=','Laki-laki'],['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                    $this->data['jk_perempuan'] = karyawan_os::select('gender')->where([['gender','!=','Laki-laki'],['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->count();
                    $this->data['unit_kerja'] = unitkerja::whereHas('karyawan_os', function($query) use ($value_unit,$id_vendor) {
                        $query->where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']]);
                    })->withCount(['karyawan_os' => function ($query) use ($value_unit,$id_vendor){
                        $query->where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']]);
                    }])->get()->toJson();
                    $this->data['umur_kurangdari30'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                    $this->data['umur_31sd40'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                    $this->data['umur_41sd50'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                    $this->data['umur_51sd54'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                    $this->data['umur_lebihdari55'] = karyawan_os::where([['id_unitkerja','=',$value_unit],['id_vendor','=',$id_vendor->id],['is_active','=','A']])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();
                return view('home_vendor')->with($this->data);
                }
                return view('home_vendor')->with($this->data);
            }else{
                $this->data['jk_laki'] = null;
                $this->data['jk_perempuan'] = null;
                $this->data['unit_kerja'] = null;
                $this->data['umur_kurangdari30'] = null;
                $this->data['umur_31sd40'] = null;
                $this->data['umur_41sd50'] = null;
                $this->data['umur_51sd54'] = null;
                $this->data['umur_lebihdari55'] = null;

                Flash::error('Vendor OS Tidak Ditemukan </br><small>Pastikan email akun ini sudah terdaftar di Vendor OS</small>');
                return view('home_vendor')->with($this->data);
            }

        }elseif($request->kar_os){
                //if all null
                $this->data['jk_laki'] = karyawan_os::select('gender')->where([['gender','=','Laki-laki'],['is_active','=','A']])->count();
                $this->data['jk_perempuan'] = karyawan_os::select('gender')->where([['gender','!=','Laki-laki'],['is_active','=','A']])->count();
                $this->data['unit_kerja'] = fungsi_os::withCount(['karyawan_os'=> function ($query){
                    $query->where('is_active','=','A');
                }])->get()->toJson();
                $this->data['data_vendor'] = vendor_os::withCount(['karyawan_os'=> function ($query){
                    $query->where('is_active','=','A');
                }])->get()->toJson();
                // $this->data['umur_kurangdari30'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                // $this->data['umur_31sd40'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                // $this->data['umur_41sd50'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                // $this->data['umur_51sd54'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                // $this->data['umur_lebihdari55'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();

                //if range tanggal not null and fungsi null
                if($request->dari != null && $request->value_unit == null){
                    $dari = $request->dari;
                    $sampai = $request->sampai;
                    $this->data['dari'] = $request->dari;
                    $this->data['sampai'] = $request->sampai;
                    if($request->dari == null || $request->sampai == null){
                        Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                        return view('home_vendor')->with($this->data);
                    }

                    $this->data['jk_laki'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','=','Laki-laki'],['is_active','=','A']])->count();
                    $this->data['jk_perempuan'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','!=','Laki-laki'],['is_active','=','A']])->count();
                    $this->data['unit_kerja'] = fungsi_os::whereHas('karyawan_os', function($query) use ($dari, $sampai) {
                        $query->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    })->withCount(['karyawan_os' => function ($query) use($dari, $sampai){
                        $query->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    }])->get()->toJson();
                    $this->data['data_vendor'] = vendor_os::whereHas('karyawan_os', function($query) use ($dari, $sampai) {
                        $query->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    })->withCount(['karyawan_os' => function ($query) use($dari, $sampai){
                        $query->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    }])->get()->toJson();
                    // $this->data['umur_kurangdari30'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_31sd40'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_41sd50'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_51sd54'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_lebihdari55'] = karyawan_os::whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    return view('home_vendor_admin')->with($this->data);

                //if range tanggal and fungsi not null
                }elseif($request->dari != null && $request->value_unit != null){
                    $dari = $request->dari;
                    $sampai = $request->sampai;
                    $value_unit = $request->value_unit;
                    $this->data['value_unit'] = $request->value_unit;
                    $this->data['dari'] = $request->dari;
                    $this->data['sampai'] = $request->sampai;
                    if($request->dari == null || $request->sampai == null){
                        Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                        return view('home_vendor_admin')->with($this->data);
                    }
                    $this->data['jk_laki'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','=','Laki-laki'],['id_vendor','=',$value_unit],['is_active','=','A']])->count();
                    $this->data['jk_perempuan'] = karyawan_os::select('gender')->whereBetween('created_at', [$dari, $sampai])->where([['gender','!=','Laki-laki'],['id_vendor','=',$value_unit],['is_active','=','A']])->count();
                    $this->data['unit_kerja'] = fungsi_os::whereHas('karyawan_os', function($query) use ($dari, $sampai, $value_unit) {
                        $query->where([['id_vendor','=',$value_unit]])->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    })->withCount(['karyawan_os' => function ($query) use($dari, $sampai, $value_unit){
                        $query->where([['id_vendor','=',$value_unit]])->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    }])->get()->toJson();
                    $this->data['data_vendor'] = vendor_os::whereHas('karyawan_os', function($query) use ($dari, $sampai, $value_unit) {
                        $query->where([['id_vendor','=',$value_unit]])->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    })->withCount(['karyawan_os' => function ($query) use($dari, $sampai, $value_unit){
                        $query->where([['id_vendor','=',$value_unit]])->whereBetween('created_at', [$dari, $sampai])->where('is_active','=','A');
                    }])->get()->toJson();
                    // $this->data['umur_kurangdari30'] = karyawan_os::where([['id_vendor','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_31sd40'] = karyawan_os::where([['id_vendor','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_41sd50'] = karyawan_os::where([['id_vendor','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_51sd54'] = karyawan_os::where([['id_vendor','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    // $this->data['umur_lebihdari55'] = karyawan_os::where([['id_vendor','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('created_at', [$dari, $sampai])->count();
                    return view('home_vendor_admin')->with($this->data);

                //if tanggal null and fungsi not null
                }elseif($request->dari == null && $request->sampai == null && $request->value_unit != null){
                    $value_unit = $request->value_unit;
                    $this->data['value_unit'] = $request->value_unit;
                    $this->data['jk_laki'] = karyawan_os::select('gender')->where([['gender','=','Laki-laki'],['id_vendor','=',$value_unit],['is_active','=','A']])->count();
                    $this->data['jk_perempuan'] = karyawan_os::select('gender')->where([['gender','!=','Laki-laki'],['id_vendor','=',$value_unit],['is_active','=','A']])->count();
                    $this->data['unit_kerja'] = fungsi_os::whereHas('karyawan_os', function($query) use ($value_unit) {
                        $query->where([['id_vendor','=',$value_unit]])->where('is_active','=','A');
                    })->withCount(['karyawan_os' => function ($query) use ($value_unit){
                        $query->where([['id_vendor','=',$value_unit]])->where('is_active','=','A');
                    }])->get()->toJson();
                    $this->data['data_vendor'] = vendor_os::whereHas('karyawan_os', function($query) use ($value_unit) {
                        $query->where([['id_vendor','=',$value_unit]])->where('is_active','=','A');
                    })->withCount(['karyawan_os' => function ($query) use ($value_unit){
                        $query->where([['id_vendor','=',$value_unit]])->where('is_active','=','A');
                    }])->get()->toJson();
                    // $this->data['umur_kurangdari30'] = karyawan_os::where([['id_unitkerja','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                    // $this->data['umur_31sd40'] = karyawan_os::where([['id_unitkerja','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                    // $this->data['umur_41sd50'] = karyawan_os::where([['id_unitkerja','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                    // $this->data['umur_51sd54'] = karyawan_os::where([['id_unitkerja','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                    // $this->data['umur_lebihdari55'] = karyawan_os::where([['id_unitkerja','=',$value_unit]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();
                return view('home_vendor_admin')->with($this->data);
                }
                return view('home_vendor_admin')->with($this->data);
        }else{
            //if all null
            $this->data['jk_laki'] = karyawan::select('gender')->where('gender','=','Male')->count();
            $this->data['jk_perempuan'] = karyawan::select('gender')->where('gender','!=','Male')->count();
            $this->data['unit_kerja'] = unitkerja::withCount('karyawan')->get()->toJson();
            $this->data['status_pendidikan'] = \DB::table('tblkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->groupBy('pend_diakui')->get()->toJson();
            $this->data['kelas_jabatan'] = klsjabatan::withCount('karyawan')->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
            $this->data['kelas_jabatan_alphabet'] = klsjabatan::withCount('karyawan')->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();
            $this->data['umur_kurangdari30'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
            $this->data['umur_31sd40'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
            $this->data['umur_41sd50'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
            $this->data['umur_51sd54'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
            $this->data['umur_lebihdari55'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();

            //if range tanggal not null and fungsi null
            if($request->dari != null && $request->value_unit == null){
                $dari = new Carbon($request->dari);
                $sampai = new Carbon($request->sampai);
                $sampai = $sampai->endOfMonth();

                $this->data['dari'] = $request->dari;
                $this->data['sampai'] = $request->sampai;
                if($request->dari == null || $request->sampai == null){
                    Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                    return view('home')->with($this->data);
                }

                $this->data['jk_laki_entry_date'] = karyawan::select('gender')->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->where('gender','=','Male')->count();
                $this->data['jk_laki_update_date'] = karyawan::select('gender')->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->where('gender','=','Male');
                })->count();
                $this->data['jk_laki'] =  $this->data['jk_laki_entry_date'] + $this->data['jk_laki_update_date'];

                $this->data['jk_perempuan_entry_date'] = karyawan::select('gender')->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->where('gender','!=','Male')->count();
                $this->data['jk_perempuan_update_date'] = karyawan::select('gender')->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->where('gender','!=','Male');
                })->count();
                $this->data['jk_perempuan'] =  $this->data['jk_perempuan_entry_date'] + $this->data['jk_perempuan_update_date'];

                //Search unit kerja
                $this->data['unit_kerja'] = unitkerja::withCount(['karyawan' => function($query) use ($dari, $sampai){
                    return $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                }])->get()->toJson();


                $this->data['status_pendidikan'] = karyawan::selectRaw('pend_diakui as pendidikan, COUNT(pend_diakui) AS jumlah')->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->groupBy('pend_diakui')->get()->toJson();
                $this->data['status_pendidikan_update_date'] = \DB::table('tbllogkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->where('is_active',1)->whereBetween('update_date', [$dari, $sampai])->groupBy('pend_diakui')->get()->toJson();

                $this->data['kelas_jabatan'] = klsjabatan::withCount(['karyawan' => function($query) use ($dari, $sampai){
                    return $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                }])->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
                $this->data['kelas_jabatan_alphabet'] = klsjabatan::withCount(['karyawan' => function($query) use ($dari, $sampai){
                    return $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                }])->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();

                $this->data['umur_kurangdari30_entry_date'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_kurangdari30_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()]);
                })->count();
                $this->data['umur_kurangdari30'] = $this->data['umur_kurangdari30_entry_date'] + $this->data['umur_kurangdari30_update_date'];

                $this->data['umur_31sd40_entry_date'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_31sd40_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()]);
                })->count();
                $this->data['umur_31sd40'] = $this->data['umur_31sd40_entry_date'] + $this->data['umur_31sd40_update_date'];
                
                $this->data['umur_41sd50_entry_date'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_41sd50_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()]);
                })->count();
                $this->data['umur_41sd50'] = $this->data['umur_41sd50_entry_date'] + $this->data['umur_41sd50_update_date'];

                $this->data['umur_51sd54_entry_date'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_51sd54_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()]);
                })->count();
                $this->data['umur_51sd54'] = $this->data['umur_51sd54_entry_date'] + $this->data['umur_51sd54_update_date'];

                $this->data['umur_lebihdari55_entry_date'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_lebihdari55_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()]);
                })->count();
                $this->data['umur_lebihdari55'] = $this->data['umur_lebihdari55_entry_date'] + $this->data['umur_lebihdari55_update_date'];
                
            return view('home')->with($this->data);

            //if range tanggal and fungsi not null
            }elseif($request->dari != null && $request->value_unit != null){
                $dari = new Carbon($request->dari);
                $sampai = new Carbon($request->sampai);
                $sampai = $sampai->endOfMonth();
                $value_unit = $request->value_unit;

                $this->data['value_unit'] = $request->value_unit;
                $this->data['dari'] = $request->dari;
                $this->data['sampai'] = $request->sampai;
                if($request->dari == null || $request->sampai == null){
                    Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                    return view('home')->with($this->data);
                }

                $this->data['jk_laki_entry_date'] = karyawan::select('gender')->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->where([['gender','=','Male'],['id_unitkerja','=',$value_unit]])->count();
                $this->data['jk_laki_update_date'] = karyawan::select('gender')->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where([['gender','=','Male'],['id_unitkerja','=',$value_unit]]);
                })->count();
                $this->data['jk_laki'] =  $this->data['jk_laki_entry_date'] + $this->data['jk_laki_update_date'];


                $this->data['jk_perempuan_entry_date'] = karyawan::select('gender')->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->where([['gender','!=','Male'],['id_unitkerja','=',$value_unit]])->count();
                $this->data['jk_perempuan_update_date'] = karyawan::select('gender')->whereHas('log_karyawan' , function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where([['gender','!=','Male'],['id_unitkerja','=',$value_unit]]);
                })->count();
                $this->data['jk_perempuan'] =  $this->data['jk_perempuan_entry_date'] + $this->data['jk_perempuan_update_date'];

                $this->data['unit_kerja'] = unitkerja::withCount(['karyawan' => function($query) use ($dari, $sampai,$value_unit){
                    return $query->doesnthave('log_karyawan')->where('id_unitkerja','=',$value_unit)->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                }])->get()->toJson();


                $this->data['status_pendidikan'] = karyawan::selectRaw('pend_diakui as pendidikan, COUNT(pend_diakui) AS jumlah')->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->where('id_unitkerja','=',$value_unit)->groupBy('pend_diakui')->get()->toJson();
                $this->data['status_pendidikan_update_date'] = \DB::table('tbllogkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->where('is_active',1)->whereBetween('update_date', [$dari, $sampai])->where('id_unitkerja','=',$value_unit)->groupBy('pend_diakui')->get()->toJson();


                $this->data['kelas_jabatan'] = klsjabatan::withCount(['karyawan' => function($query) use ($dari, $sampai,$value_unit){
                    return $query->doesnthave('log_karyawan')->where('id_unitkerja','=',$value_unit)->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai, $value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                }])->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
                $this->data['kelas_jabatan_alphabet'] = klsjabatan::withCount(['karyawan' => function($query) use ($dari, $sampai,$value_unit){
                    return $query->doesnthave('log_karyawan')->where('id_unitkerja','=',$value_unit)->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai, $value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                }])->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();


                $this->data['umur_kurangdari30_entry_date'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_kurangdari30_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()]);
                })->count();
                $this->data['umur_kurangdari30'] = $this->data['umur_kurangdari30_entry_date'] + $this->data['umur_kurangdari30_update_date'];


                $this->data['umur_31sd40_entry_date'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_31sd40_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()]);
                })->count();
                $this->data['umur_31sd40'] = $this->data['umur_31sd40_entry_date'] + $this->data['umur_31sd40_update_date'];
                
                $this->data['umur_41sd50_entry_date'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_41sd50_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()]);
                })->count();
                $this->data['umur_41sd50'] = $this->data['umur_41sd50_entry_date'] + $this->data['umur_41sd50_update_date'];

                $this->data['umur_51sd54_entry_date'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_51sd54_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()]);
                })->count();
                $this->data['umur_51sd54'] = $this->data['umur_51sd54_entry_date'] + $this->data['umur_51sd54_update_date'];

                $this->data['umur_lebihdari55_entry_date'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai])->count();
                $this->data['umur_lebihdari55_update_date'] = karyawan::whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('update_date', [$dari, $sampai]);
                })->whereHas('log_karyawan' , function($query) use ($dari, $sampai,$value_unit){
                    return $query->where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()]);
                })->count();
                $this->data['umur_lebihdari55'] = $this->data['umur_lebihdari55_entry_date'] + $this->data['umur_lebihdari55_update_date'];

            return view('home')->with($this->data);

            //if tanggal null and fungsi not null
            }elseif($request->dari == null && $request->sampai == null && $request->value_unit != null){
                $value_unit = $request->value_unit;
                $this->data['value_unit'] = $request->value_unit;
                $this->data['jk_laki'] = karyawan::select('gender')->where([['gender','=','Male'],['id_unitkerja','=',$value_unit]])->count();
                $this->data['jk_perempuan'] = karyawan::select('gender')->where([['gender','!=','Male'],['id_unitkerja','=',$value_unit]])->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan', function($query) use ($value_unit) {
                    $query->where('id_unitkerja','=',$value_unit);
                })->withCount('karyawan')->get()->toJson();
                $this->data['status_pendidikan'] = \DB::table('tblkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->where('id_unitkerja','=',$value_unit)->groupBy('pend_diakui')->get()->toJson();
                $this->data['kelas_jabatan'] = klsjabatan::whereHas('karyawan', function($query) use ($value_unit) {
                    $query->where('id_unitkerja','=',$value_unit);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
                $this->data['kelas_jabatan_alphabet'] = klsjabatan::whereHas('karyawan', function($query) use ($value_unit) {
                    $query->where('id_unitkerja','=',$value_unit);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                $this->data['umur_31sd40'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                $this->data['umur_41sd50'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                $this->data['umur_51sd54'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                $this->data['umur_lebihdari55'] = karyawan::where('id_unitkerja','=',$value_unit)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();
            return view('home')->with($this->data);
            }
        }
        // echo "<pre>";
        // print_r($this->data);
        // echo "</pre>";

        //return for range tanggal and fungsi is null
        return view('home')->with($this->data);
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
