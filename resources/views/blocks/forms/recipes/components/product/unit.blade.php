
    @php($params = ['class'=>'form-control'])
    @php($options = [
        0 => __('forms.recipes.things'),
        1 => __('forms.recipes.grams'),
        2 => __('forms.recipes.kilogram'),
    ])

    {{Form::select('count-servings', $options, null, $params)}}
