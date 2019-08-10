<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawan;
use App\Models\fungsi;
use App\Models\klsjabatan;
use App\Models\unitkerja;
use DB;
use Carbon\Carbon;
use Flash;
use Auth;
use App\Models\karyawan_os;

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
            //if all null
            $this->data['jk_laki'] = karyawan_os::select('gender')->where([['gender','=','Laki-laki'],['id_vendor','=',$id_vendor->id]])->count();
            $this->data['jk_perempuan'] = karyawan_os::select('gender')->where([['gender','!=','Laki-laki'],['id_vendor','=',$id_vendor->id]])->count();
            $this->data['unit_kerja'] = unitkerja::withCount(['karyawan_os' => function ($query) use($id_vendor){
                $query->where('id_vendor','=',$id_vendor->id);
            }])->get()->toJson();
            $this->data['umur_kurangdari30'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
            $this->data['umur_31sd40'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
            $this->data['umur_41sd50'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
            $this->data['umur_51sd54'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
            $this->data['umur_lebihdari55'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();

            //if range tanggal not null and fungsi null
            if($request->dari != null && $request->value_fungsi == null){
                $dari = $request->dari;
                $sampai = $request->sampai;
                $this->data['dari'] = $request->dari;
                $this->data['sampai'] = $request->sampai;
                if($request->dari == null || $request->sampai == null){
                    Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                    return view('home')->with($this->data);
                }

                $this->data['jk_laki'] = karyawan_os::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where([['gender','=','Laki-laki'],['id_vendor','=',$id_vendor->id]])->count();
                $this->data['jk_perempuan'] = karyawan_os::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where([['gender','!=','Laki-laki'],['id_vendor','=',$id_vendor->id]])->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan_os', function($query) use ($dari, $sampai, $id_vendor) {
                    $query->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where('id_vendor','=',$id_vendor->id);
                })->withCount(['karyawan_os' => function ($query) use($dari, $sampai, $id_vendor){
                    $query->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where('id_vendor','=',$id_vendor->id);
                }])->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_31sd40'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_41sd50'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_51sd54'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_lebihdari55'] = karyawan_os::where('id_vendor','=',$id_vendor->id)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                return view('home_vendor')->with($this->data);

            //if range tanggal and fungsi not null
            }elseif($request->dari != null && $request->value_fungsi != null){
                $dari = $request->dari;
                $sampai = $request->sampai;
                $value_fungsi = $request->value_fungsi;
                $this->data['value_fungsi'] = $request->value_fungsi;
                $this->data['dari'] = $request->dari;
                $this->data['sampai'] = $request->sampai;
                if($request->dari == null || $request->sampai == null){
                    Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                    return view('home')->with($this->data);
                }
                $this->data['jk_laki'] = karyawan_os::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where([['gender','=','Laki-laki'],['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->count();
                $this->data['jk_perempuan'] = karyawan_os::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where([['gender','!=','Laki-laki'],['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan_os', function($query) use ($dari, $sampai, $value_fungsi,$id_vendor) {
                    $query->where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount(['karyawan_os' => function ($query) use($dari, $sampai, $value_fungsi,$id_vendor){
                    $query->where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                }])->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_31sd40'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_41sd50'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_51sd54'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_lebihdari55'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                return view('home_vendor')->with($this->data);

            //if tanggal null and fungsi not null
            }elseif($request->dari == null && $request->sampai == null && $request->value_fungsi != null){
                $value_fungsi = $request->value_fungsi;
                $this->data['value_fungsi'] = $request->value_fungsi;
                $this->data['jk_laki'] = karyawan_os::select('gender')->where([['gender','=','Laki-laki'],['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->count();
                $this->data['jk_perempuan'] = karyawan_os::select('gender')->where([['gender','!=','Laki-laki'],['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan_os', function($query) use ($value_fungsi,$id_vendor) {
                    $query->where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]]);
                })->withCount(['karyawan_os' => function ($query) use ($value_fungsi,$id_vendor){
                    $query->where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]]);
                }])->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                $this->data['umur_31sd40'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                $this->data['umur_41sd50'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                $this->data['umur_51sd54'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                $this->data['umur_lebihdari55'] = karyawan_os::where([['id_fungsi','=',$value_fungsi],['id_vendor','=',$id_vendor->id]])->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();
            return view('home_vendor')->with($this->data);
            }
            return view('home_vendor')->with($this->data);

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
            if($request->dari != null && $request->value_fungsi == null){
                $dari = $request->dari;
                $sampai = $request->sampai;
                $this->data['dari'] = $request->dari;
                $this->data['sampai'] = $request->sampai;
                if($request->dari == null || $request->sampai == null){
                    Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                    return view('home')->with($this->data);
                }

                $this->data['jk_laki'] = karyawan::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where('gender','=','Male')->count();
                $this->data['jk_perempuan'] = karyawan::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where('gender','!=','Male')->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan', function($query) use ($dari, $sampai) {
                    $query->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount('karyawan')->get()->toJson();
                $this->data['status_pendidikan'] = \DB::table('tblkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->groupBy('pend_diakui')->get()->toJson();
                $this->data['kelas_jabatan'] = klsjabatan::whereHas('karyawan', function($query) use ($dari, $sampai) {
                    $query->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
                $this->data['kelas_jabatan_alphabet'] = klsjabatan::whereHas('karyawan', function($query) use ($dari, $sampai) {
                    $query->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_31sd40'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_41sd50'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_51sd54'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_lebihdari55'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
            return view('home')->with($this->data);

            //if range tanggal and fungsi not null
            }elseif($request->dari != null && $request->value_fungsi != null){
                $dari = $request->dari;
                $sampai = $request->sampai;
                $value_fungsi = $request->value_fungsi;
                $this->data['value_fungsi'] = $request->value_fungsi;
                $this->data['dari'] = $request->dari;
                $this->data['sampai'] = $request->sampai;
                if($request->dari == null || $request->sampai == null){
                    Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                    return view('home')->with($this->data);
                }
                $this->data['jk_laki'] = karyawan::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where([['gender','=','Male'],['id_fungsi','=',$value_fungsi]])->count();
                $this->data['jk_perempuan'] = karyawan::select('gender')->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->where([['gender','!=','Male'],['id_fungsi','=',$value_fungsi]])->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan', function($query) use ($dari, $sampai, $value_fungsi) {
                    $query->where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount('karyawan')->get()->toJson();
                $this->data['status_pendidikan'] = \DB::table('tblkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->whereBetween('tgl_lahir', [$dari, $sampai])->where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()])->groupBy('pend_diakui')->get()->toJson();
                $this->data['kelas_jabatan'] = klsjabatan::whereHas('karyawan', function($query) use ($dari, $sampai, $value_fungsi) {
                    $query->where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
                $this->data['kelas_jabatan_alphabet'] = klsjabatan::whereHas('karyawan', function($query) use ($dari, $sampai, $value_fungsi) {
                    $query->where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [$dari, $sampai])->whereBetween('tgl_lahir', [Carbon::createFromFormat('Y-m-d', $sampai)->subYears(56), Carbon::createFromFormat('Y-m-d', $sampai)->subYears(0)->addYear()->subDay()]);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_31sd40'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_41sd50'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_51sd54'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
                $this->data['umur_lebihdari55'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->whereBetween('tgl_lahir', [$dari, $sampai])->count();
            return view('home')->with($this->data);

            //if tanggal null and fungsi not null
            }elseif($request->dari == null && $request->sampai == null && $request->value_fungsi != null){
                $value_fungsi = $request->value_fungsi;
                $this->data['value_fungsi'] = $request->value_fungsi;
                $this->data['jk_laki'] = karyawan::select('gender')->where([['gender','=','Male'],['id_fungsi','=',$value_fungsi]])->count();
                $this->data['jk_perempuan'] = karyawan::select('gender')->where([['gender','!=','Male'],['id_fungsi','=',$value_fungsi]])->count();
                $this->data['unit_kerja'] = unitkerja::whereHas('karyawan', function($query) use ($value_fungsi) {
                    $query->where('id_fungsi','=',$value_fungsi);
                })->withCount('karyawan')->get()->toJson();
                $this->data['status_pendidikan'] = \DB::table('tblkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->where('id_fungsi','=',$value_fungsi)->groupBy('pend_diakui')->get()->toJson();
                $this->data['kelas_jabatan'] = klsjabatan::whereHas('karyawan', function($query) use ($value_fungsi) {
                    $query->where('id_fungsi','=',$value_fungsi);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^-?[0-9]+$'")->orderByRaw('LENGTH(nama_kj) DESC')->orderBy('nama_kj','DESC')->get()->toJson();
                $this->data['kelas_jabatan_alphabet'] = klsjabatan::whereHas('karyawan', function($query) use ($value_fungsi) {
                    $query->where('id_fungsi','=',$value_fungsi);
                })->withCount('karyawan')->whereRaw("nama_kj REGEXP '^[A-z]+$'")->orderBy('nama_kj','ASC')->get()->toJson();
                $this->data['umur_kurangdari30'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
                $this->data['umur_31sd40'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
                $this->data['umur_41sd50'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
                $this->data['umur_51sd54'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
                $this->data['umur_lebihdari55'] = karyawan::where('id_fungsi','=',$value_fungsi)->whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();
            return view('home')->with($this->data);
            }
        }
        // echo "<pre>";
        // print_r($this->data);
        // echo "</pre>";

        //return for range tanggal and fungsi is null
        return view('home')->with($this->data);
    }
}
