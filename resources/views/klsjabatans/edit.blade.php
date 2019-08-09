@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Kelas Jabatan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($klsjabatan, ['route' => ['klsjabatans.update', $klsjabatan->id], 'method' => 'patch']) !!}

                        @include('klsjabatans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection