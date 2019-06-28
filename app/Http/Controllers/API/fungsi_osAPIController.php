<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createfungsi_osAPIRequest;
use App\Http\Requests\API\Updatefungsi_osAPIRequest;
use App\Models\fungsi_os;
use App\Repositories\fungsi_osRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class fungsi_osController
 * @package App\Http\Controllers\API
 */

class fungsi_osAPIController extends AppBaseController
{
    /** @var  fungsi_osRepository */
    private $fungsiOsRepository;

    public function __construct(fungsi_osRepository $fungsiOsRepo)
    {
        $this->fungsiOsRepository = $fungsiOsRepo;
    }

    /**
     * Display a listing of the fungsi_os.
     * GET|HEAD /fungsiOs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fungsiOsRepository->pushCriteria(new RequestCriteria($request));
        $this->fungsiOsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $fungsiOs = $this->fungsiOsRepository->all();

        return $this->sendResponse($fungsiOs->toArray(), 'Fungsi Os retrieved successfully');
    }

    /**
     * Store a newly created fungsi_os in storage.
     * POST /fungsiOs
     *
     * @param Createfungsi_osAPIRequest $request
     *
     * @return Response
     */
    public function store(Createfungsi_osAPIRequest $request)
    {
        $input = $request->all();

        $fungsiOs = $this->fungsiOsRepository->create($input);

        return $this->sendResponse($fungsiOs->toArray(), 'Fungsi Os saved successfully');
    }

    /**
     * Display the specified fungsi_os.
     * GET|HEAD /fungsiOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var fungsi_os $fungsiOs */
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            return $this->sendError('Fungsi Os not found');
        }

        return $this->sendResponse($fungsiOs->toArray(), 'Fungsi Os retrieved successfully');
    }

    /**
     * Update the specified fungsi_os in storage.
     * PUT/PATCH /fungsiOs/{id}
     *
     * @param  int $id
     * @param Updatefungsi_osAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatefungsi_osAPIRequest $request)
    {
        $input = $request->all();

        /** @var fungsi_os $fungsiOs */
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            return $this->sendError('Fungsi Os not found');
        }

        $fungsiOs = $this->fungsiOsRepository->update($input, $id);

        return $this->sendResponse($fungsiOs->toArray(), 'fungsi_os updated successfully');
    }

    /**
     * Remove the specified fungsi_os from storage.
     * DELETE /fungsiOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var fungsi_os $fungsiOs */
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            return $this->sendError('Fungsi Os not found');
        }

        $fungsiOs->delete();

        return $this->sendResponse($id, 'Fungsi Os deleted successfully');
    }
}
