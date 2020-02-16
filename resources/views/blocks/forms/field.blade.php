<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label($field['name'], trans($field['title'])) }}
            {{ Form::{$field['type']}($field['name'], null, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
