<div class="row">
    <div class="col-md-3">
        <!-- Nama Kj Field -->
        <div class="form-group">
            {!! Form::label('nama_kj', 'Nama Kj:') !!}
            <p>{!! $klsjabatan->nama_kj !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Jml Butuh Field -->
        <div class="form-group">
            {!! Form::label('jml_butuh', 'Jml Butuh:') !!}
            <p>{!! $klsjabatan->jml_butuh !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $klsjabatan->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $klsjabatan->created_at !!}</p>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $klsjabatan->updated_at !!}</p>
        </div>
    </div>
</div>