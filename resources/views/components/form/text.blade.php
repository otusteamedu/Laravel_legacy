@component('components.form.field', compact('name', 'transKey'))
    {{ Form::text($name, null, array_merge(['class' => 'input', 'autocomplete' => 'off'], $attributes)) }}
@endcomponent

