@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Log Karyawan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($logKaryawan, ['route' => ['logKaryawans.update', $logKaryawan->id], 'method' => 'patch']) !!}

                        @include('log_karyawans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection