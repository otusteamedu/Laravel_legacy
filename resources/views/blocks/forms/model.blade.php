@include('blocks.forms.errors')
{{ Form::model($values, ['url' => route('admin.'.$entity_name['m'].'.update', [$entity_name['s'] => $values]), 'method' => 'PUT']) }}
@foreach($fields as $params)
    <?php
    if (is_object($values[$params['name']])) {
        $params['value'] = $values[$params['name']]->id;
        $params['name'] .= '_id';
    } else {
        $params['value'] = $values[$params['name']] ?? '';
    }
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