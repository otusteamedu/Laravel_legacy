<div class="d-flex">
    <span>{{__('cards.recipes.products')}}: </span> @include('blocks.cards.recipes.preview.components.products.index')
</div>
<div>
    @if($recipe['kitchen']['value'])
        <span>{{__('cards.recipes.kitchen')}}: <a href="">{{$recipe['kitchen']['value']}}</a>/</span>
         @else
        {{__('cards.recipes.category')}}:
    @endif
    <span> <a href="">Первое блюдо</a> / <a href="">Борщь</a></span>
</div>
<div>

</div>



