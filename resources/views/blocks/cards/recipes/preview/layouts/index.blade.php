<div class="card">
    <div class="row no-gutters">
        <div class="col-md-4">
            <a href="{{route('cms.recipes.show', $recipe['slug'])}}">
                <img src="{{$recipe['image']}}" class="card-img" alt="{{$recipe['title']}}">
            </a>
        </div>
        <div class="col-md-8">
            <div class="card-body d-flex flex-column h-100">
                <div class="d-flex justify-content-sm-end mb-2"> @yield('management') </div>
                <h5 class="card-title">
                    <a href="{{route('cms.recipes.show', $recipe['slug'])}}">{{$recipe['title']}}</a>
                </h5>
                <p class="card-text">{{$recipe['short-description']}}</p>
                <div class="mb-2 d-flex flex-column">
                        @include('blocks.cards.recipes.preview.components.params.index')
                </div>
                <div class="card-text d-flex justify-content-between mt-auto">
                    <small class="text-muted mr-2">{{$recipe['date']}}</small>
                    <a href="{{route('cms.recipes.show', $recipe['slug'])}}">{{__('buttons.more')}}</a>
                </div>
                <div class="d-flex mt-3">
                    @yield('tags')
                </div>
            </div>
        </div>
    </div>
</div>
