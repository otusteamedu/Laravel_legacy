{{Form::open(['method'=>'POST'])}}
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('name', __('messages.name')) }}
            {{ Form::text('name', null, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
{{Form::close()}}