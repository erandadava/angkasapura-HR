<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ID', 'Id:') !!}
    {!! Form::number('ID', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Kar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ID_kar', 'Id Kar:') !!}
    {!! Form::number('ID_kar', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Bpsj Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_bpsj', 'Doc Bpsj:') !!}
    {!! Form::textarea('doc_bpsj', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Bpjsk Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_bpjsk', 'Doc Bpjsk:') !!}
    {!! Form::textarea('doc_bpjsk', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Lisensi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_lisensi', 'Doc Lisensi:') !!}
    {!! Form::textarea('doc_lisensi', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Nomlisensi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_nomlisensi', 'Doc Nomlisensi:') !!}
    {!! Form::textarea('doc_nomlisensi', null, ['class' => 'form-control']) !!}
</div>

<!-- Jangkawaktu Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('jangkawaktu', 'Jangkawaktu:') !!}
    {!! Form::textarea('jangkawaktu', null, ['class' => 'form-control']) !!}
</div>

<!-- Kontrakkerja Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('kontrakkerja', 'Kontrakkerja:') !!}
    {!! Form::textarea('kontrakkerja', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('osdocs.index') !!}" class="btn btn-default">Cancel</a>
</div>
