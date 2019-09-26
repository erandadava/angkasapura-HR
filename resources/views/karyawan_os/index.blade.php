@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Karyawan Outsourcing</h1>
        <h1 class="pull-right">
            @hasrole('Admin')
            <div class="btn-group">
                <a class="btn btn-default" style="margin-top: -10px;margin-bottom: 5px" data-toggle="modal" data-target="#modalUpload" href="#">Import From CSV</a>
                <a class="btn btn-warning" style="margin-top: -10px;margin-bottom: 5px" onclick="submitcheck('/exportpdf/{{Crypt::encrypt('karyawan_os')}}')" target="_blank">Export To PDF</a>
                <input type="button" style="margin-top: -10px;margin-bottom: 5px" class="check btn btn-success" value="Check All" />
            </div>
            @endhasrole

            @hasrole('Super Admin|Vendor')
             <div class="btn-group">
                <a class="btn btn-default" style="margin-top: -10px;margin-bottom: 5px" data-toggle="modal" data-target="#modalUpload" href="#">Import From CSV</a>
                <a class="btn btn-warning" style="margin-top: -10px;margin-bottom: 5px" onclick="submitcheck('/exportpdf/{{Crypt::encrypt('karyawan_os')}}')" target="_blank">Export To PDF</a>
                <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('karyawanOs.create') !!}">Add New</a>
                <input type="button" style="margin-top: -10px;margin-bottom: 5px" class="check btn btn-success" value="Check All" />
            </div>
            @endhasrole
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('karyawan_os.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>

    <!-- Modal -->
    <div id="modalUpload" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload CSV</h4>
        </div>
        <div class="modal-body">
        <div class="alert alert-info">
            <strong>Info!</strong> Format Tanggal Harus *3/14/2012 (dd/mm/yyyy).
        </div>
            {!! Form::open(['url' => '/uploadcsvkaryawanos', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                <input  type="file"  name="file_csv" accept=".csv">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-default">Import</button>
            {!! Form::close() !!}
        </div>
        </div>

    </div>
    </div>
@endsection

