<div class="row">
    <div class="col-md-3">
        <!-- Nama Jabatan Field -->
        <div class="form-group">
            {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
            <p>{!! $jabatanOs->nama_jabatan !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $jabatanOs->created_at !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $jabatanOs->updated_at !!}</p>
        </div>
    </div>
</div>