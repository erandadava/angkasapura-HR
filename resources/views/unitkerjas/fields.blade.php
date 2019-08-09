<div class="form-group col-sm-6">
    {!! Form::label('id_kategori_unit_kerja_fk', 'Kategori Unit Kerja:') !!}
    {!! Form::select('id_kategori_unit_kerja_fk', $kategori_unit_kerja, null, ['class' => 'form-control']) !!}
</div>
<!-- Nama Uk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_uk', 'Nama Unit Kerja:') !!}
    {!! Form::text('nama_uk', null, ['class' => 'form-control']) !!}
</div>

<!-- Jml Formasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jml_formasi', 'Jumlah Formasi:') !!}
    {!! Form::number('jml_formasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Jml Existing Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jml_existing', 'Jumlah Existing:') !!}
    {!! Form::number('jml_existing', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('unitkerjas.index') !!}" class="btn btn-default">Cancel</a>
</div>
