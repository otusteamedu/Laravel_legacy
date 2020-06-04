<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('data.ru.name', trans('messages.categories.name')) }}
            {{ Form::text('data.ru.name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('status', trans('messages.categories.status')) }}
            {{ Form::text('status', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('url', trans('messages.categories.url')) }}
            {{ Form::text('url', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
