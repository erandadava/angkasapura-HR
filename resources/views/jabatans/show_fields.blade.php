<!-- id Field -->
<div class="form-group">
    {!! Form::label('id', 'id:') !!}
    <p>{!! $jabatan->id !!}</p>
</div>

<!-- Nama Jabatan Field -->
<div class="form-group">
    {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
    <p>{!! $jabatan->nama_jabatan !!}</p>
</div>

<!-- Syarat Didik Field -->
<div class="form-group">
    {!! Form::label('syarat_didik', 'Syarat Didik:') !!}
    <p>{!! $jabatan->syarat_didik !!}</p>
</div>

<!-- Syarat Latih Field -->
<div class="form-group">
    {!! Form::label('syarat_latih', 'Syarat Latih:') !!}
    <p>{!! $jabatan->syarat_latih !!}</p>
</div>

<!-- Syarat Pengalaman Field -->
<div class="form-group">
    {!! Form::label('syarat_pengalaman', 'Syarat Pengalaman:') !!}
    <p>{!! $jabatan->syarat_pengalaman !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $jabatan->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $jabatan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $jabatan->updated_at !!}</p>
</div>

