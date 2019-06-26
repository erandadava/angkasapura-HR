
<!-- Nama Field -->
<div class="form-group">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{!! $karyawan->nama !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Jenis Kelamin:') !!}
    <p>{!! $karyawan->gender !!}</p>
</div>

<!-- Tgl Lahir Field -->
<div class="form-group">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
    <p>{!! $karyawan->tgl_lahir !!}</p>
</div>

<!-- id Kj Field -->
<div class="form-group">
    {!! Form::label('id_kj', 'id Kj:') !!}
    <p>{!! $karyawan->id_kj !!}</p>
</div>

<!-- id Jabatan Field -->
<div class="form-group">
    {!! Form::label('id_jabatan', 'id Jabatan:') !!}
    <p>{!! $karyawan->id_jabatan !!}</p>
</div>

<!-- id Status1 Field -->
<div class="form-group">
    {!! Form::label('id_status1', 'id Status1:') !!}
    <p>{!! $karyawan->id_status1 !!}</p>
</div>

<!-- id Status2 Field -->
<div class="form-group">
    {!! Form::label('id_status2', 'id Status2:') !!}
    <p>{!! $karyawan->id_status2 !!}</p>
</div>

<!-- id Unitkerja Field -->
<div class="form-group">
    {!! Form::label('id_unitkerja', 'id Unitkerja:') !!}
    <p>{!! $karyawan->id_unitkerja !!}</p>
</div>

<!-- Rencana Mpp Field -->
<div class="form-group">
    {!! Form::label('rencana_mpp', 'Rencana Mpp:') !!}
    <p>{!! $karyawan->rencana_mpp !!}</p>
</div>

<!-- Rencana Pensiun Field -->
<div class="form-group">
    {!! Form::label('rencana_pensiun', 'Rencana Pensiun:') !!}
    <p>{!! $karyawan->rencana_pensiun !!}</p>
</div>

<!-- Pend Diakui Field -->
<div class="form-group">
    {!! Form::label('pend_diakui', 'Pend Diakui:') !!}
    <p>{!! $karyawan->pend_diakui !!}</p>
</div>

<!-- id Org Field -->
<div class="form-group">
    {!! Form::label('id_org', 'id Org:') !!}
    <p>{!! $karyawan->id_org !!}</p>
</div>

<!-- id Posisi Field -->
<div class="form-group">
    {!! Form::label('id_posisi', 'id Posisi:') !!}
    <p>{!! $karyawan->id_posisi !!}</p>
</div>

<!-- id Tipe Kar Field -->
<div class="form-group">
    {!! Form::label('id_tipe_kar', 'id Tipe Kar:') !!}
    <p>{!! $karyawan->id_tipe_kar !!}</p>
</div>

<div class="form-group">
    {!! Form::label('status_pensiun', 'Status Pensiun:') !!}
    <p>
    @if($karyawan->status_pensiun == 'A') <span class='label label-success'>Sudah Pensiun</span>
    @elseif ($karyawan->status_pensiun == 'R') <span class='label label-danger'>Pensiun Tidak Diambil</span>
    @elseif ($karyawan->status_pensiun == 'M') <span class='label label-warning'>Menunggu Waktu Aktif Pensiun</span>
    @elseif ($karyawan->status_pensiun == 'N') <span class='label label-info'>Belum Pensiun</span>@endif
    </p>
</div>

<div class="form-group">
    {!! Form::label('tgl_aktif_pensiun', 'Tanggal Aktif Pensiun:') !!}
    <p>{!! $karyawan->tgl_aktif_pensiun !!}</p>
</div>

<!-- Entry Date Field -->
<div class="form-group">
    {!! Form::label('entry_date', 'Entry Date:') !!}
    <p>{!! $karyawan->entry_date !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $karyawan->deleted_at !!}</p>
</div>

