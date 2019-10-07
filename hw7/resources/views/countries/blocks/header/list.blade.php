@component('blocks.header.index')
    @slot('title', __('messages.countries'))
    @slot('description', __('messages.companiesHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="{{ route('cms.countries.create') }}" role="button">@lang('messages.addCountry')</a>
@endcomponent