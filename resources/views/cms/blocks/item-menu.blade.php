<?php
/**
 * @var Lavary\Menu\Item  $item
 */
?>
<li>
@if($item->url())
    <a href="{!! $item->url() !!}"@if($item->isActive) class="active"@endif>{{ $item->title }} </a>
@else
    <span class="{{$item->attributes['class']}}">{{ $item->title }}</span>
@endif
@if($item->hasChildren() && empty($item->children()->first()->attributes['onlyBread']))
    @include('cms.blocks.menu', ['items' => $item->children(), 'class' => ''])
@endif
</li>