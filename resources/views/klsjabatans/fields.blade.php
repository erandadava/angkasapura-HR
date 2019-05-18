<!-- Nama Kj Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_kj', 'Nama Kj:') !!}
    {!! Form::text('nama_kj', null, ['class' => 'form-control']) !!}
</div>

<!-- Jml Butuh Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jml_butuh', 'Jml Butuh:') !!}
    {!! Form::number('jml_butuh', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('klsjabatans.index') !!}" class="btn btn-default">Cancel</a>
</div>
