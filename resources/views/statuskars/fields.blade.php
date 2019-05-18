<!-- Nama Stat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_stat', 'Nama Stat:') !!}
    {!! Form::text('nama_stat', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('statuskars.index') !!}" class="btn btn-default">Cancel</a>
</div>
