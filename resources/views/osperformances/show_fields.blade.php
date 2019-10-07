<div class="row">
    <div class="col-md-3">
        <!-- Tanggal Pelaporan Field -->
        <div class="form-group">
            {!! Form::label('tanggal_pelaporan', 'Tanggal Pelaporan:') !!}
            <p>{!! $osperformance->tanggal_pelaporan !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Keluhan Field -->
        <div class="form-group">
            {!! Form::label('keluhan', 'Keluhan:') !!}
            <p>{!! $osperformance->keluhan !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Tanggal Penyelesaian Field -->
        <div class="form-group">
            {!! Form::label('tanggal_penyelesaian', 'Tanggal Penyelesaian:') !!}
            <p>{!! $osperformance->tanggal_penyelesaian !!}</p>
        </div>
    </div>

    <div class="col-md-3">
        <!-- Hasil Field -->
        <div class="form-group">
            {!! Form::label('hasil', 'Hasil:') !!}
            <p>{!! $osperformance->hasil !!}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('id_vendor', 'Nama Vendor:') !!}
            <p>{!! $osperformance->vendor_os->nama_vendor??''!!}</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Dihapus Pada:') !!}
            <p>{!! $osperformance->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Dibuat Pada:') !!}
            <p>{!! $osperformance->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Diubah Pada:') !!}
            <p>{!! $osperformance->updated_at !!}</p>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
                            <button type="button" class="btn btn-default btn-lg btn-block"><span
                                    class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF
                                {{$key}}</button>
                        </a>
                    </div>
                    @elseif($ext == 'rar' || $ext == 'RAR')
                    <div class="col-6 col-md-3">
                        <a href="{{'/storage/'.$dt}}">
                            <button type="button" class="btn btn-default btn-lg btn-block"><span
                                    class="glyphicon glyphicon-file" aria-hidden="true"></span></br>RAR
                                {{$key}}</button>
                        </a>
                    </div>
                    @elseif($ext == 'zip' || $ext == 'ZIP')
                    <div class="col-6 col-md-3">
                        <a href="{{'/storage/'.$dt}}">
                            <button type="button" class="btn btn-default btn-lg btn-block"><span
                                    class="glyphicon glyphicon-file" aria-hidden="true"></span></br>ZIP
                                {{$key}}</button>
                        </a>
                    </div>
                    @else
                    <div class="col-6 col-md-3">
                        <a href="{{'/storage/'.$dt}}"><img src="{{asset('/storage/'.$dt)}}" width="100%" alt=""
                                srcset=""></a>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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
                            <button type="button" class="btn btn-default btn-lg btn-block"><span
                                    class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF
                                {{$key}}</button>
                        </a>
                    </div>
                    @elseif($ext == 'rar' || $ext == 'RAR')
                    <div class="col-6 col-md-3">
                        <a href="{{'/storage/'.$dt}}">
                            <button type="button" class="btn btn-default btn-lg btn-block"><span
                                    class="glyphicon glyphicon-file" aria-hidden="true"></span></br>RAR
                                {{$key}}</button>
                        </a>
                    </div>
                    @elseif($ext == 'zip' || $ext == 'ZIP')
                    <div class="col-6 col-md-3">
                        <a href="{{'/storage/'.$dt}}">
                            <button type="button" class="btn btn-default btn-lg btn-block"><span
                                    class="glyphicon glyphicon-file" aria-hidden="true"></span></br>ZIP
                                {{$key}}</button>
                        </a>
                    </div>
                    @else
                    <div class="col-6 col-md-3">
                        <a href="{{'/storage/'.$dt}}"><img src="{{asset('/storage/'.$dt)}}" width="100%" alt=""
                                srcset=""></a>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>