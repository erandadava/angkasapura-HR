<div class="row">
    <div class="col-md-3">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            <p>{!! $users->name !!}</p>
        </div>
    </div>
    <div class="col-md-3">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('username', 'Username:') !!}
            <p>{!! $users->username !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            <p>{!! $users->email !!}</p>
        </div>

    </div>
    <div class="col-md-3">
        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{!! $users->created_at !!}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{!! $users->updated_at !!}</p>
        </div>
    </div>
</div>