@extends('layouts.app')

@section('content')
<style>
canvas{
    background: #fff !important;
}
</style>
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
                                {!! Form::open(['url' => '/home', 'method' => 'GET', 'autocomplete' => 'off']) !!}
                                        <div class="form-group col-sm-4">
                                            <label for="exampleInputEmail1">Fungsi</label>
                                            {!! Form::select('value_fungsi',$data_fungsi, null, ['class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off']) !!}
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="exampleInputEmail1">Mulai Dari</label>
                                            <input type="text" name="dari" id='tgl-range' class="form-control" value='{{$dari??''}}' autocomplete='off'>
                                        </div>
                                        <div class="form-group col-sm-4">
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
                </div>
        <div class="box box-primary">
        
        <div id="reportPage" style="background-color:white">
            <div class="box-body" style="background-color:white">
                <div class="row">
                        <div class="col-sm-12" style="margin-top:5px;margin-bottom:10px">
                                <div class="pull-right">
                                    <button class="btn btn-default" id="downloadPdf">Download Chart To PDF</button>
                                </div>
                            </div>
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
                    <div class="col-md-6">
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
					<div class="col-md-12 col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                            <h3 class="box-title">Jumlah Karyawan Berdasarkan Unit Kerja</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
								<canvas id="chartUnitKerja"></canvas>
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
        var warnaUnitKerja = [];
        function getRandomColorHex() {
            
            for (var a = 1; a <= 40; a++) {
                var hex = "0123456789ABCDEF",
                color = "#";
                for (var i = 1; i <= 6; i++) {
                    color += hex[Math.floor(Math.random() * 16)];
                }
                warnaUnitKerja.push(color);
            }
            
        }
        getRandomColorHex();

		var status_pendidikan = {!!$status_pendidikan!!};
		var label_status_pendidikan = $.map(status_pendidikan, function(e) {
                return e.pendidikan;
        });
		var value_status_pendidikan = $.map(status_pendidikan, function(e) {
                return e.jumlah;
        });

		var unit_kerja = {!!$unit_kerja!!};
		var label_unit_kerja = $.map(unit_kerja, function(e) {
                return e.nama_uk;
        });
		var value_unit_kerja = $.map(unit_kerja, function(e) {
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

		var chrtunit_kerja = new Chart(document.getElementById('chartUnitKerja'), {
                type: 'bar',
                data: {
                labels: label_unit_kerja,
                    datasets: [
                        {
                        label : "Jumlah",   
                        backgroundColor: warnaUnitKerja,
                        data: value_unit_kerja
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

        Chart.plugins.register({
        beforeDraw: function(chartInstance) {
            var ctx = chartInstance.chart.ctx;
            ctx.fillStyle = "white";
            ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
        }
        });

        $('#tgl-range').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });
        $('#tgl-range2').datetimepicker({
            format: 'Y-MM-DD',
            useCurrent: false
        });

        $('#downloadPdf').click(function(event) {
            // get size of report page
            var reportPageHeight = $('#reportPage').innerHeight();
            var reportPageWidth = $('#reportPage').innerWidth();

            // create a new canvas object that we will populate with all other canvas objects
            var pdfCanvas = $('<canvas />').attr({
                id: "canvaspdf",
                width: reportPageWidth,
                height: reportPageHeight
            });

            // keep track canvas position
            var pdfctx = $(pdfCanvas)[0].getContext('2d');
            var pdfctxX = 0;
            var pdfctxY = 0;
            var buffer = 100;

            // for each chart.js chart
            $("canvas").each(function(index) {
                // get the chart height/width
                var canvasHeight = $(this).innerHeight();
                var canvasWidth = $(this).innerWidth();

                // draw the chart into the new canvas
                pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
                pdfctxX += canvasWidth + buffer;

                // our report page is in a grid pattern so replicate that in the new canvas
                if (index % 2 === 1) {
                pdfctxX = 0;
                pdfctxY += canvasHeight + buffer;
                }
            });

            // create new pdf and add our new canvas as an image
            if(reportPageWidth > reportPageHeight){
            // doc = new jsPDF('l', 'mm', [canvas.width, canvas.height]);
            var pdf = new jsPDF('l', 'mm', [reportPageWidth, reportPageHeight])
            }
            else{
            // doc = new jsPDF('p', 'mm', [canvas.height, canvas.width]);
            var pdf = new jsPDF('p', 'mm', [reportPageWidth, reportPageHeight])
            }
            // var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
            pdf.setFillColor(204, 204,204,0);
            pdf.rect(10, 10, 150, 160, "F");
            pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
            
            // download the pdf
            pdf.save('chartHR.pdf');
        });
        </script>
@endsection
