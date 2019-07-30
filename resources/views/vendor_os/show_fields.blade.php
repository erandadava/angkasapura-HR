<div class="row">
    <div class="col-md-3">
        <!-- Nama Vendor Field -->
        <div class="form-group">
            {!! Form::label('nama_vendor', 'Nama Vendor:') !!}
            <p>{!! $vendorOs->nama_vendor !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            <p>{!! $vendorOs->email !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Telepon Field -->
        <div class="form-group">
            {!! Form::label('telepon', 'Telepon:') !!}
            <p>{!! $vendorOs->telepon !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $vendorOs->updated_at !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <!-- Alamat Field -->
        <div class="form-group">
            {!! Form::label('alamat', 'Alamat:') !!}
            <p>{!! $vendorOs->alamat !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Is Active Field -->
        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            <p>
                @if($vendorOs->is_active==0)
                <span class='label label-danger'>Non-Aktif</span>
                @else
                <span class='label label-success'>Aktif</span>
                @endif
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $vendorOs->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $vendorOs->created_at !!}</p>
        </div>
    </div>
</div>
