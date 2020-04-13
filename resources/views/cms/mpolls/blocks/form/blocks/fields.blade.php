<div class="form">
    <div class="form-group row col-md-6">
        {{ Form::label('id', __('cms.mpolls.id')) }}
        {{ Form::text('id', null, ['class' => 'form-control form-control-plaintext ', 'disabled']) }}
    </div>


    <div class="row ">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('cms.mpolls.name')) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group col-md-6 ml-auto">
            {{ Form::label('status', __('cms.mpolls.description')) }}
            {{ Form::text('description', null, ['class' => 'form-control']) }}
        </div>

    </div>

    <div class="form-group row col-md-6">
        {{ Form::label('country_id', __('cms.mpolls.value')) }}
        {{ Form::text('country_id', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group row col-md-6">
        {{ Form::label('created_at', __('cms.mpolls.created_at')) }}
        {{ Form::text('created_at', null, ['class' => 'form-control', 'disabled']) }}
    </div>
    <div class="form-group row col-md-6">
        {{ Form::label('updated_at', __('cms.mpolls.updated_at')) }}
        {{ Form::text('updated_at', null, ['class' => 'form-control', 'disabled']) }}
    </div>
{{--{{ dd($mpoll->quota) }}--}}
</div>

