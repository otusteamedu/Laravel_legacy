@php($params = [
    'title' => __('cards.authors.subscribers'),
    'count' => $count,
])
@component('blocks.badges.index',$params) badge-light @endcomponent
