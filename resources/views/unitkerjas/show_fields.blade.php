<div class="row">
    <div class="col-md-3">
        <!-- Nama Uk Field -->
        <div class="form-group">
            {!! Form::label('nama_uk', 'Nama Uk:') !!}
            <p>{!! $unitkerja->nama_uk !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Jml Formasi Field -->
        <div class="form-group">
            {!! Form::label('jml_formasi', 'Jml Formasi:') !!}
            <p>{!! $unitkerja->jml_formasi !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Jml Existing Field -->
        <div class="form-group">
            {!! Form::label('jml_existing', 'Jml Existing:') !!}
            <p>{!! $unitkerja->jml_existing !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $unitkerja->deleted_at !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $unitkerja->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $unitkerja->updated_at !!}</p>
        </div>
    </div>
</div>