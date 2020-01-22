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
use App\Models\fungsi_os;
use App\Models\jabatan_os;
use App\Models\vendor_os;
use Illuminate\Http\Request;
use Validator;
use League\Csv\Reader;
use Auth;
use App\Http\Controllers\notifikasiController;
class karyawan_osController extends AppBaseController
{
    /** @var  karyawan_osRepository */
    private $karyawanOsRepository;
    private $notifikasiController;

    public function __construct(karyawan_osRepository $karyawanOsRepo,notifikasiController $notifikasiControl)
    {
        $this->karyawanOsRepository = $karyawanOsRepo;
        $this->notifikasiController = $notifikasiControl;
        $this->data['unitkerja'] = unitkerja::pluck('nama_uk','id');
        $this->data['fungsi'] = fungsi_os::pluck('nama_fungsi','id');
        $this->data['jabatan_os'] = jabatan_os::pluck('nama_jabatan','id');
        $this->data['vendor'] = vendor_os::where('is_active','=',1)->pluck('nama_vendor','id');

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
        $this->data['id_vendor'] = \App\Models\vendor_os::where('email','=',Auth::user()->email)->first();
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

        $input['is_active'] = null;
        $karyawanOs = $this->karyawanOsRepository->create($input);
        $this->notifikasiController->create_notifikasi("KARYAWAN_OS", $karyawanOs->is_active,$karyawanOs->id,$karyawanOs->id_vendor);
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
    public function show($id, Request $request)
    {
        if($request->n){
            $this->notifikasiController->update_baca($request->n);
        }

        $karyawanOs = $this->karyawanOsRepository->with(['fungsi','unitkerja','vendor'])->findWithoutFail($id);
        if ($karyawanOs->tmt_akhir_kontrak != null && $karyawanOs->tmt_awal_kontrak != null) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $karyawanOs->tmt_akhir_kontrak);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $karyawanOs->tmt_awal_kontrak);
            $diff_in_months = $to->diffInMonths($from);
            $diff_in_year = $to->diffInYears($from);
            // $dbDate = \Carbon\Carbon::parse($karyawanOs->tmt_awal_date);
            // $diffYears = \Carbon\Carbon::parse($karyawanOs->tmt_akhir_date)->diffInYears($dbDate);
            $karyawanOs['jangka_waktu_tmt'] = "";
            if($diff_in_year != 0){
                $karyawanOs['jangka_waktu_tmt'] = $diff_in_year.' Tahun '.$diff_in_months.' Bulan';
            }else{
                $karyawanOs['jangka_waktu_tmt'] = $diff_in_months.' Bulan';
            }
        }
        
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
        $this->data['id_vendor'] = \App\Models\vendor_os::where('email','=',Auth::user()->email)->first();
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
        if (isset($input['is_active'])) {
            if($input['is_active'] == 'R' || $input['is_active'] == 'A'){
                $this->notifikasiController->create_notifikasi("KARYAWAN_OS", $karyawanOs->is_active,$karyawanOs->id,$karyawanOs->id_vendor);
            }
        }

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
        $nikdouble=[];
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

            // $cek_fungsi = \App\Models\fungsi::where('nama_fungsi','=',$row['FUNGSI'])->first();
            // if(empty($cek_fungsi)){
            //     // $cek_fungsi = $this->fungsiRepository->create([
            //     //     'nama_fungsi' => $row['FUNGSI']
            //     // ]);
            //     array_push($arrfungsi, $row['FUNGSI']);
            // }

            $cek_nik = \App\Models\karyawan_os::where('nik','=',$row['nik'])->first();
            if(!$cek_nik){
                $input['nama'] = $row['nama'];
                $input['tgl_lahir'] = $row['tgl_lahir'] ? \Carbon\Carbon::parse($row['tgl_lahir'])->format('Y-m-d H:i:s'):null;
                if($row['gender']=="P"){
                    $input['gender'] = 'Perempuan';
                }else{
                    $input['gender'] = 'Laki-laki';
                }
                $input['nik'] = $row['nik']??null;
                $input['id_fungsi'] = $row['id_fungsi']??null;
                $input['id_unitkerja'] = $row['id_unitkerja']??null;
                $input['id_vendor'] = $row['id_vendor']??null;
                $input['penempatan'] = $row['penempatan']??null;
                $input['pend_akhir'] = $row['pend_akhir']??null;
                $input['no_bpjs_tk'] = $row['no_bpjs_tk']??null;
                $input['no_bpjs_kesehatan'] = $row['no_bpjs_kesehatan']??null;
                $input['lisensi'] = $row['lisensi']??null;
                $input['no_lisensi'] = $row['no_lisensi']??null;
                $input['jangka_waktu'] = $row['jangka_waktu']??null;
                $input['no_kontrak_kerja'] = $row['no_kontrak_kerja']??null;
                $input['jurusan'] = $row['jurusan']??null;
                $input['mulai_masa_berlaku_lisensi'] = $row['mulai_masa_berlaku_lisensi'] ? \Carbon\Carbon::parse($row['mulai_masa_berlaku_lisensi']??null)->format('Y-m-d H:i:s'):null;
                $input['selesai_masa_berlaku_lisensi'] = $row['selesai_masa_berlaku_lisensi'] ? \Carbon\Carbon::parse($row['selesai_masa_berlaku_lisensi']??null)->format('Y-m-d H:i:s'):null;


                $input['is_active'] = $row['is_active']??null;
                $input['tmt_awal_kontrak'] = $row['tmt_awal_kontrak'] ? \Carbon\Carbon::parse($row['tmt_awal_kontrak']??null)->format('Y-m-d H:i:s'):null;
                $input['tmt_akhir_kontrak'] = $row['tmt_akhir_kontrak'] ? \Carbon\Carbon::parse($row['tmt_akhir_kontrak']??null)->format('Y-m-d H:i:s'):null;
                // $input['gender'] = $row['gender'];
                // $input['id_fungsi'] = $cek_fungsi['id'];

                $this->karyawanOsRepository->create($input);

                // array_push($arrberhasil, 'a');
            }else{
                array_push($nikdouble, $row['nik']);
            }
            
        }

        if(empty($cek_nik)){
            Flash::success('Import from CSV successfully.');
        }else{
            $text_warning_nik = "";
            foreach ($nikdouble as $key => $value) {
                $text_warning_nik = $text_warning_nik.$value.", ";
            }
            Flash::warning('Import from CSV successfully.</br></br><b>Warning</b></br>NIK '.$text_warning_nik." Not Created Because NIK Already Exists");
        }
        // }else{
        //     $gagal = count($arrfungsi);
        //     $teks = '<b>'.(String) count($arrberhasil)." Karyawan Ousourcing Created Successfully</b> </br> <b>".(String)$gagal." Karyawan Outsourcing Not Created Because : </b> </br> Fungsi Not Found: </br>";
        //     // foreach((array) array_unique($arrjabatan) as $dt){
        //     //     $teks = $teks.', '.$dt;
        //     // }

        //     $teks = $teks.'</br> Fungsi Not Found: </br>';
        //     foreach((array) array_unique($arrfungsi) as $dt){
        //         $teks = $teks.', '.$dt;
        //     }

        //     // $teks = $teks.'</br> Unit Kerja Not Found : </br>';
        //     // foreach((array) array_unique($arruk) as $dt){
        //     //     $teks = $teks.', '.$dt;
        //     // }
        //     Flash::info($teks);
        // }
        } catch (\Throwable $th) {
            Flash::error('Terjadi Kesalahan ! </br> Pastikan File CSV Anda Sudah Benar </br> <small>Tips Jika File Sudah Benar: Pastikan Pada Header CSV Tidak Ada Yang Kosong</small>');
        }
        return redirect(route('karyawanOs.index'));
    }


    public function updatestatus($id, Request $request)
    {
        $karyawanOs = $this->karyawanOsRepository->findWithoutFail($id);

        if (empty($karyawanOs)) {
            Flash::error('Karyawan Os not found');

            return redirect(route('karyawanOs.index'));
        }
        $input = $request->all();
        $karyawanOs = $this->karyawanOsRepository->update($input, $id);
        if (isset($input['is_active'])) {
            if($input['is_active'] == 'R' || $input['is_active'] == 'A'){
                $this->notifikasiController->create_notifikasi("KARYAWAN_OS", $karyawanOs->is_active,$karyawanOs->id,$karyawanOs->id_vendor);
            }
        }

        Flash::success('Karyawan Os updated successfully.');

        return redirect(route('karyawanOs.index'));
    }
}
