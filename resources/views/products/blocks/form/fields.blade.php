<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('title', trans('messages.title')) }}
            {{ Form::text('title', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('price', trans('messages.price')) }}
            {{ Form::text('price', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('totalCount', trans('messages.totalCount')) }}
            {{ Form::text('totalCount', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>