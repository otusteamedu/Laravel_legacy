<div class="form-group">
    {{ Form::label('title', trans('messages.filmTitle')) }}
    {{ Form::text('title', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('meta_title', trans('messages.filmMetaTitle')) }}
    {{ Form::text('meta_title', null, array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('meta_description', trans('messages.filmMetaDescription')) }}
    {{ Form::text('meta_description', null, array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('keywords', trans('messages.filmKeyword')) }}
    {{ Form::text('keywords', null, array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('slug', trans('messages.filmSlug')) }}
    {{ Form::text('slug', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('year', trans('messages.filmYear')) }}
    {{ Form::text('year', null, array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('status', trans('messages.filmStatus')) }}
    {{ Form::select('status', [trans('messages.filmStatusPublished') => trans('messages.filmStatusPublished'), 
    trans('messages.filmStatusNotPublished') => trans('messages.filmStatusNotPublished')]) }}
</div>
<div class="form-group">
    {{ Form::label('content', trans('messages.filmContent')) }}
    {{ Form::textarea('content', null, array('class'=>'form-control')) }}
</div>
