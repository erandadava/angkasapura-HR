<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createkategori_unit_kerjaAPIRequest;
use App\Http\Requests\API\Updatekategori_unit_kerjaAPIRequest;
use App\Models\kategori_unit_kerja;
use App\Repositories\kategori_unit_kerjaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class kategori_unit_kerjaController
 * @package App\Http\Controllers\API
 */

class kategori_unit_kerjaAPIController extends AppBaseController
{
    /** @var  kategori_unit_kerjaRepository */
    private $kategoriUnitKerjaRepository;

    public function __construct(kategori_unit_kerjaRepository $kategoriUnitKerjaRepo)
    {
        $this->kategoriUnitKerjaRepository = $kategoriUnitKerjaRepo;
    }

    /**
     * Display a listing of the kategori_unit_kerja.
     * GET|HEAD /kategoriUnitKerjas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kategoriUnitKerjaRepository->pushCriteria(new RequestCriteria($request));
        $this->kategoriUnitKerjaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $kategoriUnitKerjas = $this->kategoriUnitKerjaRepository->all();

        return $this->sendResponse($kategoriUnitKerjas->toArray(), 'Kategori Unit Kerjas retrieved successfully');
    }

    /**
     * Store a newly created kategori_unit_kerja in storage.
     * POST /kategoriUnitKerjas
     *
     * @param Createkategori_unit_kerjaAPIRequest $request
     *
     * @return Response
     */
    public function store(Createkategori_unit_kerjaAPIRequest $request)
    {
        $input = $request->all();

        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->create($input);

        return $this->sendResponse($kategoriUnitKerja->toArray(), 'Kategori Unit Kerja saved successfully');
    }

    /**
     * Display the specified kategori_unit_kerja.
     * GET|HEAD /kategoriUnitKerjas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var kategori_unit_kerja $kategoriUnitKerja */
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            return $this->sendError('Kategori Unit Kerja not found');
        }

        return $this->sendResponse($kategoriUnitKerja->toArray(), 'Kategori Unit Kerja retrieved successfully');
    }

    /**
     * Update the specified kategori_unit_kerja in storage.
     * PUT/PATCH /kategoriUnitKerjas/{id}
     *
     * @param  int $id
     * @param Updatekategori_unit_kerjaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatekategori_unit_kerjaAPIRequest $request)
    {
        $input = $request->all();

        /** @var kategori_unit_kerja $kategoriUnitKerja */
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            return $this->sendError('Kategori Unit Kerja not found');
        }

        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->update($input, $id);

        return $this->sendResponse($kategoriUnitKerja->toArray(), 'kategori_unit_kerja updated successfully');
    }

    /**
     * Remove the specified kategori_unit_kerja from storage.
     * DELETE /kategoriUnitKerjas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var kategori_unit_kerja $kategoriUnitKerja */
        $kategoriUnitKerja = $this->kategoriUnitKerjaRepository->findWithoutFail($id);

        if (empty($kategoriUnitKerja)) {
            return $this->sendError('Kategori Unit Kerja not found');
        }

        $kategoriUnitKerja->delete();

        return $this->sendResponse($id, 'Kategori Unit Kerja deleted successfully');
    }
}
