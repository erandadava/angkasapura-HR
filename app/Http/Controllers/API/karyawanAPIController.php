<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatekaryawanAPIRequest;
use App\Http\Requests\API\UpdatekaryawanAPIRequest;
use App\Models\karyawan;
use App\Repositories\karyawanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class karyawanController
 * @package App\Http\Controllers\API
 */

class karyawanAPIController extends AppBaseController
{
    /** @var  karyawanRepository */
    private $karyawanRepository;

    public function __construct(karyawanRepository $karyawanRepo)
    {
        $this->karyawanRepository = $karyawanRepo;
    }

    /**
     * Display a listing of the karyawan.
     * GET|HEAD /karyawans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->karyawanRepository->pushCriteria(new RequestCriteria($request));
        $this->karyawanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $karyawans = $this->karyawanRepository->all();

        return $this->sendResponse($karyawans->toArray(), 'Karyawans retrieved successfully');
    }

    /**
     * Store a newly created karyawan in storage.
     * POST /karyawans
     *
     * @param CreatekaryawanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatekaryawanAPIRequest $request)
    {
        $input = $request->all();

        $karyawan = $this->karyawanRepository->create($input);

        return $this->sendResponse($karyawan->toArray(), 'Karyawan saved successfully');
    }

    /**
     * Display the specified karyawan.
     * GET|HEAD /karyawans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var karyawan $karyawan */
        $karyawan = $this->karyawanRepository->findWithoutFail($id);

        if (empty($karyawan)) {
            return $this->sendError('Karyawan not found');
        }

        return $this->sendResponse($karyawan->toArray(), 'Karyawan retrieved successfully');
    }

    /**
     * Update the specified karyawan in storage.
     * PUT/PATCH /karyawans/{id}
     *
     * @param  int $id
     * @param UpdatekaryawanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatekaryawanAPIRequest $request)
    {
        $input = $request->all();

        /** @var karyawan $karyawan */
        $karyawan = $this->karyawanRepository->findWithoutFail($id);

        if (empty($karyawan)) {
            return $this->sendError('Karyawan not found');
        }

        $karyawan = $this->karyawanRepository->update($input, $id);

        return $this->sendResponse($karyawan->toArray(), 'karyawan updated successfully');
    }

    /**
     * Remove the specified karyawan from storage.
     * DELETE /karyawans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var karyawan $karyawan */
        $karyawan = $this->karyawanRepository->findWithoutFail($id);

        if (empty($karyawan)) {
            return $this->sendError('Karyawan not found');
        }

        $karyawan->delete();

        return $this->sendResponse($id, 'Karyawan deleted successfully');
    }
}
