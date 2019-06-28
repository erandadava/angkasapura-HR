@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Vendor OS
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($vendorOs, ['route' => ['vendorOs.update', $vendorOs->id], 'method' => 'patch']) !!}

                        @include('vendor_os.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection