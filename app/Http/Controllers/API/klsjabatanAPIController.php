<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateklsjabatanAPIRequest;
use App\Http\Requests\API\UpdateklsjabatanAPIRequest;
use App\Models\klsjabatan;
use App\Repositories\klsjabatanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class klsjabatanController
 * @package App\Http\Controllers\API
 */

class klsjabatanAPIController extends AppBaseController
{
    /** @var  klsjabatanRepository */
    private $klsjabatanRepository;

    public function __construct(klsjabatanRepository $klsjabatanRepo)
    {
        $this->klsjabatanRepository = $klsjabatanRepo;
    }

    /**
     * Display a listing of the klsjabatan.
     * GET|HEAD /klsjabatans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->klsjabatanRepository->pushCriteria(new RequestCriteria($request));
        $this->klsjabatanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $klsjabatans = $this->klsjabatanRepository->all();

        return $this->sendResponse($klsjabatans->toArray(), 'Klsjabatans retrieved successfully');
    }

    /**
     * Store a newly created klsjabatan in storage.
     * POST /klsjabatans
     *
     * @param CreateklsjabatanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateklsjabatanAPIRequest $request)
    {
        $input = $request->all();

        $klsjabatan = $this->klsjabatanRepository->create($input);

        return $this->sendResponse($klsjabatan->toArray(), 'Klsjabatan saved successfully');
    }

    /**
     * Display the specified klsjabatan.
     * GET|HEAD /klsjabatans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var klsjabatan $klsjabatan */
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            return $this->sendError('Klsjabatan not found');
        }

        return $this->sendResponse($klsjabatan->toArray(), 'Klsjabatan retrieved successfully');
    }

    /**
     * Update the specified klsjabatan in storage.
     * PUT/PATCH /klsjabatans/{id}
     *
     * @param  int $id
     * @param UpdateklsjabatanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateklsjabatanAPIRequest $request)
    {
        $input = $request->all();

        /** @var klsjabatan $klsjabatan */
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            return $this->sendError('Klsjabatan not found');
        }

        $klsjabatan = $this->klsjabatanRepository->update($input, $id);

        return $this->sendResponse($klsjabatan->toArray(), 'klsjabatan updated successfully');
    }

    /**
     * Remove the specified klsjabatan from storage.
     * DELETE /klsjabatans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var klsjabatan $klsjabatan */
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            return $this->sendError('Klsjabatan not found');
        }

        $klsjabatan->delete();

        return $this->sendResponse($id, 'Klsjabatan deleted successfully');
    }
}
