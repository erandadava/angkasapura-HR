<!-- Tanggal Pelaporan Field -->
<div class="form-group">
    {!! Form::label('tanggal_pelaporan', 'Tanggal Pelaporan:') !!}
    <p>{!! $osperformance->tanggal_pelaporan !!}</p>
</div>

<!-- Keluhan Field -->
<div class="form-group">
    {!! Form::label('keluhan', 'Keluhan:') !!}
    <p>{!! $osperformance->keluhan !!}</p>
</div>

<!-- File Pelaporan Field -->
<div class="form-group">
    {!! Form::label('file_pelaporan', 'File Pelaporan:') !!}
    </br>
    <div class="row">
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
        @endif
    </div>
</div>

<!-- Tanggal Penyelesaian Field -->
<div class="form-group">
    {!! Form::label('tanggal_penyelesaian', 'Tanggal Penyelesaian:') !!}
    <p>{!! $osperformance->tanggal_penyelesaian !!}</p>
</div>

<!-- Hasil Field -->
<div class="form-group">
    {!! Form::label('hasil', 'Hasil:') !!}
    <p>{!! $osperformance->hasil !!}</p>
</div>

<!-- File Penyelesaian Field -->
<div class="form-group">
    {!! Form::label('file_penyelesaian', 'File Penyelesaian:') !!}
    </br>
    <div class="row">
        @if(isset($osperformance['Filepenyelesaian']))
            <div class="form-group col-sm-12 col-lg-12">
            @foreach($osperformance['Filepenyelesaian'] as $key => $dt)
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
        @endif
    </div>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Dihapus Pada:') !!}
    <p>{!! $osperformance->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Dibuat Pada:') !!}
    <p>{!! $osperformance->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Diubah Pada:') !!}
    <p>{!! $osperformance->updated_at !!}</p>
</div>

