<?php $publish = rand(0, 1)?>
@if($publish)
    <a href="" class="text-success mr-3">{{__('cards.recipes.publish')}}</a>
@else
    <a href="" class="text-info mr-3">{{__('cards.recipes.not-publish')}}</a>
@endif
<a href="" class="text-warning mr-3">{{__('cards.recipes.edit')}}</a>
@if($publish)
    <a href="" class="text-danger mr-3">{{__('cards.recipes.remove')}}</a>
@else
    <a href="" class="text-success mr-3">{{__('cards.recipes.restore')}}</a>
@endif
