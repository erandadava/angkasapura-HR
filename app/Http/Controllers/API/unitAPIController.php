<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateunitAPIRequest;
use App\Http\Requests\API\UpdateunitAPIRequest;
use App\Models\unit;
use App\Repositories\unitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class unitController
 * @package App\Http\Controllers\API
 */

class unitAPIController extends AppBaseController
{
    /** @var  unitRepository */
    private $unitRepository;

    public function __construct(unitRepository $unitRepo)
    {
        $this->unitRepository = $unitRepo;
    }

    /**
     * Display a listing of the unit.
     * GET|HEAD /units
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->unitRepository->pushCriteria(new RequestCriteria($request));
        $this->unitRepository->pushCriteria(new LimitOffsetCriteria($request));
        $units = $this->unitRepository->all();

        return $this->sendResponse($units->toArray(), 'Units retrieved successfully');
    }

    /**
     * Store a newly created unit in storage.
     * POST /units
     *
     * @param CreateunitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateunitAPIRequest $request)
    {
        $input = $request->all();

        $unit = $this->unitRepository->create($input);

        return $this->sendResponse($unit->toArray(), 'Unit saved successfully');
    }

    /**
     * Display the specified unit.
     * GET|HEAD /units/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var unit $unit */
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            return $this->sendError('Unit not found');
        }

        return $this->sendResponse($unit->toArray(), 'Unit retrieved successfully');
    }

    /**
     * Update the specified unit in storage.
     * PUT/PATCH /units/{id}
     *
     * @param  int $id
     * @param UpdateunitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateunitAPIRequest $request)
    {
        $input = $request->all();

        /** @var unit $unit */
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            return $this->sendError('Unit not found');
        }

        $unit = $this->unitRepository->update($input, $id);

        return $this->sendResponse($unit->toArray(), 'unit updated successfully');
    }

    /**
     * Remove the specified unit from storage.
     * DELETE /units/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var unit $unit */
        $unit = $this->unitRepository->findWithoutFail($id);

        if (empty($unit)) {
            return $this->sendError('Unit not found');
        }

        $unit->delete();

        return $this->sendResponse($id, 'Unit deleted successfully');
    }
}
