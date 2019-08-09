<div class="row">
    <div class="col-md-3">
        <!-- Nama Unit Field -->
        <div class="form-group">
            {!! Form::label('nama_unit', 'Nama Unit:') !!}
            <p>{!! $unit->nama_unit !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $unit->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $unit->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $unit->updated_at !!}</p>
        </div>
    </div>
</div>