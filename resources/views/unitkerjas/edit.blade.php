@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Unitkerja
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($unitkerja, ['route' => ['unitkerjas.update', $unitkerja->id], 'method' => 'patch']) !!}

                        @include('unitkerjas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection