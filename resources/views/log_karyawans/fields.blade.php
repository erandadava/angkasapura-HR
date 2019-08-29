<!-- Id Karyawan Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_karyawan_fk', 'Id Karyawan Fk:') !!}
    {!! Form::number('id_karyawan_fk', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Jabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_jabatan', 'Id Jabatan:') !!}
    {!! Form::number('id_jabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Status1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status1', 'Id Status1:') !!}
    {!! Form::number('id_status1', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Status2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_status2', 'Id Status2:') !!}
    {!! Form::number('id_status2', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Unitkerja Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unitkerja', 'Id Unitkerja:') !!}
    {!! Form::number('id_unitkerja', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('id_tipe_kar', 'Id Tipe Kar:') !!}
    {!! Form::number('id_tipe_kar', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Fungsi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_fungsi', 'Id Fungsi:') !!}
    {!! Form::number('id_fungsi', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Klsjabatan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_klsjabatan', 'Id Klsjabatan:') !!}
    {!! Form::number('id_klsjabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unit', 'Id Unit:') !!}
    {!! Form::number('id_unit', null, ['class' => 'form-control']) !!}
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

<!-- Update Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_date', 'Update Date:') !!}
    {!! Form::date('update_date', null, ['class' => 'form-control','id'=>'update_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#update_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('logKaryawans.index') !!}" class="btn btn-default">Cancel</a>
</div>
