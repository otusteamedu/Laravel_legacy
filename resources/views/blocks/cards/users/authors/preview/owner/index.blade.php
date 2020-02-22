@php
    $faker = Faker\Factory::create('ru_RU');
    $author['name'] = $faker->name();
    $author['photo'] = '/images/1.jpg';
    $author['about'] = $faker->realText(200);
    $author['rating'] = rand(1, 1000);
    $author['count']['recipes'] = rand(1, 1000);
    $author['count']['like'] = rand(1, 1000);
    $author['count']['comments'] = rand(1, 1000);
@endphp
@section('header')
    <div class="position-absolute" style="right: 15px;top: 10px">
        <a href="{{__(route('cms.authors.edit', $author['slug']))}}"> {{__('cards.authors.edit')}}     </a>
    </div>
    <h5 class="card-title mt-3">{{$author['name']}}</h5>
@endsection
@section('footer') @endsection
@include('blocks.cards.users.authors.preview.layouts.index')

