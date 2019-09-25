@component('components.form.field', compact('name', 'transKey'))
    <div class="select">
    {{ Form::select($name, $list, null, ['placeholder' => ''], ) }}
    </div>
@endcomponent

