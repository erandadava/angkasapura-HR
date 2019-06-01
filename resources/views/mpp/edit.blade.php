@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Karyawan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($karyawan, ['route' => ['karyawans.update', $karyawan->id], 'method' => 'patch']) !!}

                        @include('karyawans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection