<!DOCTYPE html>
<html>
<style>
body{
    font-family:arial;
}
table{
    border : 1px solid black;
    border-collapse: collapse;
}
td{
    border : 1px solid black;
    padding : 4px;
}
th{
    text-align:center;
    border : 1px solid black;
    padding : 4px;
}
*{
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
}
table.paleBlueRows {
  border: 1px solid #FFFFFF;
  text-align: center;
  border-collapse: collapse;
}
table.paleBlueRows td, table.paleBlueRows th {
    border : 1px solid #424242;
  padding: 3px 2px;
}
table.paleBlueRows tbody td {
  font-size: 13px;
  border : 1px solid #424242;
}
table.paleBlueRows tr:nth-child(even) {
  background: #D0E4F5;
}
table.paleBlueRows thead {
  background: #0B6FA4;
  border-bottom: 5px solid #FFFFFF;
}
table.paleBlueRows thead th {
  font-size: 17px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 2px solid #FFFFFF;
}
table.paleBlueRows thead th:first-child {
  border-left: none;
}

table.paleBlueRows tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  background: #D0E4F5;
  border-top: 3px solid #444444;
}
table.paleBlueRows tfoot td {
  font-size: 14px;
}
.logo{
    right: 0;
    float: right;
}
.logo img{
    width : 200px;
}
</style>
<head>
	<title>PDF</title>
</head>
<body>
            
        <div class="container">
    <div class="row">
        <div class='col-sm-12'>
                <table style="padding:0px;margin:0px;border:none" cellpadding="5">
                    <tr style="border:none">
                        <td style="width:70%;border:none">

                        </td>
                        <td style="width:30%;border:none">
                                <img src="{{ public_path().'/img/bsh.jpeg'}}" style="width:180px;" alt="">
                        </td>
                    </tr>
                    <tr style="border:none">
                        <td style="border:none" colspan="2">
                                <h1 style="font-size:24px">{{$title}}</h1>
                        </td>
                    </tr>
                    <tr style="border:none">
                        <td style="border:none" colspan="2"><h4 style="font-weight: 500">{!! \Carbon\Carbon::parse(\Carbon\Carbon::now())->formatLocalized('%d %B %Y'); !!}</h4></td>
                    </tr>
                </table>
        </div>
        <div class="col-sm-12">
            <div class="table">
                <table class="paleBlueRows" style="width:100%;" cellspacing="0" cellpadding="5">
                    <tr>
                        @foreach($head as $key =>$dt)
                            @if ($key==0)
                            <th style="font-weight:bold;background-color:#D0E4F5;width:15%;">
                                {{$dt}}
                            </th>
                            @else
                            <th style="font-weight:bold;background-color:#D0E4F5;width:9.44%;">
                                {{$dt}}
                            </th>
                            @endif
                        @endforeach
                    </tr>
                    <tbody>
                            @php
                            $sebelumnya = "";   
                           @endphp
                        @foreach($value as $key => $dt)
                                    @if($sebelumnya != $group[$key][0])
                                        @php
                                            $sebelumnya = $group[$key][0];   
                                        @endphp
                                        <tr class="group">
                                            <td colspan="11">
                                                {{ $group[$key][1] }}
                                            </td>
                                        </tr>
                                    @endif
                            <tr>
                                @foreach($dt as $key2 => $dt2)
                                    <td>
                                        {!! $dt2 !!}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            @foreach($total as $key_total => $dt_total)
                                <td style="font-weight:bold;background-color:#D0E4F5">
                                    {!! $dt_total !!}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

