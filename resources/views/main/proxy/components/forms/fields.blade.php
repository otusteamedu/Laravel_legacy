<? /**@var \App\Models\Planner\PlannerProxy $proxy **/ ?>
{!! Form::hidden('id', $proxy->id ?? 0); !!}

<div class="form-group">
    <div class="row">
        <div class="col">
            {!! Form::label(__('proxy.form.type')); !!}:
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-check">
                {!! Form::radio('type', 'http', (isset($proxy) && $proxy->type == 'http'), ['class' => 'form-check-input', 'id' => 'type_http']); !!}
                {!! Form::label('type_http', __('proxy.form.type_http'), Array('class' => 'form-check-label')); !!}
            </div>
            <div class="form-check">
                {!! Form::radio('type', 'socks5', (isset($proxy) && $proxy->type == 'socks5'), ['class' => 'form-check-input', 'id' => 'type_socks5']); !!}
                {!! Form::label('type_socks5', __('proxy.form.type_socks5'), Array('class' => 'form-check-label')); !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('IP'); !!}:
    {!! Form::text('ip', $proxy->ip ?? '', ['class' => 'form-control']); !!}
</div>

<div class="form-group">
    {!! Form::label(__('proxy.form.port')); !!}:
    {!! Form::text('port', $proxy->port ?? '', ['class' => 'form-control']); !!}
</div>

<div class="form-group">
    {!! Form::label(__('proxy.form.login')); !!}:
    {!! Form::text('login', $proxy->login ?? '', ['class' => 'form-control']); !!}
</div>

<div class="form-group">
    {!! Form::label(__('proxy.form.password')); !!}:
    {!! Form::text('password', $proxy->password ?? '', ['class' => 'form-control']); !!}
</div>


<div class="form-group">
    {!! Form::submit(trans('Сохранить'), array('class' => 'btn btn-primary', 'name' => 'save')) !!}
    {!! Form::submit(trans('Отмена'), array('class' => 'btn btn-secondary', 'name' => 'cancel')) !!}
</div>
