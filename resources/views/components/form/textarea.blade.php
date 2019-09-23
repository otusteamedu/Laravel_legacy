@component('components.form.field', compact('name', 'transKey'))
    {{ Form::textarea($name, null, array_merge(['class' => 'textarea'], $attributes)) }}
@endcomponent
