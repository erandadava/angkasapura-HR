<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createkaryawan_osAPIRequest;
use App\Http\Requests\API\Updatekaryawan_osAPIRequest;
use App\Models\karyawan_os;
use App\Repositories\karyawan_osRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class karyawan_osController
 * @package App\Http\Controllers\API
 */

class karyawan_osAPIController extends AppBaseController
{
    /** @var  karyawan_osRepository */
    private $karyawanOsRepository;

    public function __construct(karyawan_osRepository $karyawanOsRepo)
    {
        $this->karyawanOsRepository = $karyawanOsRepo;
    }

    /**
     * Display a listing of the karyawan_os.
     * GET|HEAD /karyawanOs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->karyawanOsRepository->pushCriteria(new RequestCriteria($request));
        $this->karyawanOsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $karyawanOs = $this->karyawanOsRepository->all();

        return $this->sendResponse($karyawanOs->toArray(), 'Karyawan Os retrieved successfully');
    }

    /**
     * Store a newly created karyawan_os in storage.
     * POST /karyawanOs
     *
     * @param Createkaryawan_osAPIRequest $request
     *
     * @return Response
     */
    public function store(Createkaryawan_osAPIRequest $request)
    {
        $input = $request->all();

        $karyawanOs = $this->karyawanOsRepository->create($input);

        return $this->sendResponse($karyawanOs->toArray(), 'Karyawan Os saved successfully');
    }

    /**
     * Display the specified karyawan_os.
     * GET|HEAD /karyawanOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var karyawan_os $karyawanOs */
        $karyawanOs = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($karyawanOs)) {
            return $this->sendError('Karyawan Os not found');
        }

        return $this->sendResponse($karyawanOs->toArray(), 'Karyawan Os retrieved successfully');
    }

    /**
     * Update the specified karyawan_os in storage.
     * PUT/PATCH /karyawanOs/{id}
     *
     * @param  int $id
     * @param Updatekaryawan_osAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatekaryawan_osAPIRequest $request)
    {
        $input = $request->all();

        /** @var karyawan_os $karyawanOs */
        $karyawanOs = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($karyawanOs)) {
            return $this->sendError('Karyawan Os not found');
        }

        $karyawanOs = $this->karyawanOsRepository->update($input, $id);

        return $this->sendResponse($karyawanOs->toArray(), 'karyawan_os updated successfully');
    }

    /**
     * Remove the specified karyawan_os from storage.
     * DELETE /karyawanOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var karyawan_os $karyawanOs */
        $karyawanOs = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($karyawanOs)) {
            return $this->sendError('Karyawan Os not found');
        }

        $karyawanOs->delete();

        return $this->sendResponse($id, 'Karyawan Os deleted successfully');
    }
}
