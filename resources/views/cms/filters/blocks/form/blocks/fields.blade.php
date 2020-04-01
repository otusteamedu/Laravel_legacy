<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('title', __('cms.filters.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('title', __('cms.filters.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        @php
            $statuses = [
               /* \App\Models\Filter::STATUS_DRAFT => __('cms.filters.statuses.' . \App\Models\Filter::STATUS_DRAFT),
                \App\Models\Filter::STATUS_PUBLISHED => __('cms.filters.statuses.' . \App\Models\Filter::STATUS_PUBLISHED),*/
            ];
        @endphp
        {{ Form::label('status', __('cms.filters.title')) }}
        {{ Form::select('status', $statuses, null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('excerpt', __('cms.filters.excerpt')) }}
        {{ Form::text('excerpt', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('body', __('cms.filters.body')) }}
        {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => 20,]) }}
    </div>
</div>
