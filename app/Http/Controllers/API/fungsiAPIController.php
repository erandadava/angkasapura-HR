<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatefungsiAPIRequest;
use App\Http\Requests\API\UpdatefungsiAPIRequest;
use App\Models\fungsi;
use App\Repositories\fungsiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class fungsiController
 * @package App\Http\Controllers\API
 */

class fungsiAPIController extends AppBaseController
{
    /** @var  fungsiRepository */
    private $fungsiRepository;

    public function __construct(fungsiRepository $fungsiRepo)
    {
        $this->fungsiRepository = $fungsiRepo;
    }

    /**
     * Display a listing of the fungsi.
     * GET|HEAD /fungsis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fungsiRepository->pushCriteria(new RequestCriteria($request));
        $this->fungsiRepository->pushCriteria(new LimitOffsetCriteria($request));
        $fungsis = $this->fungsiRepository->all();

        return $this->sendResponse($fungsis->toArray(), 'Fungsis retrieved successfully');
    }

    /**
     * Store a newly created fungsi in storage.
     * POST /fungsis
     *
     * @param CreatefungsiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatefungsiAPIRequest $request)
    {
        $input = $request->all();

        $fungsi = $this->fungsiRepository->create($input);

        return $this->sendResponse($fungsi->toArray(), 'Fungsi saved successfully');
    }

    /**
     * Display the specified fungsi.
     * GET|HEAD /fungsis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var fungsi $fungsi */
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            return $this->sendError('Fungsi not found');
        }

        return $this->sendResponse($fungsi->toArray(), 'Fungsi retrieved successfully');
    }

    /**
     * Update the specified fungsi in storage.
     * PUT/PATCH /fungsis/{id}
     *
     * @param  int $id
     * @param UpdatefungsiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefungsiAPIRequest $request)
    {
        $input = $request->all();

        /** @var fungsi $fungsi */
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            return $this->sendError('Fungsi not found');
        }

        $fungsi = $this->fungsiRepository->update($input, $id);

        return $this->sendResponse($fungsi->toArray(), 'fungsi updated successfully');
    }

    /**
     * Remove the specified fungsi from storage.
     * DELETE /fungsis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var fungsi $fungsi */
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            return $this->sendError('Fungsi not found');
        }

        $fungsi->delete();

        return $this->sendResponse($id, 'Fungsi deleted successfully');
    }
}
