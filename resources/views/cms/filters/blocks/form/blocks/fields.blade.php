<div class="form">
    <div class="form-group row col-md-6">
        {{ Form::label('title', __('cms.filters.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
    </div>

    <div class="form-group row col-md-6">
        @php
            $statuses = [
               /* \App\Models\Filter::STATUS_DRAFT => __('cms.filters.statuses.' . \App\Models\Filter::STATUS_DRAFT),
                \App\Models\Filter::STATUS_PUBLISHED => __('cms.filters.statuses.' . \App\Models\Filter::STATUS_PUBLISHED),*/
            ];
        @endphp
        {{ Form::label('status', __('cms.filters.description')) }}
        {{ Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) }}
        {{--        {{ Form::select('status', $statuses, null, ['class' => 'form-control']) }}--}}
    </div>
    <div class="form-group row col-md-6">
        {{ Form::label('value', __('cms.filters.value')) }}
        {{ Form::text('value', null, ['class' => 'form-control', 'id' => 'value', 'dusk'=> "value"]) }}
    </div>
    <div class="form-group row col-md-6">
        {{ Form::label('filter_type_id', __('cms.filters.filter_type_id')) }}
        {{ Form::select('filter_type_id', $filterTypeList->pluck('id_name' ,'id' )->toArray() ,null ,['class' => 'form-control',
                                'id' => 'filter_type_id', 'placeholder' => 'Choose type...']) }}
    </div>
    <div class="form-group row col-md-6">
        {{ Form::label('created_at', __('cms.filters.created_at')) }}
        {{ Form::text('created_at', null, ['class' => 'form-control', 'disabled']) }}
    </div>
    <div class="form-group row col-md-6">
        {{ Form::label('updated_at', __('cms.filters.updated_at')) }}
        {{ Form::text('updated_at', null, ['class' => 'form-control', 'disabled']) }}
    </div>

</div>
