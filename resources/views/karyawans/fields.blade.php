<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Jenis Kelamin:') !!}
    {!! Form::select('gender',['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'],null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tgl_lahir', null, ['class' => 'form-control','id'=>'tgl_lahir']) !!}
</div>

<!-- Id Kj Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_kj', 'Kelas Jabatan:') !!}
    {!! Form::select('id_kj', $klsjabatan, null, ['class' => 'form-control']) !!}
</div>

<!-- Id Jabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_jabatan', 'Jabatan:') !!}
    {!! Form::select('id_jabatan', $jabatan, null, ['class' => 'form-control']) !!}
</div>

<!-- Id Status1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status1', 'Status 1:') !!}
    {!! Form::select('id_status1', $statuskar, null, ['class' => 'form-control']) !!}
</div>

<!-- Id Status2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status2', 'Status 2:') !!}
    {!! Form::select('id_status2', $statuskar, null, ['class' => 'form-control']) !!}
</div>

<!-- Id Unitkerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'Unit Kerja:') !!}
    {!! Form::select('id_unitkerja',$unitkerja, null, ['class' => 'form-control']) !!}
</div>

<!-- Rencana Mpp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rencana_mpp', 'Rencana MPP:') !!}
    {!! Form::text('rencana_mpp', null, ['class' => 'form-control','id'=>'rencana_mpp']) !!}
</div>

<!-- Rencana Pensiun Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rencana_pensiun', 'Rencana Pensiun:') !!}
    {!! Form::text('rencana_pensiun', null, ['class' => 'form-control','id'=>'rencana_pensiun']) !!}
</div>

<!-- Pend Diakui Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pend_diakui', 'Pend Diakui:') !!}
    {!! Form::text('pend_diakui', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Org Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_org', 'Id Org:') !!}
    {!! Form::number('id_org', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Posisi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_posisi', 'Id Posisi:') !!}
    {!! Form::number('id_posisi', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Tipe Kar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_tipe_kar', 'Tipe Karyawan:') !!}
    {!! Form::select('id_tipe_kar', $tipekar, null, ['class' => 'form-control']) !!}
</div>

<!-- Entry Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entry_date', 'Entry Date:') !!}
    {!! Form::text('entry_date', null, ['class' => 'form-control','id'=>'entry_date']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('karyawans.index') !!}" class="btn btn-default">Batal</a>
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_lahir').datetimepicker({
            format: 'DD-mm-Y',
            useCurrent: false
        });
 
        $('#rencana_mpp').datetimepicker({
            format: 'DD-mm-Y',
            useCurrent: false
        });

        $('#rencana_pensiun').datetimepicker({
            format: 'DD-mm-Y',
            useCurrent: false
        });

        $('#entry_date').datetimepicker({
            format: 'DD-mm-Y hh:mm:ss',
            useCurrent: false
        });

    </script>
    
@endsection