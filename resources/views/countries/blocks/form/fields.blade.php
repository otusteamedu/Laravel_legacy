<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', trans('messages.title')) }}
            {{ Form::text('name', null, array('class'=>'form-control', 'id' => 'name')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('continent_name', trans('messages.continentName')) }}
            {{ Form::text('continent_name', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>