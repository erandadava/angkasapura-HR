@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">MPP</h1>
        <h1 class="pull-right">
            <div class="btn-group">
                <a class="btn btn-warning" style="margin-top: -10px;margin-bottom: 5px" onclick="submitcheck('/exportpdf/{{Crypt::encrypt('mpp')}}')" target="_blank">Export To PDF</a>
                <input type="button" style="margin-top: -10px;margin-bottom: 5px" class="check btn btn-default" value="Check All" />
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('mpp.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

