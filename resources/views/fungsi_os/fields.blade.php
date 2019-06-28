<!-- Nama Fungsi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_fungsi', 'Nama Fungsi:') !!}
    {!! Form::text('nama_fungsi', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('fungsiOs.index') !!}" class="btn btn-default">Cancel</a>
</div>
