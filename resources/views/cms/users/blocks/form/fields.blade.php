<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Имя') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('phone', 'Телефон') }}
            {{ Form::text('phone', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('password', 'Пароль') }}
            {{ Form::text('password', null, array('class'=>'form-control')) }}
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('tariff', 'Тариф') }}
            {{ Form::select('tariff_id', $tariffs->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('segment', 'Сегмент') }}
            {{ Form::select('segment_id', $segments->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
</div>
