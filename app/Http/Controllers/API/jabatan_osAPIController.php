<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createjabatan_osAPIRequest;
use App\Http\Requests\API\Updatejabatan_osAPIRequest;
use App\Models\jabatan_os;
use App\Repositories\jabatan_osRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class jabatan_osController
 * @package App\Http\Controllers\API
 */

class jabatan_osAPIController extends AppBaseController
{
    /** @var  jabatan_osRepository */
    private $jabatanOsRepository;

    public function __construct(jabatan_osRepository $jabatanOsRepo)
    {
        $this->jabatanOsRepository = $jabatanOsRepo;
    }

    /**
     * Display a listing of the jabatan_os.
     * GET|HEAD /jabatanOs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jabatanOsRepository->pushCriteria(new RequestCriteria($request));
        $this->jabatanOsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jabatanOs = $this->jabatanOsRepository->all();

        return $this->sendResponse($jabatanOs->toArray(), 'Jabatan Os retrieved successfully');
    }

    /**
     * Store a newly created jabatan_os in storage.
     * POST /jabatanOs
     *
     * @param Createjabatan_osAPIRequest $request
     *
     * @return Response
     */
    public function store(Createjabatan_osAPIRequest $request)
    {
        $input = $request->all();

        $jabatanOs = $this->jabatanOsRepository->create($input);

        return $this->sendResponse($jabatanOs->toArray(), 'Jabatan Os saved successfully');
    }

    /**
     * Display the specified jabatan_os.
     * GET|HEAD /jabatanOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var jabatan_os $jabatanOs */
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            return $this->sendError('Jabatan Os not found');
        }

        return $this->sendResponse($jabatanOs->toArray(), 'Jabatan Os retrieved successfully');
    }

    /**
     * Update the specified jabatan_os in storage.
     * PUT/PATCH /jabatanOs/{id}
     *
     * @param  int $id
     * @param Updatejabatan_osAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatejabatan_osAPIRequest $request)
    {
        $input = $request->all();

        /** @var jabatan_os $jabatanOs */
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            return $this->sendError('Jabatan Os not found');
        }

        $jabatanOs = $this->jabatanOsRepository->update($input, $id);

        return $this->sendResponse($jabatanOs->toArray(), 'jabatan_os updated successfully');
    }

    /**
     * Remove the specified jabatan_os from storage.
     * DELETE /jabatanOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var jabatan_os $jabatanOs */
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            return $this->sendError('Jabatan Os not found');
        }

        $jabatanOs->delete();

        return $this->sendResponse($id, 'Jabatan Os deleted successfully');
    }
}
