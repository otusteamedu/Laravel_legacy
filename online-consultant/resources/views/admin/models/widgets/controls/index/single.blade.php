@php /** @var \App\Models\Widget $widget */ @endphp
<div class="model-index-single-controls">
    @if ($widget->trashed())
        <div class="form-restore mb-2">
            {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.restore', 'PATCH', __('Restore'), ['class' => 'btn btn-info text-white btn-block']) }}
        </div>
        <div class="form-force-delete">
            {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.force_delete', 'DELETE', __('Force delete'), ['class' => 'btn btn-danger btn-block']) }}
        </div>
    @else
        <div class="form-delete">
            {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.destroy', 'DELETE', __('Delete'), ['class' => 'btn btn-dark btn-block']) }}
        </div>
    @endif
</div>
