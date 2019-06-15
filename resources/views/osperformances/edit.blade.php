@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
        OS Performance
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($osperformance, ['route' => ['osperformances.update', $osperformance->id], 'method' => 'patch', 'enctype'=>'multipart/form-data']) !!}

                        @include('osperformances.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection