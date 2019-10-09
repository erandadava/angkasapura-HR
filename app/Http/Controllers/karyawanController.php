<?php

namespace App\Http\Controllers;

use App\DataTables\karyawanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use App\Repositories\karyawanRepository;
use App\Repositories\unitkerjaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\jabatan;
use App\Models\klsjabatan;
use App\Models\statuskar;
use App\Models\tipekar;
use App\Models\unit;
use App\Models\unitkerja;
use App\Models\fungsi;
use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Repositories\jabatanRepository;
use App\Repositories\fungsiRepository;
use Validator;
use App\Repositories\log_karyawanRepository;

class karyawanController extends AppBaseController
{
    /** @var  karyawanRepository */
    private $karyawanRepository;

    public function __construct(karyawanRepository $karyawanRepo, unitkerjaRepository $unitkerjaRepo, jabatanRepository $jabatanRepo, fungsiRepository $fungsiRepo,log_karyawanRepository $logKaryawanRepo)
    {
        $this->karyawanRepository = $karyawanRepo;
        $this->unitkerjaRepository = $unitkerjaRepo;
        $this->jabatanRepository = $jabatanRepo;
        $this->fungsiRepository = $fungsiRepo;
        $this->logKaryawanRepository = $logKaryawanRepo;
        $this->data['jabatan'] = jabatan::pluck('nama_jabatan','id');
        $this->data['klsjabatan'] = klsjabatan::pluck('nama_kj','id');
        $this->data['statuskar'] = statuskar::pluck('nama_stat','id');
        $this->data['tipekar'] = tipekar::pluck('nama_tipekar','id');
        $this->data['unit'] = unit::pluck('nama_unit','id');
        $this->data['unitkerja'] = unitkerja::pluck('nama_uk','id');
        $this->data['fungsi'] = fungsi::pluck('nama_fungsi','id');
        $this->data['dtunitkerja'] = json_encode(unitkerja::get());
    }   

    /**
     * Display a listing of the karyawan.
     *
     * @param karyawanDataTable $karyawanDataTable
     * @return Response
     */
    public function index(karyawanDataTable $karyawanDataTable)
    {
        return $karyawanDataTable->render('karyawans.index');
    }

    /**
     * Show the form for creating a new karyawan.
     *
     * @return Response
     */
    public function create()
    {
        return view('karyawans.create')->with($this->data);
    }

    /**
     * Store a newly created karyawan in storage.
     *
     * @param CreatekaryawanRequest $request
     *
     * @return Response
     */
    public function store(CreatekaryawanRequest $request)
    {
        $input = $request->all();
        $karyawan = $this->karyawanRepository->create($input);
        $this->update_unitkerja($input['id_unitkerja'],1);

        Flash::success('Karyawan saved successfully.');

        return redirect(route('karyawans.index'));
    }

