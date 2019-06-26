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

class karyawanController extends AppBaseController
{
    /** @var  karyawanRepository */
    private $karyawanRepository;

    public function __construct(karyawanRepository $karyawanRepo, unitkerjaRepository $unitkerjaRepo, jabatanRepository $jabatanRepo, fungsiRepository $fungsiRepo)
    {
        $this->karyawanRepository = $karyawanRepo;
        $this->unitkerjaRepository = $unitkerjaRepo;
        $this->jabatanRepository = $jabatanRepo;
        $this->fungsiRepository = $fungsiRepo;
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
        $arrjabatan = [];
        $arruk = [];
        $arrberhasil = [];
        foreach ($csv as $row) {
            $cek_jabatan = \App\Models\jabatan::where('nama_jabatan','=',$row['JABATAN'])->first();
            if(empty($cek_jabatan)){
                // $cek_jabatan = $this->jabatanRepository->create([
                //     'nama_jabatan' => $row['JABATAN']
                // ]);
                array_push($arrjabatan, $row['JABATAN']);
            }

            $cek_uk = \App\Models\unitkerja::where('nama_uk','=',$row['UNIT KERJA'])->first();
            if(empty($cek_uk)){
                // $cek_uk = $this->unitkerjaRepository->create([
                //     'nama_uk' => $row['UNIT KERJA']
                // ]);
                array_push($arruk, $row['UNIT KERJA']);
            }

            $cek_fungsi = \App\Models\fungsi::where('nama_fungsi','=',$row['FUNGSI'])->first();
            if(empty($cek_fungsi)){
                // $cek_fungsi = $this->fungsiRepository->create([
                //     'nama_fungsi' => $row['FUNGSI']
                // ]);
                array_push($arrfungsi, $row['FUNGSI']);
            }
            if(!empty($cek_fungsi) && !empty($cek_uk) && !empty($cek_jabatan)){
                $input['nik'] = $row['NIK'];
                $input['nama'] = $row['NAMA'];
                $input['tgl_lahir'] = \Carbon\Carbon::parse($row['TGL LAHIR'])->format('Y-m-d H:i:s');
                $input['rencana_mpp'] = \Carbon\Carbon::parse($row['RENCANA MPP'])->format('Y-m-d H:i:s');
                $input['rencana_pensiun'] = \Carbon\Carbon::parse($row['RENCANA PENSIUN'])->format('Y-m-d H:i:s');
                $input['gender'] = $row['JENIS KELAMIN'];
                $input['pend_diakui'] = $row['PENDIDIKAN DIAKUI'];
                $input['id_jabatan'] = $cek_jabatan['id'];
                $input['id_unitkerja'] = $cek_uk['id'];
                $input['id_fungsi'] = $cek_fungsi['id'];

                $this->karyawanRepository->create($input);

                array_push($arrberhasil, 'a');
            }
            
        }

        if(empty($arrfungsi || $arrjabatan || $arruk)){
            Flash::success('Import from CSV successfully.');
        }else{
            $gagal = count($arrfungsi) + count($arrjabatan) + count($arruk);
            $teks = '<b>'.(String) count($arrberhasil)." Karyawan Created Successfully</b> </br> <b>".(String)$gagal." Karyawan Not Created Because : </b> </br> Jabatan Not Found: </br>";
            foreach((array) array_unique($arrjabatan) as $dt){
                $teks = $teks.', '.$dt;
            }

            $teks = $teks.'</br> Fungsi Not Found: </br>';
            foreach((array) array_unique($arrfungsi) as $dt){
                $teks = $teks.', '.$dt;
            }

            $teks = $teks.'</br> Unit Kerja Not Found : </br>';
            foreach((array) array_unique($arruk) as $dt){
                $teks = $teks.', '.$dt;
            }
            Flash::info($teks);
        }
        } catch (\Throwable $th) {
            Flash::error('Terjadi Kesalahan ! </br> Pastikan File CSV Anda Sudah Benar </br> <small>Tips Jika File Sudah Benar: Pastikan Pada Header CSV Tidak Ada Yang Kosong</small>');
        }
        return redirect(route('karyawans.index'));
    }
}
