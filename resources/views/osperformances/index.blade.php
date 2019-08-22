@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">OS Performance</h1>
        <h1 class="pull-right">
            @hasrole('Vendor')
            <div class="btn-group">
                <a class="btn btn-warning" style="margin-top: -10px;margin-bottom: 5px" href="/exportpdf/{{Crypt::encrypt('osperformance')}}" target="_blank" >Export To PDF</a>
                {{-- <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('osperformances.create') !!}">Add New</a> --}}
            </div>
            @endhasrole
            @hasrole('Super Admin|Admin')
            <div class="btn-group">
                <a class="btn btn-warning" style="margin-top: -10px;margin-bottom: 5px" href="/exportpdf/{{Crypt::encrypt('osperformance')}}" target="_blank" >Export To PDF</a>
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('osperformances.create') !!}">Add New</a>
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
                    @include('osperformances.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

