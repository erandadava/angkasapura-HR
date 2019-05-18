<?php

namespace App\Http\Controllers;

use App\DataTables\fungsiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatefungsiRequest;
use App\Http\Requests\UpdatefungsiRequest;
use App\Repositories\fungsiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class fungsiController extends AppBaseController
{
    /** @var  fungsiRepository */
    private $fungsiRepository;

    public function __construct(fungsiRepository $fungsiRepo)
    {
        $this->fungsiRepository = $fungsiRepo;
    }

    /**
     * Display a listing of the fungsi.
     *
     * @param fungsiDataTable $fungsiDataTable
     * @return Response
     */
    public function index(fungsiDataTable $fungsiDataTable)
    {
        return $fungsiDataTable->render('fungsis.index');
    }

    /**
     * Show the form for creating a new fungsi.
     *
     * @return Response
     */
    public function create()
    {
        return view('fungsis.create');
    }

    /**
     * Store a newly created fungsi in storage.
     *
     * @param CreatefungsiRequest $request
     *
     * @return Response
     */
    public function store(CreatefungsiRequest $request)
    {
        $input = $request->all();

        $fungsi = $this->fungsiRepository->create($input);

        Flash::success('Fungsi saved successfully.');

        return redirect(route('fungsis.index'));
    }

    /**
     * Display the specified fungsi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            Flash::error('Fungsi not found');

            return redirect(route('fungsis.index'));
        }

        return view('fungsis.show')->with('fungsi', $fungsi);
    }

    /**
     * Show the form for editing the specified fungsi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            Flash::error('Fungsi not found');

            return redirect(route('fungsis.index'));
        }

        return view('fungsis.edit')->with('fungsi', $fungsi);
    }

    /**
     * Update the specified fungsi in storage.
     *
     * @param  int              $id
     * @param UpdatefungsiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefungsiRequest $request)
    {
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            Flash::error('Fungsi not found');

            return redirect(route('fungsis.index'));
        }

        $fungsi = $this->fungsiRepository->update($request->all(), $id);

        Flash::success('Fungsi updated successfully.');

        return redirect(route('fungsis.index'));
    }

    /**
     * Remove the specified fungsi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fungsi = $this->fungsiRepository->findWithoutFail($id);

        if (empty($fungsi)) {
            Flash::error('Fungsi not found');

            return redirect(route('fungsis.index'));
        }

        $this->fungsiRepository->delete($id);

        Flash::success('Fungsi deleted successfully.');

        return redirect(route('fungsis.index'));
    }
}
