
<!-- Nama Vendor Field -->
<div class="form-group">
    {!! Form::label('nama_vendor', 'Nama Vendor:') !!}
    <p>{!! $vendorOs->nama_vendor !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $vendorOs->email !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{!! $vendorOs->password !!}</p>
</div>

<!-- Telepon Field -->
<div class="form-group">
    {!! Form::label('telepon', 'Telepon:') !!}
    <p>{!! $vendorOs->telepon !!}</p>
</div>

<!-- Alamat Field -->
<div class="form-group">
    {!! Form::label('alamat', 'Alamat:') !!}
    <p>{!! $vendorOs->alamat !!}</p>
</div>

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

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $vendorOs->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $vendorOs->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $vendorOs->updated_at !!}</p>
</div>

