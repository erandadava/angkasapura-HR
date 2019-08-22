<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenotifikasiRequest;
use App\Http\Requests\UpdatenotifikasiRequest;
use App\Repositories\notifikasiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\karyawan_os;
use App\Models\vendor_os;
use Auth;
use \App\Models\notifikasi;
use Illuminate\Support\Facades\Crypt;
class notifikasiController extends AppBaseController
{
    /** @var  notifikasiRepository */
    private $notifikasiRepository;

    public function __construct(notifikasiRepository $notifikasiRepo)
    {
        $this->notifikasiRepository = $notifikasiRepo;
    }

    /**
     * Display a listing of the notifikasi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->notifikasiRepository->pushCriteria(new RequestCriteria($request));
        $notifikasis = $this->notifikasiRepository->all();

        return view('notifikasis.index')
            ->with('notifikasis', $notifikasis);
    }

    /**
     * Show the form for creating a new notifikasi.
     *
     * @return Response
     */
    public function create()
    {
        return view('notifikasis.create');
    }

    /**
     * Store a newly created notifikasi in storage.
     *
     * @param CreatenotifikasiRequest $request
     *
     * @return Response
     */
    public function create_notifikasi($tipe, $status, $id_konten, $permintaan)
    {


        if($tipe == 'KARYAWAN_OS'){
            $input['status'] = $tipe;
            $input['konten_id'] = $id_konten;
            $keluhan = karyawan_os::find($id_konten);
            $name = vendor_os::find($permintaan);
            // dd($permintaan);
            // $id_konten = Crypt::encrypt($id_konten);
            $link = "/karyawanOs";
            switch ($status) {
                case null:
                    $input['pesan'] = "<p><span class='label label-danger'>Karyawan Outsourcing Baru</span></br> dari Vendor : $name->nama_vendor</p>";
                    $input['user_id'] = 'HR';
                    break;
                case 'A':
                    $input['pesan'] = "<p><span class='label label-success'>Karyawan Outsourcing Diterima</span></br>$keluhan->nama</br> oleh Admin HR</p>";
                    $input['user_id'] = $keluhan->id_vendor;
                    break;
                case 'R':
                    $input['pesan'] = "<p><span class='label label-danger'>Karyawan Outsourcing Ditolak</span></br>$keluhan->nama</br> dari Vendor : $name->nama_vendor</p>";
                    $input['user_id'] = $keluhan->id_vendor;
                    break;
                default:
                    null;
                    break;
            }
        }
        $notifikasi = $this->notifikasiRepository->create($input);
        $input['link_id'] = $link.'/'.$id_konten.'?n='.Crypt::encrypt($notifikasi->id);
        $this->notifikasiRepository->update($input, $notifikasi->id);

        return $notifikasi;
    }
    public function store(CreatenotifikasiRequest $request)
    {
        $input = $request->all();

        $notifikasi = $this->notifikasiRepository->create($input);

        Flash::success('Notifikasi saved successfully.');

        return redirect(route('notifikasis.index'));
    }

    /**
     * Display the specified notifikasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notifikasi = $this->notifikasiRepository->findWithoutFail($id);

        if (empty($notifikasi)) {
            Flash::error('Notifikasi not found');

            return redirect(route('notifikasis.index'));
        }

        return view('notifikasis.show')->with('notifikasi', $notifikasi);
    }

    /**
     * Show the form for editing the specified notifikasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notifikasi = $this->notifikasiRepository->findWithoutFail($id);

        if (empty($notifikasi)) {
            Flash::error('Notifikasi not found');

            return redirect(route('notifikasis.index'));
        }

        return view('notifikasis.edit')->with('notifikasi', $notifikasi);
    }

    /**
     * Update the specified notifikasi in storage.
     *
     * @param  int              $id
     * @param UpdatenotifikasiRequest $request
     *
     * @return Response
     */
    public function update_baca($id)
    {
        $id = Crypt::decrypt($id);
        $notifikasi = notifikasi::where('id',$id)->first();
        $input['status_baca'] = 1;
        $notifikasi = \App\Models\notifikasi::where([['user_id','=',$notifikasi->user_id],['konten_id','=',$notifikasi->konten_id],['status_baca','=',0],['status','=','KARYAWAN_OS']])->update($input);

        return $notifikasi;
    }

    /**
     * Remove the specified notifikasi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notifikasi = $this->notifikasiRepository->findWithoutFail($id);

        if (empty($notifikasi)) {
            Flash::error('Notifikasi not found');

            return redirect(route('notifikasis.index'));
        }

        $this->notifikasiRepository->delete($id);

        Flash::success('Notifikasi deleted successfully.');

        return redirect(route('notifikasis.index'));
    }

    public function realtime_notification(Request $request){
        if(isset(Auth::user()->id)){
            $usernya = Auth::user()->getRoleNames();
            if(($usernya[0] == "Admin")){
                $this->data['data_notif'] = notifikasi::where([['user_id','=','HR'],['status_baca','=',0]])->latest()->get();
            }
            
            $this->data['count_notif'] = $this->data['data_notif']->count();
            
            return $this->sendResponse($this->data, 'Notifikasi send successfully');
        } 
    }
}
