@section('header')
    <div class="position-absolute" style="right: 15px;top: 10px">
        <a href="">
            <small>{{__('cards.authors.rating')}} {{$author['rating']}}</small>
        </a>
    </div>
    <h5 class="card-title mt-3">{{$author['name']}}</h5>
@endsection
@section('footer')
    @include('blocks.badges.recipe', ['count' => $author['count']['recipes']])
    @include('blocks.badges.like', ['count' => $author['count']['like']])
    <a class="ml-auto" href="">Подписаться</a>
@endsection
@include('blocks.cards.users.authors.preview.layouts.index')
