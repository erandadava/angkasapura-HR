{!! Form::open(['route' => ['karyawans.destroy', $ID], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('karyawans.show', $ID) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
</div>
{!! Form::close() !!}
