<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Fungsi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_fungsi', 'Fungsi:') !!}
    {!! Form::select('id_fungsi', $fungsi, null, ['class' => 'form-control']) !!}
</div>

<!-- Id Unitkerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'Unit Kerja:') !!}
    {!! Form::select('id_unitkerja', $unitkerja, null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_lahir', 'Tgl Lahir:') !!}
    {!! Form::date('tgl_lahir', null, ['class' => 'form-control','id'=>'tgl_lahir']) !!}
</div>

<!-- Usia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usia', 'Usia:') !!}
    {!! Form::number('usia', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Jenis Kelamin:') !!}
    {!! Form::select('gender',['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'],null, ['class' => 'form-control']) !!}
</div>

<!-- No Bpjs Tk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bpjs_tk', 'No Bpjs Tk:') !!}
    {!! Form::number('no_bpjs_tk', null, ['class' => 'form-control']) !!}
    
</div>

<!-- Doc No Bpjs Tk Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_no_bpjs_tk', 'Doc No Bpjs Tk:') !!}
    <input  type="file"  name="doc_no_bpjs_tk[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
</div>
@foreach($karyawanOs['Docbpjstk'] as $dt)
    <img src="{{asset('/storage/'.$dt)}}" alt="" srcset="">
@endforeach
<!-- No Bpjs Kesehatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_bpjs_kesehatan', 'No Bpjs Kesehatan:') !!}
    {!! Form::text('no_bpjs_kesehatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc No Bpjs Kesehatan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_no_bpjs_kesehatan', 'Doc No Bpjs Kesehatan:') !!}
    <input  type="file"  name="doc_no_bpjs_kesehatan[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
</div>

<!-- Lisensi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lisensi', 'Lisensi:') !!}
    {!! Form::text('lisensi', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Lisensi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_lisensi', 'Doc Lisensi:') !!}
    <input  type="file"  name="doc_lisensi[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
</div>

<!-- No Lisensi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_lisensi', 'No Lisensi:') !!}
    {!! Form::text('no_lisensi', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc No Lisensi Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_no_lisensi', 'Doc No Lisensi:') !!}
    <input  type="file"  name="doc_no_lisensi[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
</div>

<!-- Jangka Waktu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jangka_waktu', 'Jangka Waktu:') !!}
    {!! Form::text('jangka_waktu', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc Jangka Waktu Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_jangka_waktu', 'Doc Jangka Waktu:') !!}
    <input  type="file"  name="doc_jangka_waktu[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
</div>

<!-- No Kontrak Kerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_kontrak_kerja', 'No Kontrak Kerja:') !!}
    {!! Form::text('no_kontrak_kerja', null, ['class' => 'form-control']) !!}
</div>

<!-- Doc No Kontrak Kerja Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('doc_no_kontrak_kerja', 'Doc No Kontrak Kerja:') !!}
    <input  type="file"  name="doc_no_kontrak_kerja[]" multiple="multiple" accept="image/png, image/jpeg, application/pdf">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('karyawanOs.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_lahir').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection