<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tgl_lahir', 'Tgl Lahir:') !!}
    {!! Form::date('tgl_lahir', null, ['class' => 'form-control','id'=>'tgl_lahir']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tgl_lahir').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- id Kj Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_kj', 'id Kj:') !!}
    {!! Form::number('id_kj', null, ['class' => 'form-control']) !!}
</div>

<!-- id Jabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_jabatan', 'id Jabatan:') !!}
    {!! Form::number('id_jabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- id Status1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status1', 'id Status1:') !!}
    {!! Form::number('id_status1', null, ['class' => 'form-control']) !!}
</div>

<!-- id Status2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status2', 'id Status2:') !!}
    {!! Form::number('id_status2', null, ['class' => 'form-control']) !!}
</div>

<!-- id Unitkerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'id Unitkerja:') !!}
    {!! Form::number('id_unitkerja', null, ['class' => 'form-control']) !!}
</div>

<!-- Rencana Mpp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rencana_mpp', 'Rencana Mpp:') !!}
    {!! Form::date('rencana_mpp', null, ['class' => 'form-control','id'=>'rencana_mpp']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#rencana_mpp').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Rencana Pensiun Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rencana_pensiun', 'Rencana Pensiun:') !!}
    {!! Form::date('rencana_pensiun', null, ['class' => 'form-control','id'=>'rencana_pensiun']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#rencana_pensiun').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Pend Diakui Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pend_diakui', 'Pend Diakui:') !!}
    {!! Form::text('pend_diakui', null, ['class' => 'form-control']) !!}
</div>

<!-- id Org Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_org', 'id Org:') !!}
    {!! Form::number('id_org', null, ['class' => 'form-control']) !!}
</div>

<!-- id Posisi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_posisi', 'id Posisi:') !!}
    {!! Form::number('id_posisi', null, ['class' => 'form-control']) !!}
</div>

<!-- id Tipe Kar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_tipe_kar', 'id Tipe Kar:') !!}
    {!! Form::number('id_tipe_kar', null, ['class' => 'form-control']) !!}
</div>

<!-- Entry Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entry_date', 'Entry Date:') !!}
    {!! Form::date('entry_date', null, ['class' => 'form-control','id'=>'entry_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#entry_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('karyawans.index') !!}" class="btn btn-default">Cancel</a>
</div>
