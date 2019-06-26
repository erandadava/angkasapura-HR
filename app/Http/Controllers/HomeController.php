<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawan;
use App\Models\fungsi;
use App\Models\klsjabatan;
use DB;
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
        $this->data['jk_laki'] = karyawan::select('gender')->where('gender','=','laki-laki')->get()->count();
        $this->data['jk_perempuan'] = karyawan::select('gender')->where('gender','!=','laki-laki')->get()->count();
        $this->data['fungsi'] = fungsi::select('nama_fungsi')->where('id','!=',null)->get();
        $this->data['kelas_jabatan'] = klsjabatan::select('nama_kj')->where('id','!=',null)->get()->count();
        
        print_r($this->data);
        // return view('home')->with($this->data);
    }
}
