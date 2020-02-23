<?php /** @var \App\Models\Page\Page $page */?>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('name', __('cms.fields.name')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('name', $page->name, ['class'=>'form-control', 'required' => 'required']) }}
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
            {{ Form::text('title', $page->title, ['class'=>'form-control']) }}
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
            {{ Form::text('keywords', $page->keywords, ['class'=>'form-control']) }}
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
            {{ Form::text('description', $page->description, ['class'=>'form-control']) }}
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
            {{ Form::textarea('content', $page->content, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-11 pb-3 align-content-end text-right">
        {{Form::submit(__('cms.actions.update'), ['class' => 'btn btn-success'])}}
    </div>
</div>