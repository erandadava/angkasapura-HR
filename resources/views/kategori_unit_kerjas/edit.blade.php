@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Kategori Unit Kerja
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($kategoriUnitKerja, ['route' => ['kategoriUnitKerjas.update', $kategoriUnitKerja->id], 'method' => 'patch']) !!}

                        @include('kategori_unit_kerjas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection