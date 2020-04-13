@component('blocks.header.index')
    @slot('title', $country->name)
    @slot('description', __('messages.companiesHeaderDescription'))
@endcomponent