@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Statuskar
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($statuskar, ['route' => ['statuskars.update', $statuskar->id], 'method' => 'patch']) !!}

                        @include('statuskars.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection