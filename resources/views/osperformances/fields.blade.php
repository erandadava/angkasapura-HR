<!-- Tanggal Pelaporan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_pelaporan', 'Tanggal Pelaporan:') !!}
    {!! Form::text('tanggal_pelaporan', null, ['class' => 'form-control','id'=>'tanggal_pelaporan']) !!}
</div>

<!-- Keluhan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keluhan', 'Keluhan:') !!}
    {!! Form::text('keluhan', null, ['class' => 'form-control']) !!}
</div>
@if(isset($osperformance['Filepelaporan']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($osperformance['Filepelaporan'] as $key => $dt)
    @php
        $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
    @endphp
        @if($ext == 'pdf' || $ext == 'PDF')
            <div class="col-6 col-md-3">
                <a href="{{'/storage/'.$dt}}">
                    <button type="button" class="btn btn-default btn-lg btn-block"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
                </a>
            </div>
        @else
            <div class="col-6 col-md-3">
                <a href="{{'/storage/'.$dt}}"><img src="{{asset('/storage/'.$dt)}}" width="100%" alt="" srcset=""></a>
            </div>
        @endif
    @endforeach
    </div>
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('ganti_file_pelaporan', 'Ganti File Pelaporan:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_file_pelaporan" onclick="filepelaporan()">
    </div>
    <!-- Doc No Kontrak Kerja Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="file_pelaporan[]" class="filepelaporan" multiple="multiple" accept="image/png, image/jpeg, application/pdf,.zip,.rar" disabled="disabled">
    </div>
@else
    <!-- File Pelaporan Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('file_pelaporan', 'File Pelaporan:') !!}
        <input  type="file"  name="file_pelaporan[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf,.zip,.rar">
    </div>
@endif


<!-- Tanggal Penyelesaian Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_penyelesaian', 'Tanggal Penyelesaian:') !!}
    {!! Form::text('tanggal_penyelesaian', null, ['class' => 'form-control','id'=>'tanggal_penyelesaian']) !!}
</div>

<!-- Hasil Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hasil', 'Hasil:') !!}
    {!! Form::text('hasil', null, ['class' => 'form-control']) !!}
</div>

@hasrole('Vendor')
    {!! Form::hidden('id_vendor_fk', $id_vendor_fk->id??'', ['class' => 'form-control']) !!}
@else
    <div class="form-group col-sm-6">
        {!! Form::label('id_vendor_fk', 'Vendor:') !!}
        {!! Form::select('id_vendor_fk', $vendor_os, null, ['class' => 'form-control']) !!}
    </div>
@endhasrole


@if(isset($osperformance['filepenyelesaian']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($osperformance['filepenyelesaian'] as $key => $dt)
    @php
        $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
    @endphp
        @if($ext == 'pdf' || $ext == 'PDF')
            <div class="col-6 col-md-3">
                <a href="{{'/storage/'.$dt}}">
                    <button type="button" class="btn btn-default btn-lg btn-block"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
                </a>
            </div>
        @else
            <div class="col-6 col-md-3">
                <a href="{{'/storage/'.$dt}}"><img src="{{asset('/storage/'.$dt)}}" width="100%" alt="" srcset=""></a>
            </div>
        @endif
    @endforeach
    </div>
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('ganti_file_penyelesaian', 'Ganti File Penyelesaian:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_file_pelaporan" onclick="filepenyelesaian()">
    </div>
    <!-- Doc No Kontrak Kerja Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="file_penyelesaian[]" class="filepenyelesaian" multiple="multiple" accept="image/png, image/jpeg, application/pdf,.zip,.rar" disabled="disabled">
    </div>
@else
    <!-- File Penyelesaian Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('file_penyelesaian', 'File Penyelesaian:') !!}
        <input  type="file"  name="file_penyelesaian[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf,.zip,.rar">
    </div>
@endif


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('osperformances.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tanggal_penyelesaian').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });
        $('#tanggal_pelaporan').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });
        function filepelaporan(){
            $(".filepelaporan").val(null);
            $(".filepelaporan").attr('disabled', !$(".filepelaporan").attr('disabled'));
        };
        function filepenyelesaian(){
            $(".filepenyelesaian").val(null);
            $(".filepenyelesaian").attr('disabled', !$(".filepenyelesaian").attr('disabled'));
        };
    </script>
@endsection