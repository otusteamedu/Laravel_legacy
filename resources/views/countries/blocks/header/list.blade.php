@component('blocks.header.index')
    @slot('title', __('messages.countries'))
    @slot('description', __('messages.companiesHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="{{ App\Helpers\RouteBuilder::localeRoute('cms.countries.create') }}" role="button">@lang('messages.addCountry')</a>
@endcomponent