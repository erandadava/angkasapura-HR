<?php

namespace App\Http\Controllers;

use App\DataTables\mppDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemppRequest;
use App\Http\Requests\UpdatemppRequest;
use App\Repositories\KaryawanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class mppController extends AppBaseController
{
    /** @var  mppRepository */
    private $KaryawanRepository;

    public function __construct(KaryawanRepository $KaryawanRepo)
    {
        $this->KaryawanRepository = $KaryawanRepo;
    }

    /**
     * Display a listing of the mpp.
     *
     * @param mppDataTable $mppDataTable
     * @return Response
     */
    public function index(mppDataTable $mppDataTable)
    {
        // print(\App\Models\karyawan::find(1)->Age);
        return $mppDataTable->render('mpp.index');
    }

    /**
     * Show the form for creating a new mpp.
     *
     * @return Response
     */
    public function create()
    {
        return view('mpp.create');
    }

    /**
     * Store a newly created mpp in storage.
     *
     * @param CreatemppRequest $request
     *
     * @return Response
     */
    public function store(CreatemppRequest $request)
    {
        $input = $request->all();

        $mpp = $this->mppRepository->create($input);

        Flash::success('mpp saved successfully.');

        return redirect(route('mpp.index'));
    }

    /**
     * Display the specified mpp.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mpp = $this->KaryawanRepository->findWithoutFail($id);

        if (empty($mpp)) {
            Flash::error('mpp not found');

            return redirect(route('mpp.index'));
        }

        return view('mpp.show')->with('mpp', $mpp);
    }

    /**
     * Show the form for editing the specified mpp.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mpp = $this->KaryawanRepository->findWithoutFail($id);

        if (empty($mpp)) {
            Flash::error('mpp not found');

            return redirect(route('mpp.index'));
        }

        return view('mpp.edit')->with('mpp', $mpp);
    }

    /**
     * Update the specified mpp in storage.
     *
     * @param  int              $id
     * @param UpdatemppRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemppRequest $request)
    {
        $mpp = $this->KaryawanRepository->findWithoutFail($id);

        if (empty($mpp)) {
            Flash::error('mpp not found');

            return redirect(route('mpp.index'));
        }

        $mpp = $this->mppRepository->update($request->all(), $id);

        Flash::success('mpp updated successfully.');

        return redirect(route('mpp.index'));
    }

    /**
     * Remove the specified mpp from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mpp = $this->KaryawanRepository->findWithoutFail($id);

        if (empty($mpp)) {
            Flash::error('mpp not found');

            return redirect(route('mpp.index'));
        }

        $this->mppRepository->delete($id);

        Flash::success('mpp deleted successfully.');

        return redirect(route('mpp.index'));
    }
}
