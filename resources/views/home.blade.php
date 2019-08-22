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
        <h1 class="pull-left">Dashboard Karyawan BSH</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row" style='margin-top:25px;'>
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="info-box">
                            {{-- <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-pencil"></i></span> --}}

                            <div class="info-box-content">
                                {!! Form::open(['url' => '/home', 'method' => 'GET', 'autocomplete' => 'off']) !!}
                                        <div class="form-group col-sm-4">
                                            <label for="exampleInputEmail1">Unit</label>
                                            {!! Form::select('value_unit',$data_unit_kerja, null, ['class' => 'form-control', 'placeholder' => '', 'autocomplete' => 'off','id'=>'unit_kerja']) !!}
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

        var kelas_jabatan_alphabet = {!!$kelas_jabatan_alphabet!!};
		var label_kelas_jabatan_alphabet = $.map(kelas_jabatan_alphabet, function(e) {
                return e.nama_kj;
        });
		var value_kelas_jabatan_alphabet = $.map(kelas_jabatan_alphabet, function(e) {
                return e.karyawan_count;
        });

        var value_kelas_jabatan_combine = value_kelas_jabatan.concat(value_kelas_jabatan_alphabet);
        var label_kelas_jabatan_combine = label_kelas_jabatan.concat(label_kelas_jabatan_alphabet);

		var chrtpendidikan = new Chart(document.getElementById('chartPendidikan'), {
                type: 'pie',
                data: {
                labels: label_status_pendidikan,
                    datasets: [
                        {
                        label: "Jumlah",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3B1F2B","#0E7C7B","#E01A4F","#F15946","#7B3E19","#175676"],
                        data: value_status_pendidikan
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
                        text: 'Jumlah Karyawan Berdasarkan Pendidikan'
                    }
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

		var chrtkelasjabatan = new Chart(document.getElementById('chartKelasJabatan'), {
                type: 'bar',
                data: {
                labels: label_kelas_jabatan_combine,
                    datasets: [
                        {
                        label : "Jumlah",   
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#3F3047","#3B1F2B","#0E7C7B","#E01A4F","#F15946","#7B3E19","#175676","#B6C649","#F7D002","#BF1A2F","#586BA4","#F5DD90","#F68E5F","#F76C5E","#EF476F","#118AB2"],
                        data: value_kelas_jabatan_combine
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
                        text: 'Jumlah Karyawan Berdasarkan Kelas Jabatan'
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
        var tanggal_dari = $('#tgl-range').val();
        var sampai = $('#tgl-range2').val();
        var unit_terpilih = $('#unit_kerja').select2('data');
        if(unit_terpilih[0].text == undefined || unit_terpilih[0].text == "" || unit_terpilih[0].text == null) {
            unit_terpilih = "Semua";
        }else{
            unit_terpilih = unit_terpilih[0].text;
        }
        
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
            var imgData = "data:image/jpeg;base64,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";
            pdf.addImage(imgData, 'JPEG',300, 10, 80, 30);
            pdf.addImage($(pdfCanvas)[0].toDataURL(), 'JPEG', 20, 70);
            pdf.text(20, 30, 'Grafik Dashboard HR - Karyawan BSH');
            pdf.text(20, 40, 'Unit : '+unit_terpilih);
            if((tanggal_dari != undefined && tanggal_dari != "" && tanggal_dari != null)&&(sampai != undefined && sampai != "" && sampai != null)) {
                pdf.text(20, 50, 'Berdasarkan Tanggal : '+tanggal_dari+' s/d '+sampai);
            }else{
                pdf.text(20, 50, 'Berdasarkan Tanggal : -');
            }
            
            
            // // download the pdf
            pdf.save('chartHR.pdf');
        });
        </script>
@endsection
