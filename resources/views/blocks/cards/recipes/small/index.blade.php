@php($faker = Faker\Factory::create('ru_RU'))

@php($recipe['image'] = '/images/1.jpg')
@php($recipe['date'] = 'Last updated 3 mins ago')
@php($recipe['title'] = $faker->realText(rand(30, 50)))

@php($params['recipe'] = Illuminate\Support\Str::slug($recipe['title']))
<div class="card">
    <a href="{{route('cms.recipes.show', $params['recipe'])}}">
        <img src="{{$recipe['image']}}" class="card-img-top" alt="{{$recipe['title']}}">
    </a>
    <div class="card-body p-2">
        <h6 class="card-title m-0">
            <a href="{{route('cms.recipes.show', $params['recipe'])}}">{{$recipe['title']}}</a>
        </h6>
    </div>
</div>
