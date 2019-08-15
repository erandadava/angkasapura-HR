<div class="row">
    <div class="col-md-3">
        <!-- Nama Jabatan Field -->
        <div class="form-group">
            {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
            <p>{!! $jabatan->nama_jabatan !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Syarat Didik Field -->
        <div class="form-group">
            {!! Form::label('syarat_didik', 'Syarat Didik:') !!}
            <p>{!! $jabatan->syarat_didik !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Syarat Latih Field -->
        <div class="form-group">
            {!! Form::label('syarat_latih', 'Syarat Latih:') !!}
            <p>{!! $jabatan->syarat_latih !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Syarat Pengalaman Field -->
        <div class="form-group">
            {!! Form::label('syarat_pengalaman', 'Syarat Pengalaman:') !!}
            <p>{!! $jabatan->syarat_pengalaman !!}</p>
        </div>
    </div>
</div>
<div class="row">
    {{-- <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $jabatan->deleted_at !!}</p>
        </div>
    </div> --}}
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $jabatan->created_at !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $jabatan->updated_at !!}</p>
        </div>
    </div>
</div>