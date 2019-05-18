<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateunitkerjaAPIRequest;
use App\Http\Requests\API\UpdateunitkerjaAPIRequest;
use App\Models\unitkerja;
use App\Repositories\unitkerjaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class unitkerjaController
 * @package App\Http\Controllers\API
 */

class unitkerjaAPIController extends AppBaseController
{
    /** @var  unitkerjaRepository */
    private $unitkerjaRepository;

    public function __construct(unitkerjaRepository $unitkerjaRepo)
    {
        $this->unitkerjaRepository = $unitkerjaRepo;
    }

    /**
     * Display a listing of the unitkerja.
     * GET|HEAD /unitkerjas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->unitkerjaRepository->pushCriteria(new RequestCriteria($request));
        $this->unitkerjaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $unitkerjas = $this->unitkerjaRepository->all();

        return $this->sendResponse($unitkerjas->toArray(), 'Unitkerjas retrieved successfully');
    }

    /**
     * Store a newly created unitkerja in storage.
     * POST /unitkerjas
     *
     * @param CreateunitkerjaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateunitkerjaAPIRequest $request)
    {
        $input = $request->all();

        $unitkerja = $this->unitkerjaRepository->create($input);

        return $this->sendResponse($unitkerja->toArray(), 'Unitkerja saved successfully');
    }

    /**
     * Display the specified unitkerja.
     * GET|HEAD /unitkerjas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var unitkerja $unitkerja */
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            return $this->sendError('Unitkerja not found');
        }

        return $this->sendResponse($unitkerja->toArray(), 'Unitkerja retrieved successfully');
    }

    /**
     * Update the specified unitkerja in storage.
     * PUT/PATCH /unitkerjas/{id}
     *
     * @param  int $id
     * @param UpdateunitkerjaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateunitkerjaAPIRequest $request)
    {
        $input = $request->all();

        /** @var unitkerja $unitkerja */
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            return $this->sendError('Unitkerja not found');
        }

        $unitkerja = $this->unitkerjaRepository->update($input, $id);

        return $this->sendResponse($unitkerja->toArray(), 'unitkerja updated successfully');
    }

    /**
     * Remove the specified unitkerja from storage.
     * DELETE /unitkerjas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var unitkerja $unitkerja */
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            return $this->sendError('Unitkerja not found');
        }

        $unitkerja->delete();

        return $this->sendResponse($id, 'Unitkerja deleted successfully');
    }
}
