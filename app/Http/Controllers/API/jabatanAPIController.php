<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatejabatanAPIRequest;
use App\Http\Requests\API\UpdatejabatanAPIRequest;
use App\Models\jabatan;
use App\Repositories\jabatanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class jabatanController
 * @package App\Http\Controllers\API
 */

class jabatanAPIController extends AppBaseController
{
    /** @var  jabatanRepository */
    private $jabatanRepository;

    public function __construct(jabatanRepository $jabatanRepo)
    {
        $this->jabatanRepository = $jabatanRepo;
    }

    /**
     * Display a listing of the jabatan.
     * GET|HEAD /jabatans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jabatanRepository->pushCriteria(new RequestCriteria($request));
        $this->jabatanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jabatans = $this->jabatanRepository->all();

        return $this->sendResponse($jabatans->toArray(), 'Jabatans retrieved successfully');
    }

    /**
     * Store a newly created jabatan in storage.
     * POST /jabatans
     *
     * @param CreatejabatanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatejabatanAPIRequest $request)
    {
        $input = $request->all();

        $jabatan = $this->jabatanRepository->create($input);

        return $this->sendResponse($jabatan->toArray(), 'Jabatan saved successfully');
    }

    /**
     * Display the specified jabatan.
     * GET|HEAD /jabatans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var jabatan $jabatan */
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            return $this->sendError('Jabatan not found');
        }

        return $this->sendResponse($jabatan->toArray(), 'Jabatan retrieved successfully');
    }

    /**
     * Update the specified jabatan in storage.
     * PUT/PATCH /jabatans/{id}
     *
     * @param  int $id
     * @param UpdatejabatanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejabatanAPIRequest $request)
    {
        $input = $request->all();

        /** @var jabatan $jabatan */
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            return $this->sendError('Jabatan not found');
        }

        $jabatan = $this->jabatanRepository->update($input, $id);

        return $this->sendResponse($jabatan->toArray(), 'jabatan updated successfully');
    }

    /**
     * Remove the specified jabatan from storage.
     * DELETE /jabatans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var jabatan $jabatan */
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            return $this->sendError('Jabatan not found');
        }

        $jabatan->delete();

        return $this->sendResponse($id, 'Jabatan deleted successfully');
    }
}
