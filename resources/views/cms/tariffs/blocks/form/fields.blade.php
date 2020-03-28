<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Название тарифа') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('condition', 'Условия применения') }}
            {{ Form::textarea('condition', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
