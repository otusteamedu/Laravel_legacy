<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Название категории') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('description', 'Описание') }}
            {{ Form::textarea('description', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
