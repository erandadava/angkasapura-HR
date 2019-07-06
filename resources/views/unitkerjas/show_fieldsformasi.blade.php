<!-- Nama Uk Field -->
<div class="form-group">
    {!! Form::label('nama_uk', 'Nama Unit Kerja:') !!}
    <p>{!! $unitkerja->nama_uk !!}</p>
</div>

<!-- Jml Formasi Field -->
<div class="form-group">
    {!! Form::label('jml_formasi', 'Jumlah Formasi:') !!}
    <p>{!! $unitkerja->jml_formasi !!}</p>
</div>

<!-- Jml Existing Field -->
<div class="form-group">
    {!! Form::label('jml_existing', 'Jml Existing:') !!}
    <p>{!! $unitkerja->karyawan_count !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('lowong', 'Lowong:') !!}
    <p>{!! $lowong !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('kekuatan', 'Kekuatan SDM:') !!}
    <p>{!! $kekuatan !!}</p>
</div>

<div class="form-group">
    {!! Form::label('kelas_jabatan', 'Kelas Jabatan:') !!}
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <th style='text-align:center'>
                        No
                    </th>
                    <th style='text-align:center'>
                        Nama Kelas Jabatan
                    </th>
                    <th style='text-align:center'>
                        Jumlah Kelas Jabatan
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



