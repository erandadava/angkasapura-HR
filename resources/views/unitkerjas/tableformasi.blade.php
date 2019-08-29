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
<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered'],true) !!}
</div>

{!! Form::open(['url' => 'exportpdflaporanharian', 'method' => 'get', 'class' => 'formcheck', 'target' => '_blank']) !!}
    {!! Form::hidden('exportid', null, ['id' => 'val-export-id']) !!}
{!! Form::close() !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
    var href = $(".tombol-pdf").attr('href');
    var href2 = null;
    var value = null;
    var jalan = false;
    $('#dataTableBuilder').on('search.dt', function() {
        value = $('.dataTables_filter input').val();
        
    }); 

    $('#dataTableBuilder').on( 'draw.dt', function () {
        if(href2 == null){
            href2 = $(".tombol-pdf").attr('href');
        }
        
        if(value != null && value != ""){
            $(".tombol-pdf").attr("href", href2+"s="+value+"&");
            var hasil = $(".tombol-pdf").attr('href');
            jalan = true;
        }
    });

    $("#dataTableBuilder thead tr:eq(0)").on("click", "th", function(event){
        $("#dataTableBuilder").on( 'processing.dt', function ( e, settings, processing ) {
            fGetSortInfo();
        });
        
    });


    function fGetSortInfo() {

    // Returns a value of [5, "desc", 0] every time.
        var sortInfo = $("#dataTableBuilder").dataTable().fnSettings().aaSorting;
        var direction =  $("#dataTableBuilder").dataTable().fnSettings().aaSorting[0][1];
        var columnIndex =  $("#dataTableBuilder").dataTable().fnSettings().aaSorting[0][0];
        var columnName =  $("#dataTableBuilder").dataTable().fnSettings().aoColumns[columnIndex].sTitle;
        var name_field = null;
        switch (sortInfo[0][0]) {
            case 1:
                name_field = "nama_uk"
                break;
            case 3:
                name_field = "jml_formasi"
                break;
            case 4:
                name_field = "karyawan_count"
                break;
        
            default:
                break;
        }
        $(".tombol-pdf").attr("href", href+"f="+name_field+"&key="+sortInfo[0][1]+"&");
        href2 = $(".tombol-pdf").attr('href');
        if(jalan != false){
            $(".tombol-pdf").attr("href", href2+"s="+$('.dataTables_filter input').val()+"&");
        }
    }
    $('#tgl-range').datetimepicker({
            format: 'Y-MM',
            useCurrent: false
        });
        $('#tgl-range2').datetimepicker({
            format: 'Y-MM',
            useCurrent: false
        });

            // var value_export = [];
            var old_value = [];
            var check_all = false;
            var first = false;
            var all = null;
            $(document).ready(function(){
                
                var old_check = false;
                $('.check:button').click(function(){
                    if(old_check == false){
                        $('input:checkbox').each(function() {
                            this.checked = true;
                        });
                        $(this).val('Uncheck All');
                        old_value = [];
                        all.forEach(element => {
                            old_value.push(element.id);
                        });
                        old_check = true;
                        check_all = true;
                    }else{
                        $('input:checkbox').each(function() {
                            this.checked = false;
                        });
                        $(this).val('Check All');
                        old_check = false;
                        check_all = false;
                        old_value = [];
                    }
                });
            });
    
    
            $('#dataTableBuilder').on('processing.dt', function (e, settings, processing) {
                if (processing) {
                    null;     // **I do not get this**
                } else {
                    if(first == false){
                        first = true;
                        all = LaravelDataTables['dataTableBuilder'].ajax.json().all_data;
                    }
                    $.each( old_value, function( key, value ) {
                        $('#checkexport'+value).attr('checked','checked');
                    }); // **I get this**
                }
            });
    
            function tocheck(id){
                if($('#checkexport'+id).prop("checked") == true){
                    old_value.push(id);
                }else{
                    old_value.splice($.inArray(id, old_value),1);
                }   
            }
    
            function submitcheck(val){
                // value_export = [];
                // $('input[name^="exportid"]').each(function() {
                //     if($(this).prop("checked") == true){
                //         value_export.push($(this).val());
                //     }    
                // });
                $('#val-export-id').val(old_value);  
                $('.formcheck').attr('action', val).submit();
            }

            $(".tombol-pdf").click(function(event) {
            event.preventDefault();
                var dataUrl = $(this).attr("href");
                if (dataUrl != "") {
                    $('#val-export-id').val(old_value);  
                    window.open(dataUrl+'export_id='+$('#val-export-id').val(), '_blank');
                    // $('.formcheck').attr('action', val).submit();
                }

            });
    </script>
    @if (isset($dari) && isset($sampai))
        <script>
            var dari = {!! json_encode($dari) !!};
            var sampai = {!! json_encode($sampai) !!};
            $('#dataTableBuilder').on( 'draw.dt', function () {
                $('.btn-shownya').each(function(i, obj) {
                    var hasil = $('.btn-shownya:eq('+i+')').attr('href');
                    $('.btn-shownya:eq('+i+')').attr("href",hasil+"?dari="+dari+"&sampai="+sampai).val();
                });
            });
        </script>
    @endif
@endsection