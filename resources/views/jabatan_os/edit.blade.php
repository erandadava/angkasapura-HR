@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
                Jabatan Outsourcing
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($jabatanOs, ['route' => ['jabatanOs.update', $jabatanOs->id], 'method' => 'patch']) !!}

                        @include('jabatan_os.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection