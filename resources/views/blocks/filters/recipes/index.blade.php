    <div class="d-flex flex-column ">
    <div class="btn-group mt-2 flex-wrap" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-success">{{__('filters.recipes.categories')}}</button>
        <button type="button" class="btn btn-success">{{__('filters.recipes.products')}}</button>
        <button type="button" class="btn btn-success">{{__('filters.recipes.cuisine')}}</button>
        <button type="button" class="btn btn-success">{{__('filters.recipes.authors')}}</button>
        <button type="button" class="btn btn-success">{{__('filters.recipes.holidays')}}</button>
        <button type="button" class="btn btn-success">{{__('filters.recipes.fitnessFood')}}</button>
    </div>
    <form class="mt-2 form-row" action="">
        <div class="col input-group">
            <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
            </div>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary btn-block">{{__('filters.recipes.action')}}</button>
        </div>
        <div class="col-12">
            <div>{{__('filters.recipes.categories')}}: <span>Капустняк, Кулеш</span></div>
            <div>{{__('filters.recipes.products')}}: <span>Морковка, картошка</span></div>
        </div>
    </form>
</div>
