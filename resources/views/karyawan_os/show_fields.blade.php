<div class="row">
    <div class="col-md-3">
        <!-- Nama Field -->
        <div class="form-group">
            {!! Form::label('nama', 'Nama:') !!}
            <p>{!! $karyawanOs->nama !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Id Fungsi Field -->
        <div class="form-group">
            {!! Form::label('id_fungsi', 'Fungsi:') !!}
            <p>{!! $karyawanOs->fungsi->nama_fungsi??'' !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Id Unitkerja Field -->
        <div class="form-group">
            {!! Form::label('id_unitkerja', 'Unit Kerja:') !!}
            <p>{!! $karyawanOs->unitkerja->nama_uk??''!!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('id_vendor', 'Vendor:') !!}
            <p>{!! $karyawanOs->vendor->nama_vendor??''!!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <!-- Tgl Lahir Field -->
        <div class="form-group">
            {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
            <p>{!! $karyawanOs->tgl_lahir !!}</p>
        </div>
    </div>
    {{-- <div class="col-md-3">
        <!-- Usia Field -->
        <div class="form-group">
            {!! Form::label('usia', 'Usia:') !!}
            <p>{!! $karyawanOs->usia !!}</p>
        </div>
    </div> --}}
    <div class="col-md-3">
        <!-- Gender Field -->
        <div class="form-group">
            {!! Form::label('gender', 'Jenis Kelamin:') !!}
            <p>{!! $karyawanOs->gender !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- No Bpjs Tk Field -->
        <div class="form-group">
            {!! Form::label('no_bpjs_tk', 'No Bpjs Tk:') !!}
            <p>{!! $karyawanOs->no_bpjs_tk !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Doc No Bpjs Tk Field -->
        <div class="form-group">
            {!! Form::label('doc_no_bpjs_tk', 'Dokumen No Bpjs Tk:') !!}
            </br>
            <div class="row">
                @if(isset($karyawanOs['Docbpjstk']))
                @foreach($karyawanOs['Docbpjstk'] as $key => $dt)
                @php
                $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
                @endphp
                @if($ext == 'pdf' || $ext == 'PDF')
                <div class="col-6 col-md-3">
                    <a href="{{'/storage/'.$dt}}">
                        <button type="button" class="btn btn-default btn-lg btn-block"><span
                                class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
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
<div class="row">
    <div class="col-md-3">
        <!-- No Bpjs Kesehatan Field -->
        <div class="form-group">
            {!! Form::label('no_bpjs_kesehatan', 'No Bpjs Kesehatan:') !!}
            <p>{!! $karyawanOs->no_bpjs_kesehatan !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Doc No Bpjs Kesehatan Field -->
        <div class="form-group">
            {!! Form::label('doc_no_bpjs_kesehatan', 'Dokumen No Bpjs Kesehatan:') !!}
            </br>
            <div class="row">
                @if(isset($karyawanOs['Docnobpjskesehatan']))
                @foreach($karyawanOs['Docnobpjskesehatan'] as $key => $dt)
                @php
                $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
                @endphp
                @if($ext == 'pdf' || $ext == 'PDF')
                <div class="col-6 col-md-3">
                    <a href="{{'/storage/'.$dt}}">
                        <button type="button" class="btn btn-default btn-lg btn-block"><span
                                class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
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
<div class="row">
    <div class="col-md-3">
        <!-- Lisensi Field -->
        <div class="form-group">
            {!! Form::label('lisensi', 'Lisensi:') !!}
            <p>{!! $karyawanOs->lisensi !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Doc Lisensi Field -->
        <div class="form-group">
            {!! Form::label('doc_lisensi', 'Dokumen Lisensi:') !!}
            </br>
            <div class="row">
                @if(isset($karyawanOs['Doclisensi']))
                @foreach($karyawanOs['Doclisensi'] as $key => $dt)
                @php
                $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
                @endphp
                @if($ext == 'pdf' || $ext == 'PDF')
                <div class="col-6 col-md-3">
                    <a href="{{'/storage/'.$dt}}">
                        <button type="button" class="btn btn-default btn-lg btn-block"><span
                                class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
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
<div class="row">
    <div class="col-md-3">
        <!-- No Lisensi Field -->
        <div class="form-group">
            {!! Form::label('no_lisensi', 'No Lisensi:') !!}
            <p>{!! $karyawanOs->no_lisensi !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Doc No Lisensi Field -->
        <div class="form-group">
            {!! Form::label('doc_no_lisensi', 'Dokumen No Lisensi:') !!}
            </br>
            <div class="row">
                @if(isset($karyawanOs['Docnolisensi']))
                @foreach($karyawanOs['Docnolisensi'] as $key => $dt)
                @php
                $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
                @endphp
                @if($ext == 'pdf' || $ext == 'PDF')
                <div class="col-6 col-md-3">
                    <a href="{{'/storage/'.$dt}}">
                        <button type="button" class="btn btn-default btn-lg btn-block"><span
                                class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
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

<div class="row">
    <div class="col-md-3">
        <!-- Jangka Waktu Field -->
        <div class="form-group">
            {!! Form::label('jangka_waktu', 'Jangka Waktu:') !!}
            <p>{!! $karyawanOs->jangka_waktu !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Doc Jangka Waktu Field -->
        <div class="form-group">
            {!! Form::label('doc_jangka_waktu', 'Dokumen Jangka Waktu:') !!}
            </br>
            <div class="row">
                @if(isset($karyawanOs['Docjangkawaktu']))
                @foreach($karyawanOs['Docjangkawaktu'] as $key => $dt)
                @php
                $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
                @endphp
                @if($ext == 'pdf' || $ext == 'PDF')
                <div class="col-6 col-md-3">
                    <a href="{{'/storage/'.$dt}}">
                        <button type="button" class="btn btn-default btn-lg btn-block"><span
                                class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
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
<div class="row">
    <div class="col-md-3">
        <!-- No Kontrak Kerja Field -->
        <div class="form-group">
            {!! Form::label('no_kontrak_kerja', 'No Kontrak Kerja:') !!}
            <p>{!! $karyawanOs->no_kontrak_kerja !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Doc No Kontrak Kerja Field -->
        <div class="form-group">
            {!! Form::label('doc_no_kontrak_kerja', 'Dokumen No Kontrak Kerja:') !!}
            </br>
            <div class="row">
                @if(isset($karyawanOs['Docnokontrakkerja']))
                @foreach($karyawanOs['Docnokontrakkerja'] as $key => $dt)
                @php
                $ext = pathinfo(storage_path().asset('/storage/'.$dt), PATHINFO_EXTENSION);
                @endphp
                @if($ext == 'pdf' || $ext == 'PDF')
                <div class="col-6 col-md-3">
                    <a href="{{'/storage/'.$dt}}">
                        <button type="button" class="btn btn-default btn-lg btn-block"><span
                                class="glyphicon glyphicon-file" aria-hidden="true"></span></br>PDF {{$key}}</button>
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
<div class="row">
    <div class="col-md-3">

        <!-- Deleted At Field -->
        <div class="form-group">
            {!! Form::label('deleted_at', 'Dihapus Pada:') !!}
            <p>{!! $karyawanOs->deleted_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Dibuat Pada:') !!}
            <p>{!! $karyawanOs->created_at !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Diubah Pada:') !!}
            <p>{!! $karyawanOs->updated_at !!}</p>
        </div>
    </div>
</div>