    /**
     * Display the specified karyawan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $karyawan = $this->karyawanRepository->findWithoutFail($id);

        if (empty($karyawan)) {
            Flash::error('Karyawan not found');

            return redirect(route('karyawans.index'));
        }

        $cek_log = $this->check_log($id);
        if($cek_log != null){
            $karyawan['id_jabatan'] = $cek_log['id_jabatan'];
            $karyawan['id_unitkerja'] = $cek_log['id_unitkerja'];
            $karyawan['id_klsjabatan'] = $cek_log['id_klsjabatan'];
            $karyawan['id_status1'] = $cek_log['id_status1'];
            $karyawan['id_tipe_kar'] = $cek_log['id_tipe_kar'];
            $karyawan['pend_akhir']= $cek_log['pend_akhir'];
            $karyawan['gender']= $cek_log['gender'];
            $karyawan['tgl_lahir']= $cek_log['tgl_lahir'];
            $karyawan['pend_diakui']= $cek_log['pend_diakui'];
        }
        return view('karyawans.show')->with('karyawan', $karyawan);
    }

    /**
     * Show the form for editing the specified karyawan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hasil = $this->karyawanRepository->findWithoutFail($id);
        $this->data['karyawan'] = $hasil;
        if (empty($this->data['karyawan'])) {
            Flash::error('Karyawan not found');

            return redirect(route('karyawans.index'));
        }
        $cek_log = $this->check_log($id);
        if($cek_log != null){
            $this->data['karyawan']['id_jabatan'] = $cek_log['id_jabatan'];
            $this->data['karyawan']['id_unitkerja'] = $cek_log['id_unitkerja'];
            $this->data['karyawan']['id_klsjabatan'] = $cek_log['id_klsjabatan'];
            $this->data['karyawan']['id_status1'] = $cek_log['id_status1'];
            $this->data['karyawan']['id_tipe_kar'] = $cek_log['id_tipe_kar'];
            $this->data['karyawan']['pend_akhir']= $cek_log['pend_akhir'];
            $this->data['karyawan']['gender']= $cek_log['gender'];
            $this->data['karyawan']['tgl_lahir']= $cek_log['tgl_lahir'];
            $this->data['karyawan']['pend_diakui']= $cek_log['pend_diakui'];
        }

        return view('karyawans.edit')->with($this->data);
    }

    /**
     * Update the specified karyawan in storage.
     *
     * @param  int              $id
     * @param UpdatekaryawanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatekaryawanRequest $request)
    {
        $karyawan = $this->karyawanRepository->findWithoutFail($id);
        
        if (empty($karyawan)) {
            Flash::error('Karyawan not found');

            return redirect(route('karyawans.index'));
        }

        $input = $request->all();

        if($karyawan->id_unitkerja != $input['id_unitkerja']){
            $this->update_unitkerja($input['id_unitkerja'],1);
            $this->update_unitkerja($karyawan->id_unitkerja,-1);
        }

        if($karyawan->nik == $input['nik']){
            unset($input['nik']);
        }else{
            $cek_nik = \App\Models\karyawan::where('nik',$input['nik'])->count();
            if($cek_nik > 0){
                Flash::error('NIK Already Taken');
                return redirect(route('karyawans.index'));
            } 
        }

        if($karyawan->id_jabatan != $input['id_jabatan'] || $karyawan->id_unitkerja != $input['id_unitkerja'] || $karyawan->id_klsjabatan != $input['id_klsjabatan'] || $karyawan->id_status1 != $input['id_status1'] || $karyawan->id_tipe_kar != $input['id_tipe_kar'] || $karyawan->pend_akhir != $input['pend_akhir'] || $karyawan->gender != $input['gender'] || $karyawan->tgl_lahir != $input['tgl_lahir'] || $karyawan->pend_diakui != $input['pend_diakui']){
            
            \App\Models\log_karyawan::where('id_karyawan_fk',$karyawan->id)->update(['is_active' => 0]);
            $input['id_karyawan_fk'] = $karyawan->id;
            $input['is_active'] = 1;
            $this->logKaryawanRepository->create($input);

            unset($input['id_jabatan']);
            unset($input['id_unitkerja']);
            unset($input['id_klsjabatan']);
            unset($input['id_status1']);
            unset($input['id_tipe_kar']);
            unset($input['pend_akhir']);
            unset($input['gender']);
            unset($input['tgl_lahir']);
            unset($input['pend_diakui']);
        }

        $karyawan = $this->karyawanRepository->update($input, $id);
        
        Flash::success('Karyawan updated successfully.');

        return redirect(route('karyawans.index'));
    }

    /**
     * Remove the specified karyawan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $karyawan = $this->karyawanRepository->findWithoutFail($id);

        if (empty($karyawan)) {
            Flash::error('Karyawan not found');

            return redirect(route('karyawans.index'));
        }

        $this->karyawanRepository->delete($id);

        Flash::success('Karyawan deleted successfully.');

        return redirect(route('karyawans.index'));
    }

    public function update_unitkerja($id, $jml){
        $uk = unitkerja::find($id);
        $input['jml_existing'] = (int) $uk->jml_existing + (int) $jml;
        return $this->unitkerjaRepository->update($input, $id);
    }

    public function import_from_csv(Request $request){
        try {
            if (empty($request->file_csv) || $request->file_csv->getClientOriginalExtension() != 'csv')
        {
            Flash::error("Pastikan Terdapat File Yang Diupload dan Memiliki Format CSV");
            return redirect(route('karyawans.index'));
        }
        $csv = Reader::createFromPath($request->file('file_csv'), 'r');
        $csv->setHeaderOffset(0);
        $arrfungsi = [];
        $arrklsjabatan = [];
        $arrjabatan = [];
        $arruk = [];
        $arrberhasil = [];
        foreach ($csv as $row) {
        //     $cek_jabatan = \App\Models\jabatan::where('nama_jabatan','=',$row['JABATAN'])->first();
        //     if(empty($cek_jabatan)){
        //         // $cek_jabatan = $this->jabatanRepository->create([
        //         //     'nama_jabatan' => $row['JABATAN']
        //         // ]);
        //         array_push($arrjabatan, $row['JABATAN']);
        //     }

        //     $cek_uk = \App\Models\unitkerja::where('nama_uk','=',$row['UNIT KERJA'])->first();
        //     if(empty($cek_uk)){
        //         // $cek_uk = $this->unitkerjaRepository->create([
        //         //     'nama_uk' => $row['UNIT KERJA']
        //         // ]);
        //         array_push($arruk, $row['UNIT KERJA']);
        //     }

        //     $cek_fungsi = \App\Models\fungsi::where('nama_fungsi','=',$row['FUNGSI'])->first();
        //     if(empty($cek_fungsi)){
        //         // $cek_fungsi = $this->fungsiRepository->create([
        //         //     'nama_fungsi' => $row['FUNGSI']
        //         // ]);
        //         array_push($arrfungsi, $row['FUNGSI']);
        //     }

        //     $cek_klsjabatan = \App\Models\klsjabatan::where('nama_kj','=',$row['PG'])->first();
        //     if(empty($cek_klsjabatan)){
        //         // $cek_fungsi = $this->fungsiRepository->create([
        //         //     'nama_fungsi' => $row['FUNGSI']
        //         // ]);
        //         array_push($arrklsjabatan, $row['PG']);
        //     }

        //     if(!empty($cek_fungsi) && !empty($cek_uk) && !empty($cek_jabatan) && !empty($cek_klsjabatan)){
                $input['nik'] = $row['nik'];
                $input['nama'] = $row['nama'];
                $input['tgl_lahir'] = \Carbon\Carbon::parse($row['tgl_lahir'])->format('Y-m-d H:i:s');
                $input['rencana_mpp'] = \Carbon\Carbon::parse($row['rencana_mpp'])->format('Y-m-d H:i:s');
                $input['rencana_pensiun'] = \Carbon\Carbon::parse($row['rencana_pensiun'])->format('Y-m-d H:i:s');
                $input['gender'] = $row['gender'];
                $input['pend_diakui'] = $row['pend_diakui'];
                $input['pend_milik'] = $row['pend_milik'];
                $input['id_jabatan'] = $row['id_jabatan'];
                $input['id_unitkerja'] = $row['id_unitkerja'];
                $input['id_fungsi'] = $row['id_fungsi'];
                $input['id_klsjabatan'] = $row['id_klsjabatan'];
                $input['pend_akhir'] = $row['pend_diakui'];

                $this->karyawanRepository->create($input);

                array_push($arrberhasil, 'a');
            // }
            
        }

        // if(empty($arrfungsi || $arrjabatan || $arruk || $arrklsjabatan)){
            
        // }else{
        //     $gagal = count($arrfungsi) + count($arrjabatan) + count($arruk) + count($arrklsjabatan);
        //     $teks = '<b>'.(String) count($arrberhasil)." Karyawan Created Successfully</b> </br> <b>".(String)$gagal." Karyawan Not Created Because : </b> </br> Jabatan Not Found: </br>";
        //     foreach((array) array_unique($arrjabatan) as $dt){
        //         $teks = $teks.', '.$dt;
        //     }

        //     $teks = $teks.'</br> Fungsi Not Found: </br>';
        //     foreach((array) array_unique($arrfungsi) as $dt){
        //         $teks = $teks.', '.$dt;
        //     }

        //     $teks = $teks.'</br> Unit Kerja Not Found : </br>';
        //     foreach((array) array_unique($arruk) as $dt){
        //         $teks = $teks.', '.$dt;
        //     }

        //     $teks = $teks.'</br> Kelas Jabatan Not Found : </br>';
        //     foreach((array) array_unique($arrklsjabatan) as $dt){
        //         $teks = $teks.', '.$dt;
        //     }
        //     Flash::info($teks);
        // }
        } catch (\Throwable $th) {
            Flash::error('Terjadi Kesalahan ! </br> Pastikan File dan Data CSV Anda Sudah Benar </br> <small>Tips Jika File Sudah Benar: Pastikan Pada Header CSV Tidak Ada Yang Kosong</small>');
            return redirect(route('karyawans.index'));
        }
        Flash::success('Import from CSV successfully.');
        return redirect(route('karyawans.index'));
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
