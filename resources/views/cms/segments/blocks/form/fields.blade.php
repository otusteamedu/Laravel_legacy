<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Название сегмента') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('condition', 'Условия') }}
            {{ Form::textarea('condition', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
