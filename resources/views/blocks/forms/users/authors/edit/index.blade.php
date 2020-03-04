{{Form::open(['class'=>'form-row'])}}
<h2 class="col-12 mb-4">{{__('titles.authors.profile.edit')}}</h2>
<div class="col-5 mr-3">
    @include('blocks.forms.users.authors.edit.components.photo')
</div>
<div class="col">
    <div>
        {{ Form::label('name', __('forms.user.profile.name'))}}
        {{ Form::text('name', '', ['class'=>"form-control"])}}
    </div>
    <div class="mt-3">
        {{ Form::label('alias', __('forms.user.profile.alias'))}}
        {{ Form::text('alias', '', ['class'=>"form-control"])}}
    </div>
    <div class="mt-3">
        {{ Form::label('email', __('forms.user.profile.email'))}}
        {{ Form::email('email', '', ['class'=>"form-control"])}}
    </div>
    <div class="form-group row mt-3">
        @include('blocks.forms.users.authors.edit.components.sex')
    </div>
    <div>
        {{ Form::label('about',  __('forms.user.profile.about') )}}
        {{ Form::textarea('women', ' ', ['rows'=>5,'class'=>'form-control'])}}
    </div>
    <div class="mt-3 text-right">
        {{ Form::submit(__('forms.user.profile.action.save'), ['class'=>'btn btn-success'])}}
    </div>
</div>

{{Form::close()}}
