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
use Illuminate\Http\Request;
use Carbon\Carbon;

class unitkerjaController extends AppBaseController
{
    /** @var  unitkerjaRepository */
    private $unitkerjaRepository;

    public function __construct(unitkerjaRepository $unitkerjaRepo)
    {
        $this->unitkerjaRepository = $unitkerjaRepo;
        $this->data['kategori_unit_kerja'] = \App\Models\kategori_unit_kerja::pluck('nama_kategori_uk','id');
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

    public function formasiExisting(formasiExistingDataTable $formasiExistingDataTable, Request $request)
    {
        if($request->dari != null){
            if($request->dari == null || $request->sampai == null){
                Flash::error('Mulai dari dan Sampai dari tidak boleh kosong');
                return redirect('/formasiexisting');
            }
            return $formasiExistingDataTable->with([
                'sampai' => $request->sampai,
                'dari' => $request->dari
            ])->render('unitkerjas.formasi',[
                'sampai' => $request->sampai,
                'dari' => $request->dari
            ]);

        }
        return $formasiExistingDataTable->render('unitkerjas.formasi');
    }

    public function formasiExistingShow($id, Request $request)
    {
        if($request->dari != null && $request->sampai != null){
                $dari = new Carbon($request->dari);
                $sampai = new Carbon($request->sampai);
                $sampai = $sampai->endOfMonth();

                $this->data['unitkerja'] = $this->unitkerjaRepository->withCount(['karyawan' => function($query) use ($dari, $sampai){
                $query->doesnthave('log_karyawan')->whereBetween('entry_date', [$dari, $sampai]);
                }])->withCount(['log_karyawan' => function($query) use ($dari, $sampai){
                    return $query->whereBetween('update_date', [$dari, $sampai]);
                }])->with(['kategori_unit_kerja'])->findWithoutFail($id);

                $kelas_jabatan_entry_date = \App\Models\klsjabatan::select('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh',\DB::raw('COUNT(tblkaryawan.id) as jml_kls_jbt'))  
                ->whereNotIn('tblkaryawan.id',function($query) {

                    $query->select('id_karyawan_fk')->from('tbllogkaryawan');
                 
                 })
                ->leftJoin('tblkaryawan', 'tblkaryawan.id_klsjabatan', '=', 'tblklsjabatan.id')
                ->rightJoin('tblunitkerja', 'tblkaryawan.id_unitkerja', '=', 'tblunitkerja.id')
                ->where('tblunitkerja.id','=',$id)
                ->whereBetween('tblkaryawan.entry_date', [$dari, $sampai])
                ->groupBy('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh')
                ->get();
                // dd($kelas_jabatan_entry_date);
                $kelas_jabatan_update_date= \App\Models\klsjabatan::select('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh',\DB::raw('COUNT(tbllogkaryawan.id) as jml_kls_jbt'))   
                ->leftJoin('tbllogkaryawan', 'tbllogkaryawan.id_klsjabatan', '=', 'tblklsjabatan.id')
                ->rightJoin('tblunitkerja', 'tbllogkaryawan.id_unitkerja', '=', 'tblunitkerja.id')
                ->where('tblunitkerja.id','=',$id)
                ->where('tbllogkaryawan.is_active','=',1)
                ->whereBetween('tbllogkaryawan.update_date', [$dari, $sampai])
                ->groupBy('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh')
                ->get();

                $this->data['kelasjabatan'] = [];
                // status_pendidikan.forEach(function(element,index){
                //     status_pendidikan_update_date.forEach(function(elements,indexs){
                //         if(element.pendidikan == elements.pendidikan){
                //             status_pendidikan[index]['jumlah'] = status_pendidikan[index]['jumlah']+elements.jumlah;
                //         }
                //     });
                // });
                if(count($kelas_jabatan_entry_date) > 0){
                    foreach ($kelas_jabatan_entry_date as $key => $value) {
                        $this->data['kelasjabatan'][$key]['nama_kj'] = $value['nama_kj'];
                        $this->data['kelasjabatan'][$key]['jml_kls_jbt'] = $value['jml_kls_jbt'];
                    }

                    // dd($this->data['kelasjabatan']);
                    // dd($kelas_jabatan_update_date);
                    foreach ($kelas_jabatan_update_date as $keys => $values) {
                        foreach ($this->data['kelasjabatan'] as $keyss => $valuess) {
                            if($values['nama_kj'] == $valuess['nama_kj']){
                                $this->data['kelasjabatan'][$keyss]['jml_kls_jbt'] = $this->data['kelasjabatan'][$keyss]['jml_kls_jbt']  + $values['jml_kls_jbt'];
                            }else{
                                array_push($this->data['kelasjabatan'],[
                                    'nama_kj' => $values['nama_kj'],
                                    'jml_kls_jbt' => $values['jml_kls_jbt']
                                ]);
                            }
                        }
                    }
                    $this->data['kelasjabatan']=array_map("unserialize", array_unique(array_map("serialize", $this->data['kelasjabatan'])));
                    // $this->data['kelasjabatan']=multi_unique($this->data['kelasjabatan']);
                }else{
                    foreach ($kelas_jabatan_update_date as $keys => $values) {
                        $this->data['kelasjabatan'][$keys]['nama_kj'] = $values['nama_kj'];
                        $this->data['kelasjabatan'][$keys]['jml_kls_jbt'] = $values['jml_kls_jbt'];
                    }
                }


                $this->data['lowong'] = (int) $this->data['unitkerja']['jml_formasi'] - ((int) $this->data['unitkerja']['karyawan_count'] + (int) $this->data['unitkerja']['log_karyawan_count']);
     
                if($this->data['unitkerja']['jml_formasi']>0){
                    $this->data['kekuatan'] = round((((int) $this->data['unitkerja']['karyawan_count'] + (int) $this->data['unitkerja']['log_karyawan_count'] ) / (int) $this->data['unitkerja']['jml_formasi'])*100)."%";
                }else{
                    $this->data['kekuatan'] = "0%";
                }
        }else{
            $this->data['unitkerja'] = $this->unitkerjaRepository->withCount(['karyawan' => function($query){
                $query->doesnthave('log_karyawan');
                }])->withCount(['log_karyawan' => function($query){
                    return $query;
                }])->with(['kategori_unit_kerja'])->findWithoutFail($id);
                $kelas_jabatan_entry_date = \App\Models\klsjabatan::select('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh',\DB::raw('COUNT(tblkaryawan.id) as jml_kls_jbt'))  
                ->whereNotIn('tblkaryawan.id',function($query) {

                    $query->select('id_karyawan_fk')->from('tbllogkaryawan');
                 
                 })
                ->leftJoin('tblkaryawan', 'tblkaryawan.id_klsjabatan', '=', 'tblklsjabatan.id')
                ->rightJoin('tblunitkerja', 'tblkaryawan.id_unitkerja', '=', 'tblunitkerja.id')
                ->where('tblunitkerja.id','=',$id)
                ->groupBy('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh')
                ->get();
                // dd($kelas_jabatan_entry_date);
                $kelas_jabatan_update_date= \App\Models\klsjabatan::select('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh',\DB::raw('COUNT(tbllogkaryawan.id) as jml_kls_jbt'))   
                ->leftJoin('tbllogkaryawan', 'tbllogkaryawan.id_klsjabatan', '=', 'tblklsjabatan.id')
                ->rightJoin('tblunitkerja', 'tbllogkaryawan.id_unitkerja', '=', 'tblunitkerja.id')
                ->where('tblunitkerja.id','=',$id)
                ->where('tbllogkaryawan.is_active','=',1)
                ->groupBy('tblklsjabatan.nama_kj','tblklsjabatan.jml_butuh')
                ->get();

                $this->data['kelasjabatan'] = [];
                // status_pendidikan.forEach(function(element,index){
                //     status_pendidikan_update_date.forEach(function(elements,indexs){
                //         if(element.pendidikan == elements.pendidikan){
                //             status_pendidikan[index]['jumlah'] = status_pendidikan[index]['jumlah']+elements.jumlah;
                //         }
                //     });
                // });
                if(count($kelas_jabatan_entry_date) > 0){
                    foreach ($kelas_jabatan_entry_date as $key => $value) {
                        $this->data['kelasjabatan'][$key]['nama_kj'] = $value['nama_kj'];
                        $this->data['kelasjabatan'][$key]['jml_kls_jbt'] = $value['jml_kls_jbt'];
                    }

                    // dd($this->data['kelasjabatan']);
                    // dd($kelas_jabatan_update_date);
                    foreach ($kelas_jabatan_update_date as $keys => $values) {
                        foreach ($this->data['kelasjabatan'] as $keyss => $valuess) {
                            if($values['nama_kj'] == $valuess['nama_kj']){
                                $this->data['kelasjabatan'][$keyss]['jml_kls_jbt'] = $this->data['kelasjabatan'][$keyss]['jml_kls_jbt']  + $values['jml_kls_jbt'];
                            }else{
                                array_push($this->data['kelasjabatan'],[
                                    'nama_kj' => $values['nama_kj'],
                                    'jml_kls_jbt' => $values['jml_kls_jbt']
                                ]);
                            }
                        }
                    }
                    $this->data['kelasjabatan']=array_map("unserialize", array_unique(array_map("serialize", $this->data['kelasjabatan'])));
                    // $this->data['kelasjabatan']=multi_unique($this->data['kelasjabatan']);
                }else{
                    foreach ($kelas_jabatan_update_date as $keys => $values) {
                        $this->data['kelasjabatan'][$keys]['nama_kj'] = $values['nama_kj'];
                        $this->data['kelasjabatan'][$keys]['jml_kls_jbt'] = $values['jml_kls_jbt'];
                    }
                }
            $this->data['lowong'] = (int) $this->data['unitkerja']['jml_formasi'] - (int) $this->data['unitkerja']['karyawan_count'];
     
            if($this->data['unitkerja']['jml_formasi']>0){
                $this->data['kekuatan'] = round(((int) $this->data['unitkerja']['karyawan_count'] / (int) $this->data['unitkerja']['jml_formasi'])*100)."%";
            }else{
                $this->data['kekuatan'] = "0%";
            }
        }
        
        // echo "<pre>";
        // print_r($this->data['kelasjabatan']);
        // return null;
        if (empty($this->data['unitkerja'])) {
            Flash::error('Formasi vs Eksisting not found');

            return redirect(route('unitkerjas.index'));
        }

        return view('unitkerjas.showformasi')->with($this->data);
    }

    /**
     * Show the form for creating a new unitkerja.
     *
     * @return Response
     */
    public function create()
    {
        return view('unitkerjas.create')->with($this->data);
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
        $unitkerja = $this->unitkerjaRepository->with('kategori_unit_kerja')->findWithoutFail($id);
        
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
        $this->data['unitkerja'] = $this->unitkerjaRepository->findWithoutFail($id);

        if (empty($this->data['unitkerja'])) {
            Flash::error('Unitkerja not found');

            return redirect(route('unitkerjas.index'));
        }

        return view('unitkerjas.edit')->with($this->data);
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

