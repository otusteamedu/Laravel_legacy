<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('name', trans('permissions.name')) }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>

    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('route', trans('permissions.route')) }}
            {{ Form::text('route', null, array('class'=>'form-control')) }}
        </div>
    </div>

</div>