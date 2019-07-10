<!-- Nama Jabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
    {!! Form::text('nama_jabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('jabatanOs.index') !!}" class="btn btn-default">Cancel</a>
</div>
