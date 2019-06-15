<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOsperformanceAPIRequest;
use App\Http\Requests\API\UpdateOsperformanceAPIRequest;
use App\Models\Osperformance;
use App\Repositories\OsperformanceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OsperformanceController
 * @package App\Http\Controllers\API
 */

class OsperformanceAPIController extends AppBaseController
{
    /** @var  OsperformanceRepository */
    private $osperformanceRepository;

    public function __construct(OsperformanceRepository $osperformanceRepo)
    {
        $this->osperformanceRepository = $osperformanceRepo;
    }

    /**
     * Display a listing of the Osperformance.
     * GET|HEAD /osperformances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->osperformanceRepository->pushCriteria(new RequestCriteria($request));
        $this->osperformanceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $osperformances = $this->osperformanceRepository->all();

        return $this->sendResponse($osperformances->toArray(), 'Osperformances retrieved successfully');
    }

    /**
     * Store a newly created Osperformance in storage.
     * POST /osperformances
     *
     * @param CreateOsperformanceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOsperformanceAPIRequest $request)
    {
        $input = $request->all();

        $osperformance = $this->osperformanceRepository->create($input);

        return $this->sendResponse($osperformance->toArray(), 'Osperformance saved successfully');
    }

    /**
     * Display the specified Osperformance.
     * GET|HEAD /osperformances/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Osperformance $osperformance */
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            return $this->sendError('Osperformance not found');
        }

        return $this->sendResponse($osperformance->toArray(), 'Osperformance retrieved successfully');
    }

    /**
     * Update the specified Osperformance in storage.
     * PUT/PATCH /osperformances/{id}
     *
     * @param  int $id
     * @param UpdateOsperformanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOsperformanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Osperformance $osperformance */
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            return $this->sendError('Osperformance not found');
        }

        $osperformance = $this->osperformanceRepository->update($input, $id);

        return $this->sendResponse($osperformance->toArray(), 'Osperformance updated successfully');
    }

    /**
     * Remove the specified Osperformance from storage.
     * DELETE /osperformances/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Osperformance $osperformance */
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            return $this->sendError('Osperformance not found');
        }

        $osperformance->delete();

        return $this->sendResponse($id, 'Osperformance deleted successfully');
    }
}
