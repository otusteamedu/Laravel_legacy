<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{$recipe['image']}}" class="card-img" alt="{{$recipe['title']}}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="d-flex justify-content-sm-end mb-2">
                    <div class="d-flex justify-content-sm-end mb-2"> @yield('management') </div>
                </div>
                <h1>{{$recipe['title']}}</h1>
                <p class="card-text">{{$recipe['full-description']}}</p>
                <div class="mb-2 d-flex flex-column">
                    @include('blocks.cards.recipes.preview.components.params.index')
                </div>
                <p class="d-flex justify-content-between">
                    <small class="text-muted mr-2">{{$recipe['date']}}</small>
                    <span>
                        @include('blocks.cards.recipes.components.author')
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
