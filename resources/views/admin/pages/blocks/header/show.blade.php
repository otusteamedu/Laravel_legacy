@component('blocks.header.index')
    @slot('title', $page->name)
    @slot('description', __('messages.companiesHeaderDescription'))
    <a class="btn btn-primary btn-lg" href="{{ route('cms.pages.edit', ['page' => $page]) }}" role="button">@lang('messages.edit')</a>
@endcomponent