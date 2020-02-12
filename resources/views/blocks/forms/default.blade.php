@include('blocks.forms.errors')
<?php
$form_params = [];
if (!empty($url)) {
    $form_params['url'] = $url;
}
?>
{!! Form::open($form_params) !!}
@foreach($fields as $params)
    <?php
    if (!empty($params['postfix'])) {
        $params['name'] .= '_' . $params['postfix'];
    }
    $params['value'] = $values[$params['name']] ?? '';
    if (isset($params['options_in'])) {
        $params['options'] = ${$params['options_in']};
    }
    ?>
    <div class="form-group">
        @include('blocks.forms.fields')
    </div>
@endforeach
{{ Form::submit($submit_text, ['class' => 'btn btn-primary'])  }}
{!! Form::close() !!}