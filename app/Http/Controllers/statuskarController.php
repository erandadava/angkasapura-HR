<?php

namespace App\Http\Controllers;

use App\DataTables\statuskarDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestatuskarRequest;
use App\Http\Requests\UpdatestatuskarRequest;
use App\Repositories\statuskarRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class statuskarController extends AppBaseController
{
    /** @var  statuskarRepository */
    private $statuskarRepository;

    public function __construct(statuskarRepository $statuskarRepo)
    {
        $this->statuskarRepository = $statuskarRepo;
    }

    /**
     * Display a listing of the statuskar.
     *
     * @param statuskarDataTable $statuskarDataTable
     * @return Response
     */
    public function index(statuskarDataTable $statuskarDataTable)
    {
        return $statuskarDataTable->render('statuskars.index');
    }

    /**
     * Show the form for creating a new statuskar.
     *
     * @return Response
     */
    public function create()
    {
        return view('statuskars.create');
    }

    /**
     * Store a newly created statuskar in storage.
     *
     * @param CreatestatuskarRequest $request
     *
     * @return Response
     */
    public function store(CreatestatuskarRequest $request)
    {
        $input = $request->all();

        $statuskar = $this->statuskarRepository->create($input);

        Flash::success('Statuskar saved successfully.');

        return redirect(route('statuskars.index'));
    }

    /**
     * Display the specified statuskar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            Flash::error('Statuskar not found');

            return redirect(route('statuskars.index'));
        }

        return view('statuskars.show')->with('statuskar', $statuskar);
    }

    /**
     * Show the form for editing the specified statuskar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            Flash::error('Statuskar not found');

            return redirect(route('statuskars.index'));
        }

        return view('statuskars.edit')->with('statuskar', $statuskar);
    }

    /**
     * Update the specified statuskar in storage.
     *
     * @param  int              $id
     * @param UpdatestatuskarRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatuskarRequest $request)
    {
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            Flash::error('Statuskar not found');

            return redirect(route('statuskars.index'));
        }

        $statuskar = $this->statuskarRepository->update($request->all(), $id);

        Flash::success('Statuskar updated successfully.');

        return redirect(route('statuskars.index'));
    }

    /**
     * Remove the specified statuskar from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statuskar = $this->statuskarRepository->findWithoutFail($id);

        if (empty($statuskar)) {
            Flash::error('Statuskar not found');

            return redirect(route('statuskars.index'));
        }

        $this->statuskarRepository->delete($id);

        Flash::success('Statuskar deleted successfully.');

        return redirect(route('statuskars.index'));
    }
}
