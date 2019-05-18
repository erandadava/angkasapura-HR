@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipekar
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipekar, ['route' => ['tipekars.update', $tipekar->id], 'method' => 'patch']) !!}

                        @include('tipekars.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection