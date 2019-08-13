@extends('layouts.app')

@section('content')
<style>
canvas{
    background: #ffffff !important;
}

.box-body {
    background-color: :#ffffff;
    background : #ffffff;
}
html{
    background-color: :#ffffff;
    background : #ffffff;
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
                                            <label for="exampleInputEmail1">Unit</label>
                                            {!! Form::select('value_unit',$data_unit_kerja, null, ['class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off']) !!}
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
        
        <div id="reportPage" style="background-color:#fff !important;">
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
            
            for (var a = 1; a <= 250; a++) {
                var hex = "0123456789ABCDEF",
                color = "#";
                for (var i = 1; i <= 6; i++) {
                    color += hex[Math.floor(Math.random() * 16)];
                }
                warnaUnitKerja.push(color);
            }
            
        }
        getRandomColorHex();


		var unit_kerja = {!!$unit_kerja!!};
		var label_unit_kerja = $.map(unit_kerja, function(e) {
                return e.nama_uk;
        });
		var value_unit_kerja = $.map(unit_kerja, function(e) {
                return e.karyawan_os_count;
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
                },
                options: {
                    plugins: {
                        datalabels: {
                            color : '#fff'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Karyawan Berdasarkan Gender'
                    }
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
                options: {
                    plugins: {
                        datalabels: {
                            color : '#fff'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Karyawan Berdasarkan Umur'
                    }
                }
        });

		var chrtunit_kerja = new Chart(document.getElementById('chartUnitKerja'), {
                type: 'horizontalBar',
                data: {
                labels: label_unit_kerja,
                    datasets: [
                        {
                        label : "Jumlah",   
                        backgroundColor: warnaUnitKerja,
                        data: value_unit_kerja
                        }
                    ],
                },
                options: {
                    plugins: {
                        datalabels: {
                            color : '#000'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Karyawan Berdasarkan Unit Kerja'
                    }
                }
        });



        Chart.plugins.register({
        beforeDraw: function(chartInstance) {
            var ctx = chartInstance.chart.ctx;
            ctx.clearRect( 0 , 0 , chartInstance.width, chartInstance.height );
            ctx.fillStyle="#FFFFFF";
            ctx.fillRect(0 , 0 , chartInstance.width, chartInstance.height);
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

        // $("#downloadPdf").click(function(){
        // html2canvas(document.querySelector("#reportPage")).then(canvas => {  
        //     var dataURL = canvas.toDataURL();
        //     var pdf = new jsPDF();
        //     pdf.addImage(dataURL, 'JPEG', 20, 20, 170, 120); //addImage(image, format, x-coordinate, y-coordinate, width, height)
        //     pdf.save("CanvasJS Charts.pdf");
        // });
        // });
        $('#downloadPdf').click(function(event) {
            // get size of report page
            var reportPageHeight = $('#reportPage').innerHeight();
            var reportPageWidth = $('#reportPage').innerWidth();

            // create a new canvas object that we will populate with all other canvas objects
            var pdfCanvas = $('<canvas />').attr({
                id: "canvaspdf",
                width: reportPageWidth,
                height: reportPageHeight,        
            }).css("background", "#ffffff");

            // keep track canvas position
            var pdfctx = $(pdfCanvas)[0].getContext('2d');
            //fin     
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

            // // var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
            pdf.addImage($(pdfCanvas)[0].toDataURL(), 'JPEG', 20, 20);
            
            // // download the pdf
            pdf.save('chartHR.pdf');
        });
        </script>
@endsection
