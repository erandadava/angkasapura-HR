<!-- Nama Jabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
    {!! Form::text('nama_jabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Syarat Didik Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('syarat_didik', 'Syarat Didik:') !!}
    {!! Form::textarea('syarat_didik', null, ['class' => 'form-control']) !!}
</div>

<!-- Syarat Latih Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('syarat_latih', 'Syarat Latih:') !!}
    {!! Form::textarea('syarat_latih', null, ['class' => 'form-control']) !!}
</div>

<!-- Syarat Pengalaman Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('syarat_pengalaman', 'Syarat Pengalaman:') !!}
    {!! Form::textarea('syarat_pengalaman', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('jabatans.index') !!}" class="btn btn-default">Cancel</a>
</div>
