<div class="row">
    <div class="col-md-3">
        <!-- Nama Stat Field -->
        <div class="form-group">
            {!! Form::label('nama_stat', 'Nama Stat:') !!}
            <p>{!! $statuskar->nama_stat !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $statuskar->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $statuskar->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $statuskar->updated_at !!}</p>
        </div>
    </div>
</div>