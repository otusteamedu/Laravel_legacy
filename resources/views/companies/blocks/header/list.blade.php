@component('blocks.header.index')
    @slot('title', __('messages.companies'))
    @slot('description', __('messages.companiesHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="/companies/create" role="button">@lang('messages.addCompany')</a>
@endcomponent