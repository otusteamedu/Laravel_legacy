@php($params = [
    'title' => __('cards.authors.like'),
    'count' => $count,
])
@component('blocks.badges.index',$params) badge-light @endcomponent
