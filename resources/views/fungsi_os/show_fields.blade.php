<div class="row">
    <div class="col-md-3">
        <!-- Nama Fungsi Field -->
        <div class="form-group">
            {!! Form::label('nama_fungsi', 'Nama Fungsi:') !!}
            <p>{!! $fungsiOs->nama_fungsi !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Deleted At:') !!}
            <p>{!! $fungsiOs->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $fungsiOs->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3"> 
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $fungsiOs->updated_at !!}</p>
        </div>
    </div>
</div>








