@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Osdoc
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($osdoc, ['route' => ['osdocs.update', $osdoc->id], 'method' => 'patch']) !!}

                        @include('osdocs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection