<?php

namespace App\Http\Controllers;

use App\DataTables\karyawan_osDataTable;
use App\Http\Requests;
use App\Http\Requests\Createkaryawan_osRequest;
use App\Http\Requests\Updatekaryawan_osRequest;
use App\Repositories\karyawan_osRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\unitkerja;
use App\Models\fungsi;
use Illuminate\Http\Request;
use Validator;
use League\Csv\Reader;
class karyawan_osController extends AppBaseController
{
    /** @var  karyawan_osRepository */
    private $karyawanOsRepository;

    public function __construct(karyawan_osRepository $karyawanOsRepo)
    {
        $this->karyawanOsRepository = $karyawanOsRepo;
        $this->data['unitkerja'] = unitkerja::pluck('nama_uk','id');
        $this->data['fungsi'] = fungsi::pluck('nama_fungsi','id');
    }

    /**
     * Display a listing of the karyawan_os.
     *
     * @param karyawan_osDataTable $karyawanOsDataTable
     * @return Response
     */
    public function index(karyawan_osDataTable $karyawanOsDataTable)
    {
        return $karyawanOsDataTable->render('karyawan_os.index');
    }

    /**
     * Show the form for creating a new karyawan_os.
     *
     * @return Response
     */
    public function create()
    {
        return view('karyawan_os.create')->with($this->data);
    }

    /**
     * Store a newly created karyawan_os in storage.
     *
     * @param Createkaryawan_osRequest $request
     *
     * @return Response
     */
    public function store(Createkaryawan_osRequest $request)
    {
        $input = $request->all();

        if ($request->doc_no_bpjs_tk) {
            $doc_no_bpjs_tk=[];
            foreach ($request->doc_no_bpjs_tk as $key => $photo) {
                $filename = $photo->store('/docnobpjstk');
                $doc_no_bpjs_tk[$key]=$filename;
            }
            $input['doc_no_bpjs_tk'] = serialize($doc_no_bpjs_tk);
        }
        

        if ($request->doc_no_bpjs_kesehatan) {
            $doc_no_bpjs_kesehatan=[];
            foreach ($request->doc_no_bpjs_kesehatan as $key => $photo) {
                $filename = $photo->store('/docnobpjskesehatan');
                $doc_no_bpjs_kesehatan[$key]=$filename;
            }
            $input['doc_no_bpjs_kesehatan'] = serialize($doc_no_bpjs_kesehatan);
        }

        if ($request->doc_lisensi) {
            $doc_lisensi=[];
            foreach ($request->doc_lisensi as $key => $photo) {
                $filename = $photo->store('/doclisensi');
                $doc_lisensi[$key]=$filename;
            }
            $input['doc_lisensi'] = serialize($doc_lisensi);
        }

        if ($request->doc_no_lisensi) {
            $doc_no_lisensi=[];
            foreach ($request->doc_no_lisensi as $key => $photo) {
                $filename = $photo->store('/docnolisensi');
                $doc_no_lisensi[$key]=$filename;
            }
            $input['doc_no_lisensi'] = serialize($doc_no_lisensi);
        }

        if ($request->doc_jangka_waktu) {
            $doc_jangka_waktu=[];
            foreach ($request->doc_jangka_waktu as $key => $photo) {
                $filename = $photo->store('/docjangkawaktu');
                $doc_jangka_waktu[$key]=$filename;
            }
            $input['doc_jangka_waktu'] = serialize($doc_jangka_waktu);
        }

        if ($request->doc_no_kontrak_kerja) {
            $doc_no_kontrak_kerja=[];
            foreach ($request->doc_no_kontrak_kerja as $key => $photo) {
                $filename = $photo->store('/docnokontrakkerja');
                $doc_no_kontrak_kerja[$key]=$filename;
            }
            $input['doc_no_kontrak_kerja'] = serialize($doc_no_kontrak_kerja);
        }


        $karyawanOs = $this->karyawanOsRepository->create($input);

        Flash::success('Karyawan Os saved successfully.');

        return redirect(route('karyawanOs.index'));
    }

    /**
     * Display the specified karyawan_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $karyawanOs = $this->karyawanOsRepository->with(['fungsi','unitkerja'])->findWithoutFail($id);

        if (empty($karyawanOs)) {
            Flash::error('Karyawan Os not found');

            return redirect(route('karyawanOs.index'));
        }

        return view('karyawan_os.show')->with('karyawanOs', $karyawanOs);
    }

    /**
     * Show the form for editing the specified karyawan_os.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->data['karyawanOs'] = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($this->data['karyawanOs'])) {
            Flash::error('Karyawan Os not found');

            return redirect(route('karyawanOs.index'));
        }
        
        // echo "<pre>";
        // print_r($this->data['karyawanOs']['Docnobpjskesehatan']);
        return view('karyawan_os.edit')->with($this->data);
    }

    /**
     * Update the specified karyawan_os in storage.
     *
     * @param  int              $id
     * @param Updatekaryawan_osRequest $request
     *
     * @return Response
     */
    public function update($id, Updatekaryawan_osRequest $request)
    {
        $karyawanOs = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($karyawanOs)) {
            Flash::error('Karyawan Os not found');

            return redirect(route('karyawanOs.index'));
        }
        $input = $request->all();
        if(isset($input['ganti_doc_bpjs_tk'])){
            $input['doc_no_bpjs_tk'] = serialize($this->update_dokumen($id,'doc_no_bpjs_tk',$input['doc_no_bpjs_tk'],$karyawanOs->doc_no_bpjs_tk));
        }else{
            unset($input['doc_no_bpjs_tk']);
        }

        if(isset($input['ganti_doc_bpjs_kesehatan'])){
            $input['doc_no_bpjs_kesehatan'] = serialize($this->update_dokumen($id,'doc_no_bpjs_kesehatan',$input['doc_no_bpjs_kesehatan'],$karyawanOs->doc_no_bpjs_kesehatan));
        }else{
            unset($input['doc_no_bpjs_kesehatan']);
        }

        if(isset($input['ganti_ganti_doc_lisensi'])){
            $input['doc_lisensi'] = serialize($this->update_dokumen($id,'doc_lisensi',$input['doc_lisensi'],$karyawanOs->doc_lisensi));
        }else{
            unset($input['doc_lisensi']);
        }

        if(isset($input['ganti_doc_no_lisensi'])){
            $input['doc_no_lisensi'] = serialize($this->update_dokumen($id,'doc_no_lisensi',$input['doc_no_lisensi'],$karyawanOs->doc_no_lisensi));
        }else{
            unset($input['doc_no_lisensi']);
        }

        if(isset($input['ganti_doc_jangka_waktu'])){
            $input['doc_jangka_waktu'] = serialize($this->update_dokumen($id,'doc_jangka_waktu',$input['doc_jangka_waktu'],$karyawanOs->doc_jangka_waktu));
        }else{
            unset($input['doc_jangka_waktu']);
        }

        if(isset($input['ganti_doc_no_kontrak_kerja'])){
            $input['doc_no_kontrak_kerja'] = serialize($this->update_dokumen($id,'doc_no_kontrak_kerja',$input['doc_no_kontrak_kerja'],$karyawanOs->doc_no_kontrak_kerja));
        }else{
            unset($input['doc_no_kontrak_kerja']);
        }
        $karyawanOs = $this->karyawanOsRepository->update($input, $id);

        Flash::success('Karyawan Os updated successfully.');

