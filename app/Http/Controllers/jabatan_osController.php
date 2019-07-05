<?php

namespace App\Http\Controllers;

use App\DataTables\jabatan_osDataTable;
use App\Http\Requests;
use App\Http\Requests\Createjabatan_osRequest;
use App\Http\Requests\Updatejabatan_osRequest;
use App\Repositories\jabatan_osRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class jabatan_osController extends AppBaseController
{
    /** @var  jabatan_osRepository */
    private $jabatanOsRepository;

    public function __construct(jabatan_osRepository $jabatanOsRepo)
    {
        $this->jabatanOsRepository = $jabatanOsRepo;
    }

    /**
     * Display a listing of the jabatan_os.
     *
     * @param jabatan_osDataTable $jabatanOsDataTable
     * @return Response
     */
    public function index(jabatan_osDataTable $jabatanOsDataTable)
    {
        return $jabatanOsDataTable->render('jabatan_os.index');
    }

    /**
     * Show the form for creating a new jabatan_os.
     *
     * @return Response
     */
    public function create()
    {
        return view('jabatan_os.create');
    }

    /**
     * Store a newly created jabatan_os in storage.
     *
     * @param Createjabatan_osRequest $request
     *
     * @return Response
     */
    public function store(Createjabatan_osRequest $request)
    {
        $input = $request->all();

        $jabatanOs = $this->jabatanOsRepository->create($input);

        Flash::success('Jabatan Os saved successfully.');

        return redirect(route('jabatanOs.index'));
    }

    /**
     * Display the specified jabatan_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            Flash::error('Jabatan Os not found');

            return redirect(route('jabatanOs.index'));
        }

        return view('jabatan_os.show')->with('jabatanOs', $jabatanOs);
    }

    /**
     * Show the form for editing the specified jabatan_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            Flash::error('Jabatan Os not found');

            return redirect(route('jabatanOs.index'));
        }

        return view('jabatan_os.edit')->with('jabatanOs', $jabatanOs);
    }

    /**
     * Update the specified jabatan_os in storage.
     *
     * @param  int              $id
     * @param Updatejabatan_osRequest $request
     *
     * @return Response
     */
    public function update($id, Updatejabatan_osRequest $request)
    {
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            Flash::error('Jabatan Os not found');

            return redirect(route('jabatanOs.index'));
        }

        $jabatanOs = $this->jabatanOsRepository->update($request->all(), $id);

        Flash::success('Jabatan Os updated successfully.');

        return redirect(route('jabatanOs.index'));
    }

    /**
     * Remove the specified jabatan_os from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jabatanOs = $this->jabatanOsRepository->findWithoutFail($id);

        if (empty($jabatanOs)) {
            Flash::error('Jabatan Os not found');

            return redirect(route('jabatanOs.index'));
        }

        $this->jabatanOsRepository->delete($id);

        Flash::success('Jabatan Os deleted successfully.');

        return redirect(route('jabatanOs.index'));
    }
}
