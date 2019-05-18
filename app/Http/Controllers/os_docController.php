<?php

namespace App\Http\Controllers;

use App\DataTables\os_docDataTable;
use App\Http\Requests;
use App\Http\Requests\Createos_docRequest;
use App\Http\Requests\Updateos_docRequest;
use App\Repositories\os_docRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class os_docController extends AppBaseController
{
    /** @var  os_docRepository */
    private $osDocRepository;

    public function __construct(os_docRepository $osDocRepo)
    {
        $this->osDocRepository = $osDocRepo;
    }

    /**
     * Display a listing of the os_doc.
     *
     * @param os_docDataTable $osDocDataTable
     * @return Response
     */
    public function index(os_docDataTable $osDocDataTable)
    {
        return $osDocDataTable->render('os_docs.index');
    }

    /**
     * Show the form for creating a new os_doc.
     *
     * @return Response
     */
    public function create()
    {
        return view('os_docs.create');
    }

    /**
     * Store a newly created os_doc in storage.
     *
     * @param Createos_docRequest $request
     *
     * @return Response
     */
    public function store(Createos_docRequest $request)
    {
        $input = $request->all();

        $osDoc = $this->osDocRepository->create($input);

        Flash::success('Os Doc saved successfully.');

        return redirect(route('osDocs.index'));
    }

    /**
     * Display the specified os_doc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            Flash::error('Os Doc not found');

            return redirect(route('osDocs.index'));
        }

        return view('os_docs.show')->with('osDoc', $osDoc);
    }

    /**
     * Show the form for editing the specified os_doc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            Flash::error('Os Doc not found');

            return redirect(route('osDocs.index'));
        }

        return view('os_docs.edit')->with('osDoc', $osDoc);
    }

    /**
     * Update the specified os_doc in storage.
     *
     * @param  int              $id
     * @param Updateos_docRequest $request
     *
     * @return Response
     */
    public function update($id, Updateos_docRequest $request)
    {
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            Flash::error('Os Doc not found');

            return redirect(route('osDocs.index'));
        }

        $osDoc = $this->osDocRepository->update($request->all(), $id);

        Flash::success('Os Doc updated successfully.');

        return redirect(route('osDocs.index'));
    }

    /**
     * Remove the specified os_doc from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $osDoc = $this->osDocRepository->findWithoutFail($id);

        if (empty($osDoc)) {
            Flash::error('Os Doc not found');

            return redirect(route('osDocs.index'));
        }

        $this->osDocRepository->delete($id);

        Flash::success('Os Doc deleted successfully.');

        return redirect(route('osDocs.index'));
    }
}
