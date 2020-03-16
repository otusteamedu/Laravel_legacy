@component('blocks.header.index')
    @slot('title', $country->name)
    @slot('description', __('messages.companiesHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="{{ route('cms.countries.edit', ['country' => $country, 'locale' => $locale]) }}" role="button">@lang('messages.edit')</a>
@endcomponent
