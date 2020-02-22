<div class="d-flex flex-column ">
    <form class="mt-2 form-row" action="">
        <ul class="list-group">
            <?php $items =
                [
                    'filters.recipes.categories',
                    'filters.recipes.products',
                    'filters.recipes.cuisine',
                    'filters.recipes.authors',
                    'filters.recipes.holidays',
                    'filters.recipes.fitnessFood',
                ]; ?>
            @foreach($items as $item)
                <li class="list-group-item bg-light">{{__($item)}}</li>
                <li class="list-group-item input-group d-flex flex-wrap">
                    <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                    </div>
                    <div class="w-100 mt-2">Капустняк, Кулеш</div>
                </li>
            @endforeach
            <li class="list-group-item">
                <button type="submit" class="btn btn-primary btn-block">{{__('filters.recipes.action')}}</button>
            </li>
        </ul>
     </form>
</div>
