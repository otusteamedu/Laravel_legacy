@component('blocks.header.index')
    @slot('title', $country->name)
    @slot('description', __('messages.companiesHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="{{ App\Helpers\RouteBuilder::localeRoute('cms.countries.edit', ['country' => $country]) }}" role="button">@lang('messages.edit')</a>
@endcomponent