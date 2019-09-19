@component('blocks.header.index')
    @slot('title', sprintf('%s #%d', __('messages.editCountry'), $country->id))
    @slot('description', __('messages.companiesHeaderDescription'))
@endcomponent