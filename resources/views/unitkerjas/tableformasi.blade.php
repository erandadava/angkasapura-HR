@section('css')
    @include('layouts.datatables_css')
    <style>
    tr.group,
    tr.group:hover {
        background-color: #16a085 !important;
        color:white;
    }
    </style>
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered'],true) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection