<?php

namespace App\Http\Controllers;

use App\DataTables\vendor_osDataTable;
use App\Http\Requests;
use App\Http\Requests\Createvendor_osRequest;
use App\Http\Requests\Updatevendor_osRequest;
use App\Repositories\vendor_osRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class vendor_osController extends AppBaseController
{
    /** @var  vendor_osRepository */
    private $vendorOsRepository;

    public function __construct(vendor_osRepository $vendorOsRepo)
    {
        $this->vendorOsRepository = $vendorOsRepo;
    }

    /**
     * Display a listing of the vendor_os.
     *
     * @param vendor_osDataTable $vendorOsDataTable
     * @return Response
     */
    public function index(vendor_osDataTable $vendorOsDataTable)
    {
        return $vendorOsDataTable->render('vendor_os.index');
    }

    /**
     * Show the form for creating a new vendor_os.
     *
     * @return Response
     */
    public function create()
    {
        return view('vendor_os.create');
    }

    /**
     * Store a newly created vendor_os in storage.
     *
     * @param Createvendor_osRequest $request
     *
     * @return Response
     */
    public function store(Createvendor_osRequest $request)
    {
        $input = $request->all();

        $vendorOs = $this->vendorOsRepository->create($input);

        Flash::success('Vendor Os saved successfully.');

        return redirect(route('vendorOs.index'));
    }

    /**
     * Display the specified vendor_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            Flash::error('Vendor Os not found');

            return redirect(route('vendorOs.index'));
        }

        return view('vendor_os.show')->with('vendorOs', $vendorOs);
    }

    /**
     * Show the form for editing the specified vendor_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            Flash::error('Vendor Os not found');

            return redirect(route('vendorOs.index'));
        }

        return view('vendor_os.edit')->with('vendorOs', $vendorOs);
    }

    /**
     * Update the specified vendor_os in storage.
     *
     * @param  int              $id
     * @param Updatevendor_osRequest $request
     *
     * @return Response
     */
    public function update($id, Updatevendor_osRequest $request)
    {
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            Flash::error('Vendor Os not found');

            return redirect(route('vendorOs.index'));
        }

        $vendorOs = $this->vendorOsRepository->update($request->all(), $id);

        Flash::success('Vendor Os updated successfully.');

        return redirect(route('vendorOs.index'));
    }

    /**
     * Remove the specified vendor_os from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vendorOs = $this->vendorOsRepository->findWithoutFail($id);

        if (empty($vendorOs)) {
            Flash::error('Vendor Os not found');

            return redirect(route('vendorOs.index'));
        }

        $this->vendorOsRepository->delete($id);

        Flash::success('Vendor Os deleted successfully.');

        return redirect(route('vendorOs.index'));
    }
}
