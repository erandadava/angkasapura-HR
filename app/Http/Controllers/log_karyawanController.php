<?php

namespace App\Http\Controllers;

use App\DataTables\log_karyawanDataTable;
use App\Http\Requests;
use App\Http\Requests\Createlog_karyawanRequest;
use App\Http\Requests\Updatelog_karyawanRequest;
use App\Repositories\log_karyawanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class log_karyawanController extends AppBaseController
{
    /** @var  log_karyawanRepository */
    private $logKaryawanRepository;

    public function __construct(log_karyawanRepository $logKaryawanRepo)
    {
        $this->logKaryawanRepository = $logKaryawanRepo;
    }

    /**
     * Display a listing of the log_karyawan.
     *
     * @param log_karyawanDataTable $logKaryawanDataTable
     * @return Response
     */
    public function index(log_karyawanDataTable $logKaryawanDataTable)
    {
        return $logKaryawanDataTable->render('log_karyawans.index');
    }

    /**
     * Show the form for creating a new log_karyawan.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_karyawans.create');
    }

    /**
     * Store a newly created log_karyawan in storage.
     *
     * @param Createlog_karyawanRequest $request
     *
     * @return Response
     */
    public function store(Createlog_karyawanRequest $request)
    {
        $input = $request->all();

        $logKaryawan = $this->logKaryawanRepository->create($input);

        Flash::success('Log Karyawan saved successfully.');

        return redirect(route('logKaryawans.index'));
    }

    /**
     * Display the specified log_karyawan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            Flash::error('Log Karyawan not found');

            return redirect(route('logKaryawans.index'));
        }

        return view('log_karyawans.show')->with('logKaryawan', $logKaryawan);
    }

    /**
     * Show the form for editing the specified log_karyawan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            Flash::error('Log Karyawan not found');

            return redirect(route('logKaryawans.index'));
        }

        return view('log_karyawans.edit')->with('logKaryawan', $logKaryawan);
    }

    /**
     * Update the specified log_karyawan in storage.
     *
     * @param  int              $id
     * @param Updatelog_karyawanRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_karyawanRequest $request)
    {
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            Flash::error('Log Karyawan not found');

            return redirect(route('logKaryawans.index'));
        }

        $logKaryawan = $this->logKaryawanRepository->update($request->all(), $id);

        Flash::success('Log Karyawan updated successfully.');

        return redirect(route('logKaryawans.index'));
    }

    /**
     * Remove the specified log_karyawan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            Flash::error('Log Karyawan not found');

            return redirect(route('logKaryawans.index'));
        }

        $this->logKaryawanRepository->delete($id);

        Flash::success('Log Karyawan deleted successfully.');

        return redirect(route('logKaryawans.index'));
    }
}
