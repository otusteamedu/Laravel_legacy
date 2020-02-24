<?php
/**
 * @var Lavary\Menu\Item  $item
 */
?>
@if(empty($item->attr('onlyBread')))
    <li>
    @if($item->url())
        <a href="{!! $item->url() !!}"@if($item->isActive) class="active"@endif>{{ $item->title }} </a>
    @else
        <span class="{{$item->attributes['class']}}">{{ $item->title }}</span>
    @endif
    @if($item->hasChildren() && empty($item->children()->first()->attr('onlyBread')))
        @include('cms.blocks.menu', ['items' => $item->children(), 'class' => ''])
    @endif
    </li>
@endif