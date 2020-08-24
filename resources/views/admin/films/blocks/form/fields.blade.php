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
    @if (isset($moderator) && $moderator == true)
        {{ Form::select('status', [
        0 => trans('messages.filmStatusNotPublished')]) }}
    @else
        {{ Form::select('status', [ 1 =>trans('messages.filmStatusPublished'),
        0 => trans('messages.filmStatusNotPublished')]) }}
    @endif

</div>
<div class="form-group">
    {{ Form::label('content', trans('messages.filmContent')) }}
    {{ Form::textarea('content', null, array('class'=>'form-control')) }}
</div>
