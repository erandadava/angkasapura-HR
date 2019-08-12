@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Formasi vs Eksisting</h1>
        <h1 class="pull-right">
            <div class="btn-group">
                <a class="btn btn-warning tombol-pdf" style="margin-top: -10px;margin-bottom: 5px" href="/exportpdf/{{Crypt::encrypt('formasi')}}?" target="_blank" >Export To PDF</a>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('unitkerjas.tableformasi')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

