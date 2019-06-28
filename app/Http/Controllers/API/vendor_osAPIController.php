<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createvendor_osAPIRequest;
use App\Http\Requests\API\Updatevendor_osAPIRequest;
use App\Models\vendor_os;
use App\Repositories\vendor_osRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class vendor_osController
 * @package App\Http\Controllers\API
 */

class vendor_osAPIController extends AppBaseController
{
    /** @var  vendor_osRepository */
    private $vendorOsRepository;

    public function __construct(vendor_osRepository $vendorOsRepo)
    {
        $this->vendorOsRepository = $vendorOsRepo;
    }

    /**
     * Display a listing of the vendor_os.
     * GET|HEAD /vendorOs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->vendorOsRepository->pushCriteria(new RequestCriteria($request));
        $this->vendorOsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $vendorOs = $this->vendorOsRepository->all();

        return $this->sendResponse($vendorOs->toArray(), 'Vendor Os retrieved successfully');
    }

    /**
     * Store a newly created vendor_os in storage.
     * POST /vendorOs
     *
     * @param Createvendor_osAPIRequest $request
     *
     * @return Response
     */
    public function store(Createvendor_osAPIRequest $request)
    {
        $input = $request->all();

        $vendorOs = $this->vendorOsRepository->create($input);

        return $this->sendResponse($vendorOs->toArray(), 'Vendor Os saved successfully');
    }

    /**
     * Display the specified vendor_os.
     * GET|HEAD /vendorOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var vendor_os $vendorOs */
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            return $this->sendError('Vendor Os not found');
        }

        return $this->sendResponse($vendorOs->toArray(), 'Vendor Os retrieved successfully');
    }

    /**
     * Update the specified vendor_os in storage.
     * PUT/PATCH /vendorOs/{id}
     *
     * @param  int $id
     * @param Updatevendor_osAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatevendor_osAPIRequest $request)
    {
        $input = $request->all();

        /** @var vendor_os $vendorOs */
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            return $this->sendError('Vendor Os not found');
        }

        $vendorOs = $this->vendorOsRepository->update($input, $id);

        return $this->sendResponse($vendorOs->toArray(), 'vendor_os updated successfully');
    }

    /**
     * Remove the specified vendor_os from storage.
     * DELETE /vendorOs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var vendor_os $vendorOs */
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            return $this->sendError('Vendor Os not found');
        }

        $vendorOs->delete();

        return $this->sendResponse($id, 'Vendor Os deleted successfully');
    }
}
