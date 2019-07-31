<?php

namespace App\Http\Controllers;

use App\DataTables\kategori_unit_kerjaDataTable;
use App\Http\Requests;
use App\Http\Requests\Createkategori_unit_kerjaRequest;
use App\Http\Requests\Updatekategori_unit_kerjaRequest;
use App\Repositories\kategori_unit_kerjaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class kategori_unit_kerjaController extends AppBaseController
{
    /** @var  kategori_unit_kerjaRepository */
    private $kategoriUnitKerjaRepository;

    public function __construct(kategori_unit_kerjaRepository $kategoriUnitKerjaRepo)
    {
        $this->kategoriUnitKerjaRepository = $kategoriUnitKerjaRepo;
    }

    /**
     * Display a listing of the kategori_unit_kerja.
     *
     * @param kategori_unit_kerjaDataTable $kategoriUnitKerjaDataTable
     * @return Response
     */
    public function index(kategori_unit_kerjaDataTable $kategoriUnitKerjaDataTable)
    {
        return $kategoriUnitKerjaDataTable->render('kategori_unit_kerjas.index');
    }

    /**
     * Show the form for creating a new kategori_unit_kerja.
     *
     * @return Response
     */
    public function create()
    {
        return view('kategori_unit_kerjas.create');
    }

    /**
     * Store a newly created kategori_unit_kerja in storage.
     *
     * @param Createkategori_unit_kerjaRequest $request
     *
     * @return Response
     */
    public function store(Createkategori_unit_kerjaRequest $request)
    {
        $input = $request->all();

        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->create($input);

        Flash::success('Kategori Unit Kerja saved successfully.');

        return redirect(route('kategoriUnitKerjas.index'));
    }

    /**
     * Display the specified kategori_unit_kerja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            Flash::error('Kategori Unit Kerja not found');

            return redirect(route('kategoriUnitKerjas.index'));
        }

        return view('kategori_unit_kerjas.show')->with('kategoriUnitKerja', $kategoriUnitKerja);
    }

    /**
     * Show the form for editing the specified kategori_unit_kerja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            Flash::error('Kategori Unit Kerja not found');

            return redirect(route('kategoriUnitKerjas.index'));
        }

        return view('kategori_unit_kerjas.edit')->with('kategoriUnitKerja', $kategoriUnitKerja);
    }

    /**
     * Update the specified kategori_unit_kerja in storage.
     *
     * @param  int              $id
     * @param Updatekategori_unit_kerjaRequest $request
     *
     * @return Response
     */
    public function update($id, Updatekategori_unit_kerjaRequest $request)
    {
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            Flash::error('Kategori Unit Kerja not found');

            return redirect(route('kategoriUnitKerjas.index'));
        }

        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->update($request->all(), $id);

        Flash::success('Kategori Unit Kerja updated successfully.');

        return redirect(route('kategoriUnitKerjas.index'));
    }

    /**
     * Remove the specified kategori_unit_kerja from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            Flash::error('Kategori Unit Kerja not found');

            return redirect(route('kategoriUnitKerjas.index'));
        }

        $this->kategoriUnitKerjaRepository->delete($id);

        Flash::success('Kategori Unit Kerja deleted successfully.');

        return redirect(route('kategoriUnitKerjas.index'));
    }
}
