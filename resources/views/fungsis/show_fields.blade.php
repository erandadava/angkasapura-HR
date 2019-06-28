<div class="row">
  <div class="col-md-3"><!-- id Field -->
    <div class="form-group">
        {!! Form::label('id', 'id:') !!}
        <p>{!! $fungsi->id !!}</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('nama_fungsi', 'Nama Fungsi:') !!}
        <p>{!! $fungsi->nama_fungsi !!}</p>
    </div>
  </div>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('jml_butuh', 'Jml Butuh:') !!}
        <p>{!! $fungsi->jml_butuh !!}</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('deleted_at', 'Deleted At:') !!}
        <p>{!! $fungsi->deleted_at !!}</p>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $fungsi->created_at !!}</p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $fungsi->updated_at !!}</p>
    </div>
  </div>
</div>
