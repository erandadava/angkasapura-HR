<?php

namespace App\Http\Controllers;

use App\DataTables\tipekarDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatetipekarRequest;
use App\Http\Requests\UpdatetipekarRequest;
use App\Repositories\tipekarRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class tipekarController extends AppBaseController
{
    /** @var  tipekarRepository */
    private $tipekarRepository;

    public function __construct(tipekarRepository $tipekarRepo)
    {
        $this->tipekarRepository = $tipekarRepo;
    }

    /**
     * Display a listing of the tipekar.
     *
     * @param tipekarDataTable $tipekarDataTable
     * @return Response
     */
    public function index(tipekarDataTable $tipekarDataTable)
    {
        return $tipekarDataTable->render('tipekars.index');
    }

    /**
     * Show the form for creating a new tipekar.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipekars.create');
    }

    /**
     * Store a newly created tipekar in storage.
     *
     * @param CreatetipekarRequest $request
     *
     * @return Response
     */
    public function store(CreatetipekarRequest $request)
    {
        $input = $request->all();

        $tipekar = $this->tipekarRepository->create($input);

        Flash::success('Tipekar saved successfully.');

        return redirect(route('tipekars.index'));
    }

    /**
     * Display the specified tipekar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            Flash::error('Tipekar not found');

            return redirect(route('tipekars.index'));
        }

        return view('tipekars.show')->with('tipekar', $tipekar);
    }

    /**
     * Show the form for editing the specified tipekar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            Flash::error('Tipekar not found');

            return redirect(route('tipekars.index'));
        }

        return view('tipekars.edit')->with('tipekar', $tipekar);
    }

    /**
     * Update the specified tipekar in storage.
     *
     * @param  int              $id
     * @param UpdatetipekarRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetipekarRequest $request)
    {
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            Flash::error('Tipekar not found');

            return redirect(route('tipekars.index'));
        }

        $tipekar = $this->tipekarRepository->update($request->all(), $id);

        Flash::success('Tipekar updated successfully.');

        return redirect(route('tipekars.index'));
    }

    /**
     * Remove the specified tipekar from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipekar = $this->tipekarRepository->findWithoutFail($id);

        if (empty($tipekar)) {
            Flash::error('Tipekar not found');

            return redirect(route('tipekars.index'));
        }

        $this->tipekarRepository->delete($id);

        Flash::success('Tipekar deleted successfully.');

        return redirect(route('tipekars.index'));
    }
}
