<div class="row mt-3">
    <div class="col-12 mb-3">
        @include('blocks.filters.recipes.index')
    </div>
    <h1 class="col-6">{{__('titles.recipes.new')}}</h1>
    <div class="col-6">
        @include('blocks.sorts.recipes.index')
    </div>
    @php($recipes = array_fill(1, 5, []))
    @foreach($recipes as $recipe)
        <div class="col-auto mt-3">
            @include('blocks.cards.recipes.preview.index')
        </div>
    @endforeach
</div>
