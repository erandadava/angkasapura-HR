<div class="row">
    <div class="col-md-3">
        <!-- Nama Tipekar Field -->
        <div class="form-group">
            {!! Form::label('nama_tipekar', 'Nama Tipekar:') !!}
            <p>{!! $tipekar->nama_tipekar !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $tipekar->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $tipekar->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $tipekar->updated_at !!}</p>
        </div>

    </div>
</div>