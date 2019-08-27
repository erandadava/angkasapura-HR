<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_karyawanAPIRequest;
use App\Http\Requests\API\Updatelog_karyawanAPIRequest;
use App\Models\log_karyawan;
use App\Repositories\log_karyawanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class log_karyawanController
 * @package App\Http\Controllers\API
 */

class log_karyawanAPIController extends AppBaseController
{
    /** @var  log_karyawanRepository */
    private $logKaryawanRepository;

    public function __construct(log_karyawanRepository $logKaryawanRepo)
    {
        $this->logKaryawanRepository = $logKaryawanRepo;
    }

    /**
     * Display a listing of the log_karyawan.
     * GET|HEAD /logKaryawans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->logKaryawanRepository->pushCriteria(new RequestCriteria($request));
        $this->logKaryawanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $logKaryawans = $this->logKaryawanRepository->all();

        return $this->sendResponse($logKaryawans->toArray(), 'Log Karyawans retrieved successfully');
    }

    /**
     * Store a newly created log_karyawan in storage.
     * POST /logKaryawans
     *
     * @param Createlog_karyawanAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_karyawanAPIRequest $request)
    {
        $input = $request->all();

        $logKaryawan = $this->logKaryawanRepository->create($input);

        return $this->sendResponse($logKaryawan->toArray(), 'Log Karyawan saved successfully');
    }

    /**
     * Display the specified log_karyawan.
     * GET|HEAD /logKaryawans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_karyawan $logKaryawan */
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            return $this->sendError('Log Karyawan not found');
        }

        return $this->sendResponse($logKaryawan->toArray(), 'Log Karyawan retrieved successfully');
    }

    /**
     * Update the specified log_karyawan in storage.
     * PUT/PATCH /logKaryawans/{id}
     *
     * @param  int $id
     * @param Updatelog_karyawanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_karyawanAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_karyawan $logKaryawan */
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            return $this->sendError('Log Karyawan not found');
        }

        $logKaryawan = $this->logKaryawanRepository->update($input, $id);

        return $this->sendResponse($logKaryawan->toArray(), 'log_karyawan updated successfully');
    }

    /**
     * Remove the specified log_karyawan from storage.
     * DELETE /logKaryawans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_karyawan $logKaryawan */
        $logKaryawan = $this->logKaryawanRepository->findWithoutFail($id);

        if (empty($logKaryawan)) {
            return $this->sendError('Log Karyawan not found');
        }

        $logKaryawan->delete();

        return $this->sendResponse($id, 'Log Karyawan deleted successfully');
    }
}
