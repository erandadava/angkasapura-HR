<?php

namespace App\Http\Controllers;

use App\DataTables\osdocDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateosdocRequest;
use App\Http\Requests\UpdateosdocRequest;
use App\Repositories\osdocRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class osdocController extends AppBaseController
{
    /** @var  osdocRepository */
    private $osdocRepository;

    public function __construct(osdocRepository $osdocRepo)
    {
        $this->osdocRepository = $osdocRepo;
    }

    /**
     * Display a listing of the osdoc.
     *
     * @param osdocDataTable $osdocDataTable
     * @return Response
     */
    public function index(osdocDataTable $osdocDataTable)
    {
        return $osdocDataTable->render('osdocs.index');
    }

    /**
     * Show the form for creating a new osdoc.
     *
     * @return Response
     */
    public function create()
    {
        return view('osdocs.create');
    }

    /**
     * Store a newly created osdoc in storage.
     *
     * @param CreateosdocRequest $request
     *
     * @return Response
     */
    public function store(CreateosdocRequest $request)
    {
        $input = $request->all();

        $osdoc = $this->osdocRepository->create($input);

        Flash::success('Osdoc saved successfully.');

        return redirect(route('osdocs.index'));
    }

    /**
     * Display the specified osdoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            Flash::error('Osdoc not found');

            return redirect(route('osdocs.index'));
        }

        return view('osdocs.show')->with('osdoc', $osdoc);
    }

    /**
     * Show the form for editing the specified osdoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            Flash::error('Osdoc not found');

            return redirect(route('osdocs.index'));
        }

        return view('osdocs.edit')->with('osdoc', $osdoc);
    }

    /**
     * Update the specified osdoc in storage.
     *
     * @param  int              $id
     * @param UpdateosdocRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateosdocRequest $request)
    {
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            Flash::error('Osdoc not found');

            return redirect(route('osdocs.index'));
        }

        $osdoc = $this->osdocRepository->update($request->all(), $id);

        Flash::success('Osdoc updated successfully.');

        return redirect(route('osdocs.index'));
    }

    /**
     * Remove the specified osdoc from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $osdoc = $this->osdocRepository->findWithoutFail($id);

        if (empty($osdoc)) {
            Flash::error('Osdoc not found');

            return redirect(route('osdocs.index'));
        }

        $this->osdocRepository->delete($id);

        Flash::success('Osdoc deleted successfully.');

        return redirect(route('osdocs.index'));
    }
}
