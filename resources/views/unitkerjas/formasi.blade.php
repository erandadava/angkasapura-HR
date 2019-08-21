@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Formasi vs Eksisting</h1>
        <h1 class="pull-right">
            @if (isset($dari) && isset($sampai))
                <div class="btn-group">
                <a class="btn btn-warning tombol-pdf" style="margin-top: -10px;margin-bottom: 5px" href="/exportpdf/{{Crypt::encrypt('formasi')}}?dari={{$dari}}&sampai={{$sampai}}&" target="_blank" >Export To PDF</a>
                <input type="button" style="margin-top: -10px;margin-bottom: 5px" class="check btn btn-default" value="Check All" />
                </div> 
            @else
                <div class="btn-group">
                    <a class="btn btn-warning tombol-pdf" style="margin-top: -10px;margin-bottom: 5px" href="/exportpdf/{{Crypt::encrypt('formasi')}}?" target="_blank" >Export To PDF</a>
                    <input type="button" style="margin-top: -10px;margin-bottom: 5px" class="check btn btn-default" value="Check All" />
                </div>
            @endif
        </h1>
    </section>
    <div class="col-xs-10 col-xs-offset-1">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-pencil"></i></span>

            <div class="info-box-content">
                {!! Form::open(['url' => '/formasiexisting', 'method' => 'GET', 'autocomplete' => 'off']) !!}
                        <div class="form-group col-sm-6">
                            <label for="exampleInputEmail1">Mulai Dari</label>
                            <input type="text" name="dari" id='tgl-range' class="form-control" value='{{$dari??''}}' autocomplete='off'>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleInputEmail1">Sampai Dari</label>
                            <div class="input-group">
                                <input type="text" name="sampai" id='tgl-range2' class="form-control" value='{{$sampai??''}}' autocomplete='off'>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat">Cari</button>
                                    </span>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>
            
            <!-- /.info-box-content -->
        </div>
    <!-- /.info-box -->
    </div>
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

