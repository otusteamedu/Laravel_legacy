@component('components.form.field', compact('name', 'transKey'))
    <div class="select">
    {{ Form::select($name, $list, null, $attributes + ['placeholder' => '']) }}
    </div>
@endcomponent

