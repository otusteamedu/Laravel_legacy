<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-1 d-flex justify-content-center align-items-center" style="font-size: 35px">
            {{$loop->iteration}}
        </div>
        <div class="col-md-2">
            <a href="">
                @include('blocks.cards.users.components.avatars.index')
            </a>
        </div>
        <div class="col-md-9">
            <div class="card-body d-flex flex-wrap">
                <h5 class="card-title w-100">
                    <a href="{{route('cms.authors.show',$author['slug'])}}"> {{$author['name']}} </a>
                </h5>
                @include('blocks.badges.recipe', ['count' => $author['count']['recipes']])
                @include('blocks.badges.comments', ['count' => $author['count']['like']])
                @include('blocks.badges.subscribers', ['count' => $author['count']['subscribers']])
            </div>
        </div>
    </div>
</div>
