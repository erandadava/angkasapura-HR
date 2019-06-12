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


class karyawanController extends AppBaseController
{
    /** @var  karyawanRepository */
    private $karyawanRepository;

    public function __construct(karyawanRepository $karyawanRepo, unitkerjaRepository $unitkerjaRepo)
    {
        $this->karyawanRepository = $karyawanRepo;
        $this->unitkerjaRepository = $unitkerjaRepo;
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
}
