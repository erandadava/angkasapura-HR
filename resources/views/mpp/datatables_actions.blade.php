
<div class='btn-group'>
    <a href="{{ route('karyawans.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    </br>
</div>
</br>
@if(($status_pensiun == 'N' || $status_pensiun==null) && $Age==1)
<a href="#" class='btn btn-success btn-xs' data-toggle="modal" data-target="#modalAmbil{{$id}}">
        <i class="glyphicon glyphicon-ok"></i> Ambil
</a>
{!! Form::open(['url' => ['/updatepensiun', $id], 'method' => 'POST']) !!}
    
    {!! Form::hidden('status_pensiun', 'R', ['class' => 'form-control'])!!}
    <button type="submit" class='btn btn-danger btn-xs' onclick="return confirm('Yakin?')">
            <i class="glyphicon glyphicon-remove"></i> Tidak
    </button>

{!! Form::close() !!}

<!-- Modal -->
<div id="modalAmbil{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ambil Masa Pensiun</h4>
      </div>
      <div class="modal-body">
      {!! Form::open(['url' => ['/updatepensiun', $id], 'method' => 'POST']) !!}
            {!! Form::hidden('status_pensiun', 'M', ['class' => 'form-control'])!!}
            <div class="row">
                <div class="form-group col-sm-12">
                    {!! Form::label('status_masih', 'Apakah Unit Kerja Anda Masih Sama Seperti Yang Dulu?') !!}
                    </br>
                    {!! Form::select('status_masih', ['S' => 'Ya, masih sama', 'T' => 'Tidak'], ['class' => 'form-control']) !!}
                </div>
            </div>
            </br>
            <div class="row">
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-default pull-right" onclick="return confirm('Yakin?')">Simpan</button>
                </div>
            </div>
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>


@endif


