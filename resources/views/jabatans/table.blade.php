@section('css')
    @include('layouts.datatables_css')
@endsection
<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
</div>
@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $('#dataTableBuilder thead').prepend("<tr><th colspan='1'></th><th colspan='3' style='text-align:center;background-color:#f5f5f5'>Persyaratan Jabatan</th><th></th></tr>");
    </script>
@endsection