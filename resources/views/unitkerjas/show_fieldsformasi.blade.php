<div class="row">
    <div class="col-md-3">
<!-- Nama Uk Field -->
<div class="form-group">
    {!! Form::label('nama_uk', 'Nama Unit Kerja:') !!}
    <p>{!! $unitkerja->nama_uk !!}</p>
</div>
    </div>
    <div class="col-md-3">
<!-- Jml Formasi Field -->
<div class="form-group">
    {!! Form::label('jml_formasi', 'Jumlah Formasi:') !!}
    <p>{!! $unitkerja->jml_formasi !!}</p>
</div>
    </div>
    <div class="col-md-3">
<!-- Jml Existing Field -->
<div class="form-group">
    {!! Form::label('jml_existing', 'Jml Existing:') !!}
    <p>{!! $unitkerja->karyawan_count !!}</p>
</div>

    </div>
    <div class="col-md-3">
<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('lowong', 'Lowong:') !!}
    <p>{!! $lowong !!}</p>
</div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('kekuatan', 'Kekuatan SDM:') !!}
    <p>{!! $kekuatan !!}</p>
</div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('kelas_jabatan', 'Kelas Jabatan:') !!}
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th style='text-align:center'>
                                No
                            </th>
                            <th style='text-align:center'>
                                Nama Kelas Jabatan
                            </th>
                            <th style='text-align:center'>
                                Jumlah Formasi
                            </th>
                            <th style='text-align:center'>
                                Jumlah Eksisting
                            </th>
                            <th style='text-align:center'>
                                Jumlah Lowong
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($kelasjabatan as $key => $item)
                            @php $key++; @endphp
                                <tr>
                                    <td style='text-align:center'>
                                        {{$key}} 
                                     </td>
                                     <td style='text-align:center'>
                                         {{$item['nama_kj']}}
                                     </td>
                                     <td style='text-align:center'>
                                         {{$item['jml_kls_jbt']}}
                                     </td>
                                     <td style='text-align:center'>
                                        {{$item['jml_kls_jbt']}}
                                    </td>
                                    <td style='text-align:center'>
                                        {{$item['jml_butuh']}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>













