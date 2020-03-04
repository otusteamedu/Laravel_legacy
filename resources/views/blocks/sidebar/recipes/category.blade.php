<?php
$categories = [
    [
        'title' => 'Рецепты первых блюд',
        'subCategory' => 'Борщи, Ботвинья, Бульоны, Гаспачо, Капустняк, Кулеш, Лагман, Мисо, Окрошка, Рассольник, Свекольник, Сладкие супы, Солянка, Супы, Уха, Харчо, Хаш, Шурпа, Щи'
    ],
    [
        'title' => 'Рецепты Вторых блюд',
        'subCategory' => 'Азу, Бефстроганов, Бешбармак, Биточки, Бифштекс, Блюда из яиц, Бризоль, Буженина, Гарниры, Голубцы, Грибные, Гуляш, Долма, Жаркое, Запеканки, Зразы, Из морепродуктов, Каши, Котлеты, Крокеты, Лазанья, Лангет, Лечо, Люля-кебаб, Мамалыга, Мусака, Мясные блюда, Мясо по-французски, Начинка, Овощные, Омлет, Отбивные, Паэлья, Плов, Полента, Пудинг, Рагу, Рататуй, Ризотто, Роллы, Ромштекс, Ростбиф, Рыбные блюда, Соте, Стейк, Тефтели, Тортилья, Фрикадельки, Фрикасе, Цыпленок табака, Чахохбили, Шашлык, Шницель, Яичница',
    ],
    [
        'title' => 'Кухни народов мира',
        'subCategory' => 'Абхазская, Австралийская, Австрийская, Адыгейская, Азербайджанская, Азиатская, Албанская, Алжирская, Американская, Английская, Арабская, Аргентинская, Арлезианская, Армянская, Африканская, Багамская, Башкирская, Белорусская, Бельгийская, Бирманская, Болгарская, Бразильская',
    ],
];

$categories = collect($categories);
$categories = $categories->map(function ($item) {
    if (!mb_strlen($item['title'])) {
        return null;
    }
    $item['slug'] = Illuminate\Support\Str::slug($item['title']);
    $subCategory = collect(explode(', ', $item['subCategory']));

    $item['subCategory'] = $subCategory->map(function ($item) {
        return ['title' => $item, 'slug' => Illuminate\Support\Str::slug($item),];
    });

    return $item;
});
?>
<aside class="row">
    <div class="col">
        <h5>{{__('titles.categories')}}</h5>
        @foreach($categories as $category)
            <div>
                <a href="{{$category['slug']}}" class="font-weight-bold"> {{$category['title']}} </a>
                <p>
                    @foreach($category['subCategory']  as $category)
                        @if ($loop->last)
                            @php($separator = '')
                        @else
                            @php($separator = ', ')
                        @endif
                        <a href="{{$category['slug']}}">{{$category['title'].$separator}}</a>
                    @endforeach
                </p>
            </div>
        @endforeach
    </div>
</aside>
