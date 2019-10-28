@userCanDelete
    @php /** @var \App\Models\Widget $widget */ @endphp
    <div class="model-single-controls">
        {{ Form::modelDeleteActionsForm($widget, 'admin.widgets.destroy', 'DELETE', __('admin.models.controls.delete'), ['class' => 'btn btn-dark']) }}
    </div>
@enduserCanDelete
