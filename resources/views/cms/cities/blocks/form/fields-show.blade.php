<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('name', 'Название города') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('url', 'Страна') }}
            {{ Form::select('countries', $countries->all() )}}
        </div>
    </div>
</div>
