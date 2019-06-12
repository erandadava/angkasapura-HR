<?php

namespace App\Http\Controllers;

use App\DataTables\unitkerjaDataTable;
use App\DataTables\formasiExistingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateunitkerjaRequest;
use App\Http\Requests\UpdateunitkerjaRequest;
use App\Repositories\unitkerjaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class unitkerjaController extends AppBaseController
{
    /** @var  unitkerjaRepository */
    private $unitkerjaRepository;

    public function __construct(unitkerjaRepository $unitkerjaRepo)
    {
        $this->unitkerjaRepository = $unitkerjaRepo;
    }

    /**
     * Display a listing of the unitkerja.
     *
     * @param unitkerjaDataTable $unitkerjaDataTable
     * @return Response
     */
    public function index(unitkerjaDataTable $unitkerjaDataTable)
    {
        return $unitkerjaDataTable->render('unitkerjas.index');
    }

    public function formasiExisting(formasiExistingDataTable $formasiExistingDataTable)
    {
        return $formasiExistingDataTable->render('unitkerjas.formasi');
    }

    /**
     * Show the form for creating a new unitkerja.
     *
     * @return Response
     */
    public function create()
    {
        return view('unitkerjas.create');
    }

    /**
     * Store a newly created unitkerja in storage.
     *
     * @param CreateunitkerjaRequest $request
     *
     * @return Response
     */
    public function store(CreateunitkerjaRequest $request)
    {
        $input = $request->all();

        $unitkerja = $this->unitkerjaRepository->create($input);

        Flash::success('Unitkerja saved successfully.');

        return redirect(route('unitkerjas.index'));
    }

    /**
     * Display the specified unitkerja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            Flash::error('Unitkerja not found');

            return redirect(route('unitkerjas.index'));
        }

        return view('unitkerjas.show')->with('unitkerja', $unitkerja);
    }

    /**
     * Show the form for editing the specified unitkerja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            Flash::error('Unitkerja not found');

            return redirect(route('unitkerjas.index'));
        }

        return view('unitkerjas.edit')->with('unitkerja', $unitkerja);
    }

    /**
     * Update the specified unitkerja in storage.
     *
     * @param  int              $id
     * @param UpdateunitkerjaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateunitkerjaRequest $request)
    {
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            Flash::error('Unitkerja not found');

            return redirect(route('unitkerjas.index'));
        }

        $unitkerja = $this->unitkerjaRepository->update($request->all(), $id);

        Flash::success('Unitkerja updated successfully.');

        return redirect(route('unitkerjas.index'));
    }

    /**
     * Remove the specified unitkerja from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unitkerja = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($unitkerja)) {
            Flash::error('Unitkerja not found');

            return redirect(route('unitkerjas.index'));
        }

        $this->unitkerjaRepository->delete($id);

        Flash::success('Unitkerja deleted successfully.');

        return redirect(route('unitkerjas.index'));
    }
}
