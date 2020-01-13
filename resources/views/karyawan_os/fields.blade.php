<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('nik', 'NIK:') !!}
    {!! Form::number('nik', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Fungsi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_fungsi', 'Nama Fungsi:') !!}
    {!! Form::select('id_fungsi', $fungsi, null, ['class' => 'form-control']) !!}
</div>

<!-- Id Unitkerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'Unit Kerja:') !!}
    {!! Form::select('id_unitkerja', $unitkerja, null, ['class' => 'form-control']) !!}
</div>
@hasrole('Vendor')
    {!! Form::hidden('id_vendor', $id_vendor->id??'', ['class' => 'form-control']) !!}
@else
    <div class="form-group col-sm-6">
        {!! Form::label('id_vendor', 'Vendor:') !!}
        {!! Form::select('id_vendor', $vendor, null, ['class' => 'form-control']) !!}
    </div>
@endhasrole

{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_vendor', 'Nama Vendor:') !!}
    {!! Form::select('id_vendor', $vendor, null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Tgl Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tgl_lahir', null, ['class' => 'form-control','id'=>'tgl_lahir']) !!}
</div>

<!-- Usia Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('usia', 'Usia:') !!}
    {!! Form::number('usia', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Jenis Kelamin:') !!}
    {!! Form::select('gender',['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'],null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('penempatan', 'penempatan:') !!}
    {!! Form::text('penempatan', null, ['class' => 'form-control']) !!}
</div>

<!-- No Bpjs Tk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bpjs_tk', 'No Bpjs Tenaga Kerja:') !!}
    {!! Form::number('no_bpjs_tk', null, ['class' => 'form-control']) !!}
    
</div>

@if(isset($karyawanOs['Docbpjstk']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($karyawanOs['Docbpjstk'] as $key => $dt)
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
        {!! Form::label('ganti_doc_bpjs_tk', 'Ganti Dokumen Bpjs Tenaga Kerja:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_doc_bpjs_tk" onclick="bpjstk()">
    </div>
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  class="bpjstk" name="doc_no_bpjs_tk[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf" disabled="disabled">
    </div>
@else
    <!-- Doc No Bpjs Tk Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('doc_no_bpjs_tk', 'Dokumen No Bpjs Tenaga Kerja:') !!}
        <input  type="file"  name="doc_no_bpjs_tk[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
    </div>
@endif

<!-- No Bpjs Kesehatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bpjs_kesehatan', 'No Bpjs Kesehatan:') !!}
    {!! Form::text('no_bpjs_kesehatan', null, ['class' => 'form-control']) !!}
</div>

@if(isset($karyawanOs['Docnobpjskesehatan']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($karyawanOs['Docnobpjskesehatan'] as $key => $dt)
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
        {!! Form::label('ganti_doc_bpjs_kesehatan', 'Ganti Dokumen Bpjs Kesehatan:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_doc_bpjs_kesehatan" onclick="bpjskesehatan()">
    </div>
    <!-- Doc No Bpjs Kesehatan Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="doc_no_bpjs_kesehatan[]" class="bpjskesehatan" multiple="multiple" accept="image/png, image/jpeg, application/pdf" disabled="disabled">
    </div>
@else
    <!-- Doc No Bpjs Kesehatan Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('doc_no_bpjs_kesehatan', 'Dokumen No Bpjs Kesehatan:') !!}
        <input  type="file"  name="doc_no_bpjs_kesehatan[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
    </div>
@endif

<!-- Lisensi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lisensi', 'Lisensi:') !!}
    {!! Form::text('lisensi', null, ['class' => 'form-control']) !!}
</div>

@if(isset($karyawanOs['Doclisensi']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($karyawanOs['Doclisensi'] as $key => $dt)
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
        {!! Form::label('ganti_doc_lisensi', 'Ganti Dokumen Lisensi:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_doc_lisensi" onclick="lisensinya()">
    </div>
    <!-- Doc Lisensi Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="doc_lisensi[]" class="lisensi" multiple="multiple" accept="image/png, image/jpeg, application/pdf" disabled="disabled">
    </div>
@else
    <!-- Doc Lisensi Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('doc_lisensi', 'Doc Lisensi:') !!}
        <input  type="file"  name="doc_lisensi[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
    </div>
@endif

<!-- No Lisensi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_lisensi', 'No Lisensi:') !!}
    {!! Form::text('no_lisensi', null, ['class' => 'form-control']) !!}
</div>


{{-- @if(isset($karyawanOs['Docnolisensi']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($karyawanOs['Docnolisensi'] as $key => $dt)
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
        {!! Form::label('ganti_doc_no_lisensi', 'Ganti Dokumen No Lisensi:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_doc_no_lisensi" onclick="nolisensinya()">
    </div>
    <!-- Doc No Lisensi Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="doc_no_lisensi[]" class="no_lisensi" multiple="multiple" accept="image/png, image/jpeg, application/pdf" disabled="disabled">
    </div>
@else
    <!-- Doc No Lisensi Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('doc_no_lisensi', 'Dokumen No Lisensi:') !!}
        <input  type="file"  name="doc_no_lisensi[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
    </div>
@endif --}}

<!-- Jangka Waktu Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('jangka_waktu', 'Jangka Waktu:') !!}
    {!! Form::text('jangka_waktu', null, ['class' => 'form-control']) !!}
</div> --}}

@if(isset($karyawanOs['Docjangkawaktu']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($karyawanOs['Docjangkawaktu'] as $key => $dt)
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
        {!! Form::label('ganti_doc_jangka_waktu', 'Ganti Dokumen Jangka Waktu:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_doc_jangka_waktu" onclick="jangkawaktu()">
    </div>
    <!-- Doc Jangka Waktu Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="doc_jangka_waktu[]" class="jangka_waktu" multiple="multiple" accept="image/png, image/jpeg, application/pdf" disabled="disabled">
    </div>
@else
    <!-- Doc Jangka Waktu Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('doc_jangka_waktu', 'Dokumen Jangka Waktu:') !!}
        <input  type="file"  name="doc_jangka_waktu[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
    </div>
@endif

<!-- No Kontrak Kerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_kontrak_kerja', 'No Kontrak Kerja:') !!}
    {!! Form::text('no_kontrak_kerja', null, ['class' => 'form-control']) !!}
</div>

@if(isset($karyawanOs['Docnokontrakkerja']))
    <div class="form-group col-sm-12 col-lg-12">
    @foreach($karyawanOs['Docnokontrakkerja'] as $key => $dt)
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
        {!! Form::label('ganti_doc_no_kontrak_kerja', 'Ganti Dokumen No Kontrak Kerja:') !!}
        <input type="checkbox" id="myCheck"   name="ganti_doc_no_kontrak_kerja" onclick="kontrakkerja()">
    </div>
    <!-- Doc No Kontrak Kerja Field -->
    <div class="form-group col-sm-12 col-lg-12">
        <input  type="file"  name="doc_no_kontrak_kerja[]" class="kontrak_kerja" multiple="multiple" accept="image/png, image/jpeg, application/pdf" disabled="disabled">
    </div>
@else
    <!-- Doc No Kontrak Kerja Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('doc_no_kontrak_kerja', 'Dokumen No Kontrak Kerja:') !!}
        <input  type="file"  name="doc_no_kontrak_kerja[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
    </div>
@endif
<div class="form-group col-sm-6">
    {!! Form::label('pend_akhir', 'Pendidikan Akhir:') !!}
    {!! Form::select('pend_akhir', [
        'SMP' => 'SMP',
        'SMU' => 'SMU',
        'SMK' => 'SMK',
        'DI  - Diploma I' => 'DI  - Diploma I',
        'DII  - Diploma II' => 'DII  - Diploma II',
        'DIII  - Diploma III' => 'DIII  - Diploma III',
        'DIV - Diploma IV' => 'DIV - Diploma IV',
        'S1 - Strata 1' => 'S1 - Strata 1',
        'S2 - Strata 2' => 'S2 - Strata 2',
        'S3 - Strata 3' => 'S3 - Strata 3',
    ], null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('jurusan', 'Jurusan:') !!}
    {!! Form::text('jurusan', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('tmt_awal_kontrak', 'TMT Awal Kontrak:') !!}
    {!! Form::text('tmt_awal_kontrak', null, ['class' => 'form-control','id'=>'tmt_awal_kontrak','required'=>'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('tmt_akhir_kontrak', 'TMT Akhir Kontrak:') !!}
    {!! Form::text('tmt_akhir_kontrak', null, ['class' => 'form-control','id'=>'tmt_akhir_kontrak','required'=>'required']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('mulai_masa_berlaku_lisensi', 'Mulai Masa Berlaku Lisensi:') !!}
    {!! Form::text('mulai_masa_berlaku_lisensi', null, ['class' => 'form-control','id'=>'mulai_masa_berlaku_lisensi']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('selesai_masa_berlaku_lisensi', 'Selesai Masa Berlaku Lisensi:') !!}
    {!! Form::text('selesai_masa_berlaku_lisensi', null, ['class' => 'form-control','id'=>'selesai_masa_berlaku_lisensi']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('karyawanOs.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_lahir').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        })
        $('#tmt_awal_kontrak').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        })
        $('#tmt_akhir_kontrak').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        })
        $('#mulai_masa_berlaku_lisensi').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        })
        $('#selesai_masa_berlaku_lisensi').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        })
        function bpjskesehatan(){
            $(".bpjskesehatan").val(null);
            $(".bpjskesehatan").attr('disabled', !$(".bpjskesehatan").attr('disabled'));
        };
        function bpjstk(){
            $(".bpjstk").val(null);
            $(".bpjstk").attr('disabled', !$(".bpjstk").attr('disabled'));
        };
        function lisensinya(){
            $(".lisensi").val(null);
            $(".lisensi").attr('disabled', !$(".lisensi").attr('disabled'));
        };
        function nolisensinya(){
            $(".no_lisensi").val(null);
            $(".no_lisensi").attr('disabled', !$(".no_lisensi").attr('disabled'));
        };
        function jangkawaktu(){
            $(".jangka_waktu").val(null);
            $(".jangka_waktu").attr('disabled', !$(".jangka_waktu").attr('disabled'));
        };
        function kontrakkerja(){
            $(".kontrak_kerja").val(null);
            $(".kontrak_kerja").attr('disabled', !$(".kontrak_kerja").attr('disabled'));
        };
    </script>
@endsection