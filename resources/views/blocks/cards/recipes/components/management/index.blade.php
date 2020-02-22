@if(rand(0,1))
    <a href="" class="text-success mr-3">{{__('cards.recipes.favorites.add')}}</a>
@else
    <a href="" class="text-success mr-3">{{__('cards.favorites.remove')}}</a>
@endif