        return redirect(route('karyawanOs.index'));
    }

    /**
     * Remove the specified karyawan_os from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $karyawanOs = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($karyawanOs)) {
            Flash::error('Karyawan Os not found');

            return redirect(route('karyawanOs.index'));
        }

        $this->karyawanOsRepository->delete($id);

        Flash::success('Karyawan Os deleted successfully.');

        return redirect(route('karyawanOs.index'));
    }

    public function update_dokumen($id,$field,$value,$valuelama){
        // $doc_no_bpjs_tk = unserialize($this->data['karyawanOs']['doc_no_bpjs_tk']);
        // $doc_no_bpjs_kesehatan = unserialize($this->data['karyawanOs']['doc_no_bpjs_kesehatan']);
        // $doc_lisensi = unserialize($this->data['karyawanOs']['doc_lisensi']);
        // $doc_no_lisensi= unserialize($this->data['karyawanOs']['doc_no_lisensi']);
        // $doc_jangka_waktu = unserialize($this->data['karyawanOs']['doc_jangka_waktu']);
        // $doc_no_kontrak_kerja = unserialize($this->data['karyawanOs']['doc_no_kontrak_kerja']);

        //hapus file lama 
        $filelama = unserialize($valuelama); 
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

    public function import_from_csv(Request $request){
        try {
            if (empty($request->file_csv) || $request->file_csv->getClientOriginalExtension() != 'csv')
        {
            Flash::error("Pastikan Terdapat File Yang Diupload dan Memiliki Format CSV");
            return redirect(route('karyawanOs.index'));
        }
        $csv = Reader::createFromPath($request->file('file_csv'), 'r');
        $csv->setHeaderOffset(0);
        $arrfungsi = [];
        $arrjabatan = [];
        $arruk = [];
        $arrberhasil = [];
        foreach ($csv as $row) {
            // $cek_jabatan = \App\Models\jabatan::where('nama_jabatan','=',$row['JABATAN'])->first();
            // if(empty($cek_jabatan)){
            //     // $cek_jabatan = $this->jabatanRepository->create([
            //     //     'nama_jabatan' => $row['JABATAN']
            //     // ]);
            //     array_push($arrjabatan, $row['JABATAN']);
            // }

            // $cek_uk = \App\Models\unitkerja::where('nama_uk','=',$row['UNIT KERJA'])->first();
            // if(empty($cek_uk)){
            //     // $cek_uk = $this->unitkerjaRepository->create([
            //     //     'nama_uk' => $row['UNIT KERJA']
            //     // ]);
            //     array_push($arruk, $row['UNIT KERJA']);
            // }

            $cek_fungsi = \App\Models\fungsi::where('nama_fungsi','=',$row['FUNGSI'])->first();
            if(empty($cek_fungsi)){
                // $cek_fungsi = $this->fungsiRepository->create([
                //     'nama_fungsi' => $row['FUNGSI']
                // ]);
                array_push($arrfungsi, $row['FUNGSI']);
            }
            if(!empty($cek_fungsi)){
                $input['nama'] = $row['NAMA'];
                $input['tgl_lahir'] = \Carbon\Carbon::parse($row['TTL'])->format('Y-m-d H:i:s');
                if($row['JENIS KELAMIN']=="P"){
                    $row['JENIS KELAMIN'] = 'Perempuan';
                }else{
                    $row['JENIS KELAMIN'] = 'Laki-laki';
                }
                $input['gender'] = $row['JENIS KELAMIN'];
                $input['id_fungsi'] = $cek_fungsi['id'];

                $this->karyawanOsRepository->create($input);

                array_push($arrberhasil, 'a');
            }
            
        }

        if(empty($arrfungsi)){
            Flash::success('Import from CSV successfully.');
        }else{
            $gagal = count($arrfungsi);
            $teks = '<b>'.(String) count($arrberhasil)." Karyawan Ousourcing Created Successfully</b> </br> <b>".(String)$gagal." Karyawan Outsourcing Not Created Because : </b> </br> Fungsi Not Found: </br>";
            // foreach((array) array_unique($arrjabatan) as $dt){
            //     $teks = $teks.', '.$dt;
            // }

            $teks = $teks.'</br> Fungsi Not Found: </br>';
            foreach((array) array_unique($arrfungsi) as $dt){
                $teks = $teks.', '.$dt;
            }

            // $teks = $teks.'</br> Unit Kerja Not Found : </br>';
            // foreach((array) array_unique($arruk) as $dt){
            //     $teks = $teks.', '.$dt;
            // }
            Flash::info($teks);
        }
        } catch (\Throwable $th) {
            Flash::error('Terjadi Kesalahan ! </br> Pastikan File CSV Anda Sudah Benar </br> <small>Tips Jika File Sudah Benar: Pastikan Pada Header CSV Tidak Ada Yang Kosong</small>');
        }
        return redirect(route('karyawanOs.index'));
    }
}