
<div class="row">
        <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('unit', 'Unit:') !!}
                  <p>{!! $karyawan->unitkerja->nama_uk??'' !!}</p>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('jabatan', 'Jabatan:') !!}
                  <p>{!! $karyawan->jabatan->nama_jabatan??'' !!}</p>
                </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('fungsi', 'Fungsi:') !!}
                  <p>{!! $karyawan->fungsi->nama_fungsi??'' !!}</p>
                </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
              {!! Form::label('nama', 'Nama:') !!}
              <p>{!! $karyawan->nama !!}</p>
          </div>
        </div>
        
        {{-- <div class="col-md-3">
          <div class="form-group">
              {!! Form::label('id_kj', 'id Kj:') !!}
              <p>{!! $karyawan->id_kj !!}</p>
          </div>
        </div> --}}
    </div> 
      <div class="row">
          {{-- <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('id_status1', 'id Status1:') !!}
                  <p>{!! $karyawan->id_status1 !!}</p>
              </div>
          </div>
          <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('id_status2', 'id Status2:') !!}
                  <p>{!! $karyawan->id_status2 !!}</p>
              </div>
          </div> --}}
          <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('nik', 'NIK:') !!}
                    <p>{!! $karyawan->nik !!}</p>
                </div>
              </div>
          <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('gender', 'Jenis Kelamin:') !!}
                    <p>{!! $karyawan->gender !!}</p>
                </div>
              </div>
              <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('rencana_mpp', 'Rencana Mpp:') !!}
                        <p>{!!  \Carbon\Carbon::parse($karyawan->rencana_mpp)->formatLocalized('%d %B %Y'); !!}</p>
                    </div>
                </div>

               <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('pend_diakui', 'Pend Diakui:') !!}
                        <p>{!! $karyawan->pend_diakui !!}</p>
                    </div>
                </div>
      </div>
      
      <div class="row">
          
          <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('rencana_pensiun', 'Rencana Pensiun:') !!}
                  <p>{!!  \Carbon\Carbon::parse($karyawan->rencana_pensiun)->formatLocalized('%d %B %Y'); !!}</p>

              </div>
          </div>
          <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('status_pensiun', 'Status Pensiun:') !!}
                    <p>
                    @if($karyawan->status_pensiun == 'A') <span class='label label-success'>Sudah Pensiun</span>
                    @elseif ($karyawan->status_pensiun == 'R') <span class='label label-danger'>Pensiun Tidak Diambil</span>
                    @elseif ($karyawan->status_pensiun == 'M') <span class='label label-warning'>Menunggu Waktu Aktif Pensiun</span>
                    @elseif ($karyawan->status_pensiun == 'N') <span class='label label-info'>Belum Pensiun</span>@endif
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('status_mpp', 'Status MPP:') !!}
                        <p>
                        {!! $karyawan->Statusmpp !!}
                        </p>
                    </div>
                </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('tgl_aktif_pensiun', 'Tanggal Aktif Pensiun:') !!}
                    <p>{!!  \Carbon\Carbon::parse($karyawan->tgl_aktif_pensiun)->formatLocalized('%d %B %Y'); !!}</p>

                </div>
            </div>
          {{-- <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('id_org', 'id Org:') !!}
                  <p>{!! $karyawan->id_org !!}</p>
              </div>
          </div> --}}
      </div>
      
      <div class="row">
          {{-- <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('id_posisi', 'id Posisi:') !!}
                  <p>{!! $karyawan->id_posisi !!}</p>
              </div>
          </div> --}}
          {{-- <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('id_tipe_kar', 'id Tipe Kar:') !!}
                  <p>{!! $karyawan->id_tipe_kar !!}</p>
              </div>
          </div> --}}
          
      
      </div>
      
      <div class="row">
      
          <div class="col-md-3">
              <div class="form-group">
                  {!! Form::label('entry_date', 'Entry Date:') !!}
                  <p>{!!  \Carbon\Carbon::parse($karyawan->entry_date)->formatLocalized('%d %B %Y | %H:%M:%S'); !!}</p>

                  
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
                  <p>{!!  \Carbon\Carbon::parse($karyawan->tgl_lahir)->formatLocalized('%d %B %Y'); !!}</p>

              </div>
          </div>
          {{-- <div class="col-md-6">
              <div class="form-group">
                  {!! Form::label('deleted_at', 'Deleted At:') !!}
                  <p>{!! $karyawan->deleted_at !!}</p>
              </div>
          </div> --}}
      </div>