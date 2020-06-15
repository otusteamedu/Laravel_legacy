<div class="form-group">
    {{ Form::label('title', trans('messages.pageTitle')) }}
    {{ Form::text('title', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('meta_keywords', trans('messages.pageMetaKeyword')) }}
    {{ Form::text('meta_keywords', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('meta_title', trans('messages.pageMetaTitle')) }}
    {{ Form::text('meta_title', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('slug', trans('messages.pageSlug')) }}
    {{ Form::text('slug', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('content', trans('messages.pageContent')) }}
    {{ Form::textarea('content', null, array('class'=>'form-control')) }}
</div>
