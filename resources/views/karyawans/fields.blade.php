<div class="form-group col-sm-6">
    {!! Form::label('nik', 'NIK:') !!}
    {!! Form::text('nik', null, ['class' => 'form-control']) !!}
</div>
<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- id Jabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_jabatan', 'Jabatan:') !!}
    {!! Form::select('id_jabatan', $jabatan, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'Unit Kerja:') !!}
    {!! Form::select('id_unitkerja',$unitkerja, null, ['class' => 'form-control', 'id' => 'unitkerja']) !!}
</div>

<!-- id Kj Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_klsjabatan', 'Kelas Jabatan:') !!}
    {!! Form::select('id_klsjabatan', $klsjabatan, null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Jenis Kelamin:') !!}
    {!! Form::select('gender',['Male' => 'Male', 'Female' => 'Female'],null, ['class' => 'form-control']) !!}
</div>
<!-- Tgl Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tgl_lahir', null, ['class' => 'form-control','id'=>'tgl_lahir']) !!}
</div>

<!-- id Status1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status1', 'Status 1:') !!}
    {!! Form::select('id_status1', $statuskar, null, ['class' => 'form-control']) !!}
</div>

<!-- id Status2 Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_status2', 'Status 2:') !!}
    {!! Form::select('id_status2', $statuskar, null, ['class' => 'form-control']) !!}
</div> --}}

<!-- id Unitkerja Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'Unit Kerja:') !!}
    {!! Form::select('id_unitkerja',$unitkerja, null, ['class' => 'form-control', 'id' => 'unitkerja']) !!}
</div> --}}

{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_unit', 'Unit:') !!}
    {!! Form::select('id_unit',$unit, null, ['class' => 'form-control', 'id' => 'unitkerja']) !!}
</div> --}}
    
<!-- Rencana Mpp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rencana_mpp', 'Rencana MPP:') !!}
    {!! Form::text('rencana_mpp', null, ['class' => 'form-control','id'=>'rencana_mpp']) !!}
</div>

<!-- Rencana Pensiun Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rencana_pensiun', 'Pensiun:') !!}
    {!! Form::text('rencana_pensiun', null, ['class' => 'form-control','id'=>'rencana_pensiun']) !!}
</div>

<!-- Pend Diakui Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pend_diakui', 'Pend Diakui:') !!}
    {!! Form::select('pend_diakui', [
        'SLTA' => 'SLTA',
        'SLTP' => 'SLTP',
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
    {!! Form::label('pend_milik', 'Pend milik:') !!}
    {!! Form::select('pend_milik', [
        'SLTA' => 'SLTA',
        'SLTP' => 'SLTP',
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
    {!! Form::label('pend_akhir', 'Pendidikan Akhir:') !!}
    {!! Form::text('pend_akhir', null, ['class' => 'form-control','id'=>'pend_akhir']) !!}
</div>

<!-- id Org Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_org', 'id Org:') !!}
    {!! Form::number('id_org', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- id Posisi Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_posisi', 'id Posisi:') !!}
    {!! Form::number('id_posisi', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- id Tipe Kar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_tipe_kar', 'Tipe Karyawan:') !!}
    {!! Form::select('id_tipe_kar', $tipekar, null, ['class' => 'form-control']) !!}
</div>
{{-- <div class="form-group col-sm-6">
    {!! Form::label('id_fungsi', 'Fungsi :') !!}
    {!! Form::select('id_fungsi',$fungsi, null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Entry Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entry_date', 'Entry Date:') !!}
    {!! Form::text('entry_date', null, ['class' => 'form-control','id'=>'entry_date']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('tmt_date', 'Terhitung Mulai Tanggal:') !!}
    {!! Form::text('tmt_date', null, ['class' => 'form-control','id'=>'tmt_date']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('karyawans.index') !!}" class="btn btn-default">Batal</a>
</div>


@section('scripts')

    <script type="text/javascript">
   function validateForm() {
       var idunitkerja = $("#unitkerja option:selected").val();
       var uk = {!!$dtunitkerja!!};
       var status = 0;
        @if(isset($karyawan['id_unitkerja']))
            if(idunitkerja == {{$karyawan['id_unitkerja']}}){
                return true;
            }
        @endif
       $.each(uk, function(i, v) {
            if (v.id == idunitkerja ) { 
                if(v.Lowongan == 0){
                    alert("Lowongan Telah Habis Pada Unit Kerja "+v.nama_uk);
                    status=1;
                }
            }
        });   
        if(status==1){
            return false;
        }
    }
    
        $('#tgl_lahir').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });
 
        $('#rencana_mpp').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });

        $('#rencana_pensiun').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });

        $('#entry_date').datetimepicker({
            format: 'Y-MM-DD hh:mm:ss',
            useCurrent: true
        });

        $('#tmt_date').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });

        $('#tgl_lahir').on('dp.change', function(e){ return _calculateAge($('#tgl_lahir').val()); })    

        function _calculateAge(birthday) 
        { // birthday is a date
            var birth_date = new Date(birthday);
            var ageDifMs = Date.now() - birth_date.getTime();
            var firstDay = new Date(birth_date.getFullYear() + 55, birth_date.getMonth(), 1);
            var c = new Date(firstDay);
            
            $('#rencana_mpp').data("DateTimePicker").date(c);
        }

        $('#tgl_lahir').on('dp.change', function(e){ return _calculatePension($('#tgl_lahir').val()); })    

        function _calculatePension(birthday) 
        { // birthday is a date
            var birth_date = new Date(birthday);
            var ageDifMs = Date.now() - birth_date.getTime();
            var firstDay = new Date(birth_date.getFullYear() + 56, birth_date.getMonth() + 1, 1); // take firstDay of the month      
            var c = new Date(firstDay);
            
            $('#rencana_pensiun').data("DateTimePicker").date(c);
        }
        
    </script>
@endsection