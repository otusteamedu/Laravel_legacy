@foreach ($formData as $field => $value)
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                {{ Form::label($field, __($langModule . '.' . $field)) }}
                {{ Form::text($field, $value, array('class' => 'form-control')) }}
            </div>
        </div>
    </div>
@endforeach
