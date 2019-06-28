<?php

namespace App\Http\Controllers;

use App\DataTables\fungsi_osDataTable;
use App\Http\Requests;
use App\Http\Requests\Createfungsi_osRequest;
use App\Http\Requests\Updatefungsi_osRequest;
use App\Repositories\fungsi_osRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class fungsi_osController extends AppBaseController
{
    /** @var  fungsi_osRepository */
    private $fungsiOsRepository;

    public function __construct(fungsi_osRepository $fungsiOsRepo)
    {
        $this->fungsiOsRepository = $fungsiOsRepo;
    }

    /**
     * Display a listing of the fungsi_os.
     *
     * @param fungsi_osDataTable $fungsiOsDataTable
     * @return Response
     */
    public function index(fungsi_osDataTable $fungsiOsDataTable)
    {
        return $fungsiOsDataTable->render('fungsi_os.index');
    }

    /**
     * Show the form for creating a new fungsi_os.
     *
     * @return Response
     */
    public function create()
    {
        return view('fungsi_os.create');
    }

    /**
     * Store a newly created fungsi_os in storage.
     *
     * @param Createfungsi_osRequest $request
     *
     * @return Response
     */
    public function store(Createfungsi_osRequest $request)
    {
        $input = $request->all();

        $fungsiOs = $this->fungsiOsRepository->create($input);

        Flash::success('Fungsi Os saved successfully.');

        return redirect(route('fungsiOs.index'));
    }

    /**
     * Display the specified fungsi_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            Flash::error('Fungsi Os not found');

            return redirect(route('fungsiOs.index'));
        }

        return view('fungsi_os.show')->with('fungsiOs', $fungsiOs);
    }

    /**
     * Show the form for editing the specified fungsi_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            Flash::error('Fungsi Os not found');

            return redirect(route('fungsiOs.index'));
        }

        return view('fungsi_os.edit')->with('fungsiOs', $fungsiOs);
    }

    /**
     * Update the specified fungsi_os in storage.
     *
     * @param  int              $id
     * @param Updatefungsi_osRequest $request
     *
     * @return Response
     */
    public function update($id, Updatefungsi_osRequest $request)
    {
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            Flash::error('Fungsi Os not found');

            return redirect(route('fungsiOs.index'));
        }

        $fungsiOs = $this->fungsiOsRepository->update($request->all(), $id);

        Flash::success('Fungsi Os updated successfully.');

        return redirect(route('fungsiOs.index'));
    }

    /**
     * Remove the specified fungsi_os from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fungsiOs = $this->fungsiOsRepository->findWithoutFail($id);

        if (empty($fungsiOs)) {
            Flash::error('Fungsi Os not found');

            return redirect(route('fungsiOs.index'));
        }

        $this->fungsiOsRepository->delete($id);

        Flash::success('Fungsi Os deleted successfully.');

        return redirect(route('fungsiOs.index'));
    }
}
