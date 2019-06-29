@extends('layouts.app')

@section('content')
<section class="content-header">
        <h1 class="pull-left">Dashboard</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row" style='margin-top:25px;'>
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-pencil"></i></span>

                            <div class="info-box-content">
                                {!! Form::open(['url' => '/home', 'method' => 'GET']) !!}
                                        <div class="form-group col-sm-4">
                                            <label for="exampleInputEmail1">Fungsi</label>
                                            {!! Form::select('value_fungsi',$data_fungsi, null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="exampleInputEmail1">Mulai Dari</label>
                                            <input type="text" name="dari" id='tgl-range' class="form-control" value='{{$dari??''}}' required>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="exampleInputEmail1">Sampai Dari</label>
                                            <div class="input-group">
                                                <input type="text" name="sampai" id='tgl-range2' class="form-control" value='{{$sampai??''}}' required>
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
                </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
				<div class="col-md-6 col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                            <h3 class="box-title">Jumlah Karyawan Berdasarkan Gender</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
								<canvas id="chartGender"></canvas>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                            <h3 class="box-title">Jumlah Karyawan Berdasarkan Pendidikan</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
								<canvas id="chartPendidikan"></canvas>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

                </div>

				<div class="row">
				<div class="col-md-6 col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                            <h3 class="box-title">Jumlah Karyawan Berdasarkan Umur</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
								<canvas id="chartUmur"></canvas>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
					<div class="col-md-6 col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                            <h3 class="box-title">Jumlah Karyawan Berdasarkan Fungsi</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
								<canvas id="chartFungsi"></canvas>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
				<div class="row">
				<div class="col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                            <h3 class="box-title">Jumlah Karyawan Berdasarkan Kelas Jabatan</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
								<canvas id="chartKelasJabatan"></canvas>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>

@endsection

@section('scripts')
<script>
		var status_pendidikan = {!!$status_pendidikan!!};
		var label_status_pendidikan = $.map(status_pendidikan, function(e) {
                return e.pendidikan;
        });
		var value_status_pendidikan = $.map(status_pendidikan, function(e) {
                return e.jumlah;
        });

		var fungsi = {!!$fungsi!!};
		var label_fungsi = $.map(fungsi, function(e) {
                return e.nama_fungsi;
        });
		var value_fungsi = $.map(fungsi, function(e) {
                return e.karyawan_count;
        });

		var kelas_jabatan = {!!$kelas_jabatan!!};
		var label_kelas_jabatan = $.map(kelas_jabatan, function(e) {
                return e.nama_kj;
        });
		var value_kelas_jabatan = $.map(kelas_jabatan, function(e) {
                return e.karyawan_count;
        });

		console.log(label_kelas_jabatan);

		var chrtpendidikan = new Chart(document.getElementById('chartPendidikan'), {
                type: 'doughnut',
                data: {
                labels: label_status_pendidikan,
                    datasets: [
                        {
                        label: "Jumlah",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: value_status_pendidikan
                        }
                    ]
                }
        });

		var chrtgender = new Chart(document.getElementById('chartGender'), {
                type: 'pie',
                data: {
                labels: ['Male','Female'],
                    datasets: [
                        {
                        label: "Jumlah",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [{!!$jk_laki!!},{!!$jk_perempuan!!}]
                        }
                    ]
                }
        });

		var chrtumur = new Chart(document.getElementById('chartUmur'), {
                type: 'horizontalBar',
                data: {
                labels: ['< 30', '31 - 40', '41 - 50', '51 - 54', '>=55'],
                    datasets: [
                        {
                        label : "Jumlah",   
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [{!!$umur_kurangdari30!!},{!!$umur_31sd40!!},{!!$umur_41sd50!!},{!!$umur_51sd54!!},{!!$umur_lebihdari55!!}]
                        }
                    ]
                },
        });

		var chrtfungsi = new Chart(document.getElementById('chartFungsi'), {
                type: 'bar',
                data: {
                labels: label_fungsi,
                    datasets: [
                        {
                        label : "Jumlah",   
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: value_fungsi
                        }
                    ]
                },
        });

		var chrtkelasjabatan = new Chart(document.getElementById('chartKelasJabatan'), {
                type: 'bar',
                data: {
                labels: label_kelas_jabatan,
                    datasets: [
                        {
                        label : "Jumlah",   
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: value_kelas_jabatan
                        }
                    ]
                },
        });
        $('#tgl-range').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });
        $('#tgl-range2').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });
        </script>
@endsection
