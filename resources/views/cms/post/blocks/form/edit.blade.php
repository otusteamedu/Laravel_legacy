<?php /** @var \App\Models\Post\Post $post */?>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('name', __('cms.fields.name')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('name', $post->name, ['class'=>'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('title', __('cms.fields.title')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('title', $post->title, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('keywords', __('cms.fields.keywords')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('keywords', $post->keywords, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('description', __('cms.fields.description')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('description', $post->description, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('rights', __('cms.post.fields.rubrics')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::select('rubrics[]', $rubrics, $post->rubrics, ['class'=>'selectpicker form-control', 'multiple'])}}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('image', __('cms.fields.image')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            @if ($post->image)
                <img src="{{$image['path']}}/{{$image['image']}}">
                <br>
                {{Form::checkbox('image_destroy', 1, null, ['id' => 'image_destroy'])}}
                {{Form::label('image_destroy', __('cms.actions.destroy'))}}
                <br>
            @endif
            {{ Form::file('image', ['accept' => 'image/jpeg,image/png']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('content', __('cms.fields.content')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::textarea('content', $post->content, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-11 pb-3 align-content-end text-right">
        {{Form::submit(__('cms.actions.update'), ['class' => 'btn btn-success'])}}
    </div>
</div>