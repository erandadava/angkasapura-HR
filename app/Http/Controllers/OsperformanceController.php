<?php

namespace App\Http\Controllers;

use App\DataTables\OsperformanceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOsperformanceRequest;
use App\Http\Requests\UpdateOsperformanceRequest;
use App\Repositories\OsperformanceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OsperformanceController extends AppBaseController
{
    /** @var  OsperformanceRepository */
    private $osperformanceRepository;

    public function __construct(OsperformanceRepository $osperformanceRepo)
    {
        $this->osperformanceRepository = $osperformanceRepo;
    }

    /**
     * Display a listing of the Osperformance.
     *
     * @param OsperformanceDataTable $osperformanceDataTable
     * @return Response
     */
    public function index(OsperformanceDataTable $osperformanceDataTable)
    {
        return $osperformanceDataTable->render('osperformances.index');
    }

    /**
     * Show the form for creating a new Osperformance.
     *
     * @return Response
     */
    public function create()
    {
        return view('osperformances.create');
    }

    /**
     * Store a newly created Osperformance in storage.
     *
     * @param CreateOsperformanceRequest $request
     *
     * @return Response
     */
    public function store(CreateOsperformanceRequest $request)
    {
        $input = $request->all();
        if ($request->file_penyelesaian) {
            $file_penyelesaian=[];
            foreach ($request->file_penyelesaian as $key => $photo) {
                $filename = $photo->store('/filepenyelesaian');
                $file_penyelesaian[$key]=$filename;
            }
            $input['file_penyelesaian'] = serialize($file_penyelesaian);
        }
        if ($request->file_pelaporan) {
            $file_pelaporan=[];
            foreach ($request->file_pelaporan as $key => $photo) {
                $filename = $photo->store('/filepelaporan');
                $file_pelaporan[$key]=$filename;
            }
            $input['file_pelaporan'] = serialize($file_pelaporan);
        }
        $osperformance = $this->osperformanceRepository->create($input);

        Flash::success('Osperformance saved successfully.');

        return redirect(route('osperformances.index'));
    }

    /**
     * Display the specified Osperformance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            Flash::error('Osperformance not found');

            return redirect(route('osperformances.index'));
        }

        return view('osperformances.show')->with('osperformance', $osperformance);
    }

    /**
     * Show the form for editing the specified Osperformance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            Flash::error('Osperformance not found');

            return redirect(route('osperformances.index'));
        }

        return view('osperformances.edit')->with('osperformance', $osperformance);
    }

    /**
     * Update the specified Osperformance in storage.
     *
     * @param  int              $id
     * @param UpdateOsperformanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOsperformanceRequest $request)
    {
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            Flash::error('Osperformance not found');

            return redirect(route('osperformances.index'));
        }
        $input = $request->all();

        if(isset($input['ganti_file_pelaporan'])){
            $input['file_pelaporan'] = serialize($this->update_dokumen($id,'file_pelaporan',$request->file_pelaporan,$osperformance->file_pelaporan));
        }else{
            unset($input['file_pelaporan']);
        }

        if(isset($input['ganti_file_penyelesaian'])){
            $input['file_penyelesaian'] = serialize($this->update_dokumen($id,'file_penyelesaian',$request->file_penyelesaian,$osperformance->file_penyelesaian));
        }else{
            unset($input['file_penyelesaian']);
        }
        $osperformance = $this->osperformanceRepository->update($input, $id);

        Flash::success('Osperformance updated successfully.');

        return redirect(route('osperformances.index'));
    }

    /**
     * Remove the specified Osperformance from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $osperformance = $this->osperformanceRepository->findWithoutFail($id);

        if (empty($osperformance)) {
            Flash::error('Osperformance not found');

            return redirect(route('osperformances.index'));
        }

        $this->osperformanceRepository->delete($id);

        Flash::success('Osperformance deleted successfully.');

        return redirect(route('osperformances.index'));
    }

    public function update_dokumen($id,$field,$value,$valuelama){
        // $doc_no_bpjs_tk = unserialize($this->data['karyawanOs']['doc_no_bpjs_tk']);
        // $doc_no_bpjs_kesehatan = unserialize($this->data['karyawanOs']['doc_no_bpjs_kesehatan']);
        // $doc_lisensi = unserialize($this->data['karyawanOs']['doc_lisensi']);
        // $doc_no_lisensi= unserialize($this->data['karyawanOs']['doc_no_lisensi']);
        // $doc_jangka_waktu = unserialize($this->data['karyawanOs']['doc_jangka_waktu']);
        // $doc_no_kontrak_kerja = unserialize($this->data['karyawanOs']['doc_no_kontrak_kerja']);

        //hapus file lama 
        $filelama = $valuelama; 
        foreach ($filelama as $key => $dt) {
            \File::delete('storage/'.$dt);
        }

        //update field
        $nilai=[];
        $foldernya = str_replace('_', '',$field);
        foreach ($value as $key => $photo) {
            $filename = $photo->store($foldernya);
            $nilai[$key]=$filename;
        }
        return $nilai;
    }
}
