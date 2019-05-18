<!-- Nama Tipekar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_tipekar', 'Nama Tipekar:') !!}
    {!! Form::text('nama_tipekar', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipekars.index') !!}" class="btn btn-default">Cancel</a>
</div>
