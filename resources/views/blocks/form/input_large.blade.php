<div class="uk-inline uk-width-1-1 uk-margin-small">
    <span class="uk-form-icon" data-uk-icon="icon: {{ $icon }}"></span>
    {{ Form::$type($name, $value = null, array_merge(['class' => array_merge(['uk-input', 'uk-form-large', 'uk-box-shadow-medium'], $class = [])], $attributes)) }}
</div>
