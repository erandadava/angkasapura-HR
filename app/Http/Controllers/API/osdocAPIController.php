<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateosdocAPIRequest;
use App\Http\Requests\API\UpdateosdocAPIRequest;
use App\Models\osdoc;
use App\Repositories\osdocRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class osdocController
 * @package App\Http\Controllers\API
 */

class osdocAPIController extends AppBaseController
{
    /** @var  osdocRepository */
    private $osdocRepository;

    public function __construct(osdocRepository $osdocRepo)
    {
        $this->osdocRepository = $osdocRepo;
    }

    /**
     * Display a listing of the osdoc.
     * GET|HEAD /osdocs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->osdocRepository->pushCriteria(new RequestCriteria($request));
        $this->osdocRepository->pushCriteria(new LimitOffsetCriteria($request));
        $osdocs = $this->osdocRepository->all();

        return $this->sendResponse($osdocs->toArray(), 'Osdocs retrieved successfully');
    }

    /**
     * Store a newly created osdoc in storage.
     * POST /osdocs
     *
     * @param CreateosdocAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateosdocAPIRequest $request)
    {
        $input = $request->all();

        $osdoc = $this->osdocRepository->create($input);

        return $this->sendResponse($osdoc->toArray(), 'Osdoc saved successfully');
    }

    /**
     * Display the specified osdoc.
     * GET|HEAD /osdocs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var osdoc $osdoc */
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            return $this->sendError('Osdoc not found');
        }

        return $this->sendResponse($osdoc->toArray(), 'Osdoc retrieved successfully');
    }

    /**
     * Update the specified osdoc in storage.
     * PUT/PATCH /osdocs/{id}
     *
     * @param  int $id
     * @param UpdateosdocAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateosdocAPIRequest $request)
    {
        $input = $request->all();

        /** @var osdoc $osdoc */
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            return $this->sendError('Osdoc not found');
        }

        $osdoc = $this->osdocRepository->update($input, $id);

        return $this->sendResponse($osdoc->toArray(), 'osdoc updated successfully');
    }

    /**
     * Remove the specified osdoc from storage.
     * DELETE /osdocs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var osdoc $osdoc */
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            return $this->sendError('Osdoc not found');
        }

        $osdoc->delete();

        return $this->sendResponse($id, 'Osdoc deleted successfully');
    }
}
