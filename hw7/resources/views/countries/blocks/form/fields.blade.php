<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('name', trans('messages.title')) }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('continent_name', trans('messages.continent_name')) }}
            {{ Form::text('continent_name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('url', trans('messages.price')) }}
            {{ Form::text('url', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>