{{Form::open()}}
<h2>{{__('titles.recipes.add')}}</h2>
<div class="form-group row">
    <div class="col-12 col-md-5">
        @include('blocks.forms.recipes.components.title')
        <div class="mt-2">
            @include('blocks.forms.recipes.components.products')
        </div>
    </div>
    <div class="col">@include('blocks.forms.recipes.components.description')</div>
</div>
<div class="row">@include('blocks.forms.recipes.components.step.index')</div>
<div class="form-group row">
    <div class="col-12 col-md-5">@include('blocks.forms.recipes.components.kitchen')</div>
    <div class="col-12 col-md">@include('blocks.forms.recipes.components.category')</div>
</div>
<div class="form-group row">
    <div class="col-12 col-md-5">@include('blocks.forms.recipes.components.publish')</div>
    <div class="col mt-3 mt-md-0">@include('blocks.forms.recipes.components.submit')</div>
</div>
{{Form::close()}}
