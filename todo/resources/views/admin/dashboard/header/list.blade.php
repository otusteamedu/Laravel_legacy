@component('tasks.header.index')
    @slot('title', __('messages.productsOf', ['name' => $company['name']]))
    @slot('description', __('messages.productsHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="/products/create" role="button">@lang('messages.addProduct')</a>
@endcomponent