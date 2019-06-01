<?php

namespace App\Http\Controllers;

use App\DataTables\karyawanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use App\Repositories\karyawanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\jabatan;
use App\Models\klsjabatan;
use App\Models\statuskar;
use App\Models\tipekar;
use App\Models\unit;
use App\Models\unitkerja;


class karyawanController extends AppBaseController
{
    /** @var  karyawanRepository */
    private $karyawanRepository;

    public function __construct(karyawanRepository $karyawanRepo)
    {
        $this->karyawanRepository = $karyawanRepo;
        $this->data['jabatan'] = jabatan::pluck('nama_jabatan','id');
        $this->data['klsjabatan'] = klsjabatan::pluck('nama_kj','id');
        $this->data['statuskar'] = statuskar::pluck('nama_stat','id');
        $this->data['tipekar'] = tipekar::pluck('nama_tipekar','id');
        $this->data['unit'] = unit::pluck('nama_unit','id');
        $this->data['unitkerja'] = unitkerja::pluck('nama_uk','id');
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
        print($input['entry_date']);
        $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['tgl_lahir']);
        $input['rencana_mpp'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['rencana_mpp']);
        $input['rencana_pensiun'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['rencana_pensiun']);
        $input['entry_date'] = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $input['entry_date']);
        $karyawan = $this->karyawanRepository->create($input);

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
        $this->data['karyawan'] = $this->karyawanRepository->findWithoutFail($id);

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

        $karyawan = $this->karyawanRepository->update($request->all(), $id);

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
}
