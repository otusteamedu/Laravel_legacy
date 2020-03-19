{!! Form::open(['url' => route('links.update', [$link]), 'method' => 'patch']) !!}

@include('blocks.errors.default')

<div class="form-group row">
    <label for="type"
           class="col-md-4 col-form-label text-md-right">@lang('link.system.label.type')</label>
    <div class="col-md-6">
        {!! Form::text('type', $errors->any() ? old('type') : $link->type , ['class' => 'form-control',   'autofocus' => 'autofocus']); !!}
    </div>
</div>

<div class="form-group row">
    <label for="name"
           class="col-md-4 col-form-label text-md-right">@lang('link.system.label.name')</label>
    <div class="col-md-6">
        {!! Form::text('name', $errors->any() ? old('name') : $link->name , ['class' => 'form-control', 'required' => 'required']); !!}
    </div>
</div>

<div class="form-group row">
    <label for="route_name"
           class="col-md-4 col-form-label text-md-right">@lang('link.system.label.route_name')</label>
    <div class="col-md-6">
        {!! Form::text('route_name', $errors->any() ? old('route_name') : $link->route_name , ['class' => 'form-control', 'required' => 'required']); !!}
    </div>
</div>

<div class="form-group row">
    <label for="disabled"
           class="col-md-4 col-form-label text-md-right">@lang('link.system.label.disabled')</label>
    <div class="col-md-6">
        {!! Form::checkbox('disabled', 1, $errors->any() ? old('disabled') : $link->disabled , ['class' => 'form-control']); !!}
    </div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            @lang('link.system.edit_page.submit_button')
        </button>
        <a class="btn btn-secondary" href="{{route('links.index')}}" role="button">@lang('link.system.back_nav_button')</a>
    </div>
</div>
{!! Form::close() !!}
