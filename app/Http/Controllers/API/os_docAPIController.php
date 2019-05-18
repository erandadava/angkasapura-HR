<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createos_docAPIRequest;
use App\Http\Requests\API\Updateos_docAPIRequest;
use App\Models\os_doc;
use App\Repositories\os_docRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class os_docController
 * @package App\Http\Controllers\API
 */

class os_docAPIController extends AppBaseController
{
    /** @var  os_docRepository */
    private $osDocRepository;

    public function __construct(os_docRepository $osDocRepo)
    {
        $this->osDocRepository = $osDocRepo;
    }

    /**
     * Display a listing of the os_doc.
     * GET|HEAD /osDocs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->osDocRepository->pushCriteria(new RequestCriteria($request));
        $this->osDocRepository->pushCriteria(new LimitOffsetCriteria($request));
        $osDocs = $this->osDocRepository->all();

        return $this->sendResponse($osDocs->toArray(), 'Os Docs retrieved successfully');
    }

    /**
     * Store a newly created os_doc in storage.
     * POST /osDocs
     *
     * @param Createos_docAPIRequest $request
     *
     * @return Response
     */
    public function store(Createos_docAPIRequest $request)
    {
        $input = $request->all();

        $osDoc = $this->osDocRepository->create($input);

        return $this->sendResponse($osDoc->toArray(), 'Os Doc saved successfully');
    }

    /**
     * Display the specified os_doc.
     * GET|HEAD /osDocs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var os_doc $osDoc */
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            return $this->sendError('Os Doc not found');
        }

        return $this->sendResponse($osDoc->toArray(), 'Os Doc retrieved successfully');
    }

    /**
     * Update the specified os_doc in storage.
     * PUT/PATCH /osDocs/{id}
     *
     * @param  int $id
     * @param Updateos_docAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateos_docAPIRequest $request)
    {
        $input = $request->all();

        /** @var os_doc $osDoc */
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            return $this->sendError('Os Doc not found');
        }

        $osDoc = $this->osDocRepository->update($input, $id);

        return $this->sendResponse($osDoc->toArray(), 'os_doc updated successfully');
    }

    /**
     * Remove the specified os_doc from storage.
     * DELETE /osDocs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var os_doc $osDoc */
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            return $this->sendError('Os Doc not found');
        }

        $osDoc->delete();

        return $this->sendResponse($id, 'Os Doc deleted successfully');
    }
}
