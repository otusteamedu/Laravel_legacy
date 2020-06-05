<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ trans('messages.langs.ru') }}
        </div>
        <div class="form-group">
            {{ Form::label('data[ru][name]', trans('messages.products.name')) }}
            {{ Form::text('data[ru][name]', null, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('data[ru][description]', trans('messages.products.descr')) }}
            {{ Form::text('data[ru][description]', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ trans('messages.langs.en') }}
        </div>
        <div class="form-group">
            {{ Form::label('data[en][name]', trans('messages.products.name')) }}
            {{ Form::text('data[en][name]', null, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('data[en][description]', trans('messages.products.descr')) }}
            {{ Form::text('data[en][description]', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">&nbsp;</div>
        <div class="form-group">
            {{ Form::label('status', trans('messages.products.status')) }}
            {{ Form::text('status', null, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('url', trans('messages.products.url')) }}
            {{ Form::text('url', null, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('price', trans('messages.products.price')) }}
            {{ Form::text('price', null, array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('quantity', trans('messages.products.quantity')) }}
            {{ Form::text('quantity', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
