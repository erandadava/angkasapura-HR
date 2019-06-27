<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawan;
use App\Models\fungsi;
use App\Models\klsjabatan;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
    public function index()
    {
        $this->data['jk_laki'] = karyawan::select('gender')->where('gender','=','Male')->count();
        $this->data['jk_perempuan'] = karyawan::select('gender')->where('gender','!=','Male')->count();
        $this->data['fungsi'] = fungsi::withCount('karyawan')->get()->toJson();
        $this->data['status_pendidikan'] = \DB::table('tblkaryawan')->select('pend_diakui as pendidikan', DB::raw('COUNT(pend_diakui) AS jumlah'))->groupBy('pend_diakui')->get()->toJson();
        $this->data['kelas_jabatan'] = klsjabatan::withCount('karyawan')->get()->toJson();
        $this->data['umur_kurangdari30'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(30), Carbon::today()->subYears(0)->endOfDay()])->count();
        $this->data['umur_31sd40'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(40), Carbon::today()->subYears(31)->endOfDay()])->count();
        $this->data['umur_41sd50'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(50), Carbon::today()->subYears(41)->endOfDay()])->count();
        $this->data['umur_51sd54'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(54), Carbon::today()->subYears(51)->endOfDay()])->count();
        $this->data['umur_lebihdari55'] = karyawan::whereBetween('tgl_lahir', [Carbon::today()->subYears(200), Carbon::today()->subYears(55)->endOfDay()])->count();
        // echo "<pre>";
        // print_r($this->data);
        // echo "</pre>";
        return view('home')->with($this->data);
    }
}
