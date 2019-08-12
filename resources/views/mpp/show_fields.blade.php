<!-- id Field -->
<div class="form-group">
    {!! Form::label('id', 'id:') !!}
    <p>{!! $mpp->id !!}</p>
</div>

<!-- Nama Field -->
<div class="form-group">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{!! $mpp->nama !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{!! $mpp->gender !!}</p>
</div>

<!-- Tgl Lahir Field -->
<div class="form-group">
    {!! Form::label('tgl_lahir', 'Tgl Lahir:') !!}
    <p>{!! ($mpp->tgl_lahir)->format('d-m-Y') !!}</p>
</div>

<!-- id Kj Field -->
<div class="form-group">
    {!! Form::label('id_kj', 'Kelas Jabatan:') !!}
    <p>{!! $mpp->klsjabatan->nama_kj !!}</p>
</div>

<!-- id Jabatan Field -->
<div class="form-group">
    {!! Form::label('id_jabatan', 'Nama Jabatan:') !!}
    <p>{!! $mpp->jabatan->nama_jabatan !!}</p>
</div>

<!-- id Status1 Field -->
{{-- <div class="form-group">
    {!! Form::label('id_status1', 'id Status1:') !!}
    <p>{!! $mpp->id_status1 !!}</p>
</div> --}}

<!-- id Status2 Field -->
{{-- <div class="form-group">
    {!! Form::label('id_status2', 'id Status2:') !!}
    <p>{!! $mpp->id_status2 !!}</p>
</div> --}}

<!-- id Unitkerja Field -->
<div class="form-group">
    {!! Form::label('id_unitkerja', 'Nama Unit:') !!}
    <p>{!! $mpp->unitkerja->nama_uk !!}</p>
</div>

<!-- Rencana Mpp Field -->
<div class="form-group">
    {!! Form::label('rencana_mpp', 'Rencana Mpp:') !!}
    <p>{!! ($mpp->rencana_mpp)->format('d-m-Y') !!}</p>
</div>

<!-- Rencana Pensiun Field -->
<div class="form-group">
    {!! Form::label('rencana_pensiun', 'Rencana Pensiun:') !!}
    <p>{!! ($mpp->rencana_pensiun)->format('d-m-Y') !!}</p>
</div>

<!-- Pend Diakui Field -->
{{-- <div class="form-group">
    {!! Form::label('pend_diakui', 'Pend Diakui:') !!}
    <p>{!! $mpp->pend_diakui !!}</p>
</div>

<!-- id Org Field -->
<div class="form-group">
    {!! Form::label('id_org', 'id Org:') !!}
    <p>{!! $mpp->id_org !!}</p>
</div>

<!-- id Posisi Field -->
<div class="form-group">
    {!! Form::label('id_posisi', 'id Posisi:') !!}
    <p>{!! $mpp->id_posisi !!}</p>
</div>

<!-- id Tipe Kar Field -->
<div class="form-group">
    {!! Form::label('id_tipe_kar', 'id Tipe Kar:') !!}
    <p>{!! $mpp->id_tipe_kar !!}</p>
</div>

<!-- Entry Date Field -->
<div class="form-group">
    {!! Form::label('entry_date', 'Entry Date:') !!}
    <p>{!! $mpp->entry_date !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $mpp->deleted_at !!}</p>
</div> --}}

