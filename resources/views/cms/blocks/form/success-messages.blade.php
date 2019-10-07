@if (session('successSave'))
    <ul class="alert alert-success js-alert-success">
        {{ trans('messages.changesHaveBeenSaved') }}
    </ul>
@endif