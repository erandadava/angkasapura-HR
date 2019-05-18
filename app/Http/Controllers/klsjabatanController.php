<?php

namespace App\Http\Controllers;

use App\DataTables\klsjabatanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateklsjabatanRequest;
use App\Http\Requests\UpdateklsjabatanRequest;
use App\Repositories\klsjabatanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class klsjabatanController extends AppBaseController
{
    /** @var  klsjabatanRepository */
    private $klsjabatanRepository;

    public function __construct(klsjabatanRepository $klsjabatanRepo)
    {
        $this->klsjabatanRepository = $klsjabatanRepo;
    }

    /**
     * Display a listing of the klsjabatan.
     *
     * @param klsjabatanDataTable $klsjabatanDataTable
     * @return Response
     */
    public function index(klsjabatanDataTable $klsjabatanDataTable)
    {
        return $klsjabatanDataTable->render('klsjabatans.index');
    }

    /**
     * Show the form for creating a new klsjabatan.
     *
     * @return Response
     */
    public function create()
    {
        return view('klsjabatans.create');
    }

    /**
     * Store a newly created klsjabatan in storage.
     *
     * @param CreateklsjabatanRequest $request
     *
     * @return Response
     */
    public function store(CreateklsjabatanRequest $request)
    {
        $input = $request->all();

        $klsjabatan = $this->klsjabatanRepository->create($input);

        Flash::success('Klsjabatan saved successfully.');

        return redirect(route('klsjabatans.index'));
    }

    /**
     * Display the specified klsjabatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            Flash::error('Klsjabatan not found');

            return redirect(route('klsjabatans.index'));
        }

        return view('klsjabatans.show')->with('klsjabatan', $klsjabatan);
    }

    /**
     * Show the form for editing the specified klsjabatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            Flash::error('Klsjabatan not found');

            return redirect(route('klsjabatans.index'));
        }

        return view('klsjabatans.edit')->with('klsjabatan', $klsjabatan);
    }

    /**
     * Update the specified klsjabatan in storage.
     *
     * @param  int              $id
     * @param UpdateklsjabatanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateklsjabatanRequest $request)
    {
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            Flash::error('Klsjabatan not found');

            return redirect(route('klsjabatans.index'));
        }

        $klsjabatan = $this->klsjabatanRepository->update($request->all(), $id);

        Flash::success('Klsjabatan updated successfully.');

        return redirect(route('klsjabatans.index'));
    }

    /**
     * Remove the specified klsjabatan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $klsjabatan = $this->klsjabatanRepository->findWithoutFail($id);

        if (empty($klsjabatan)) {
            Flash::error('Klsjabatan not found');

            return redirect(route('klsjabatans.index'));
        }

        $this->klsjabatanRepository->delete($id);

        Flash::success('Klsjabatan deleted successfully.');

        return redirect(route('klsjabatans.index'));
    }
}
