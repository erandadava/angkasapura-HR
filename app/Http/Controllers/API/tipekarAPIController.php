<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetipekarAPIRequest;
use App\Http\Requests\API\UpdatetipekarAPIRequest;
use App\Models\tipekar;
use App\Repositories\tipekarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class tipekarController
 * @package App\Http\Controllers\API
 */

class tipekarAPIController extends AppBaseController
{
    /** @var  tipekarRepository */
    private $tipekarRepository;

    public function __construct(tipekarRepository $tipekarRepo)
    {
        $this->tipekarRepository = $tipekarRepo;
    }

    /**
     * Display a listing of the tipekar.
     * GET|HEAD /tipekars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipekarRepository->pushCriteria(new RequestCriteria($request));
        $this->tipekarRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tipekars = $this->tipekarRepository->all();

        return $this->sendResponse($tipekars->toArray(), 'Tipekars retrieved successfully');
    }

    /**
     * Store a newly created tipekar in storage.
     * POST /tipekars
     *
     * @param CreatetipekarAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetipekarAPIRequest $request)
    {
        $input = $request->all();

        $tipekar = $this->tipekarRepository->create($input);

        return $this->sendResponse($tipekar->toArray(), 'Tipekar saved successfully');
    }

    /**
     * Display the specified tipekar.
     * GET|HEAD /tipekars/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var tipekar $tipekar */
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            return $this->sendError('Tipekar not found');
        }

        return $this->sendResponse($tipekar->toArray(), 'Tipekar retrieved successfully');
    }

    /**
     * Update the specified tipekar in storage.
     * PUT/PATCH /tipekars/{id}
     *
     * @param  int $id
     * @param UpdatetipekarAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetipekarAPIRequest $request)
    {
        $input = $request->all();

        /** @var tipekar $tipekar */
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            return $this->sendError('Tipekar not found');
        }

        $tipekar = $this->tipekarRepository->update($input, $id);

        return $this->sendResponse($tipekar->toArray(), 'tipekar updated successfully');
    }

    /**
     * Remove the specified tipekar from storage.
     * DELETE /tipekars/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var tipekar $tipekar */
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            return $this->sendError('Tipekar not found');
        }

        $tipekar->delete();

        return $this->sendResponse($id, 'Tipekar deleted successfully');
    }
}
