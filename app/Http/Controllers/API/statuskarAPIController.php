<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestatuskarAPIRequest;
use App\Http\Requests\API\UpdatestatuskarAPIRequest;
use App\Models\statuskar;
use App\Repositories\statuskarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class statuskarController
 * @package App\Http\Controllers\API
 */

class statuskarAPIController extends AppBaseController
{
    /** @var  statuskarRepository */
    private $statuskarRepository;

    public function __construct(statuskarRepository $statuskarRepo)
    {
        $this->statuskarRepository = $statuskarRepo;
    }

    /**
     * Display a listing of the statuskar.
     * GET|HEAD /statuskars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->statuskarRepository->pushCriteria(new RequestCriteria($request));
        $this->statuskarRepository->pushCriteria(new LimitOffsetCriteria($request));
        $statuskars = $this->statuskarRepository->all();

        return $this->sendResponse($statuskars->toArray(), 'Statuskars retrieved successfully');
    }

    /**
     * Store a newly created statuskar in storage.
     * POST /statuskars
     *
     * @param CreatestatuskarAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestatuskarAPIRequest $request)
    {
        $input = $request->all();

        $statuskar = $this->statuskarRepository->create($input);

        return $this->sendResponse($statuskar->toArray(), 'Statuskar saved successfully');
    }

    /**
     * Display the specified statuskar.
     * GET|HEAD /statuskars/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var statuskar $statuskar */
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            return $this->sendError('Statuskar not found');
        }

        return $this->sendResponse($statuskar->toArray(), 'Statuskar retrieved successfully');
    }

    /**
     * Update the specified statuskar in storage.
     * PUT/PATCH /statuskars/{id}
     *
     * @param  int $id
     * @param UpdatestatuskarAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatuskarAPIRequest $request)
    {
        $input = $request->all();

        /** @var statuskar $statuskar */
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            return $this->sendError('Statuskar not found');
        }

        $statuskar = $this->statuskarRepository->update($input, $id);

        return $this->sendResponse($statuskar->toArray(), 'statuskar updated successfully');
    }

    /**
     * Remove the specified statuskar from storage.
     * DELETE /statuskars/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var statuskar $statuskar */
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            return $this->sendError('Statuskar not found');
        }

        $statuskar->delete();

        return $this->sendResponse($id, 'Statuskar deleted successfully');
    }
}
