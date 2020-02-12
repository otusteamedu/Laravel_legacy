  @php
  $catalogParent = [
      [
        'id'=>1,
        'link'=>'/',
        'title'=>'Запчасти на вилочные погрузчики',
        'img'=>'images/catalog_list/vili.png',
      ],
      [
        'id'=>2,
        'link'=>'/',
        'title'=>'Запчасти на  дорожно-строительную технику',
        'img'=>'images/catalog_list/1.png',
      ],
      [
        'id'=>3,
        'link'=>'/',
        'title'=>'Запчасти на складскую технику',
        'img'=>'images/catalog_list/tehn.png',
      ],
      [
        'id'=>4,
        'link'=>'/',
        'title'=>'Шины',
        'img'=>'images/catalog_list/shin.png',
      ],
      [
        'id'=>5,
        'link'=>'/',
        'title'=>'Оборудование для атосервиса',
        'img'=>'images/catalog_list/servis_b.png',
      ],
      [
        'id'=>6,
        'link'=>'/',
        'title'=>'Навесное оборудование',
        'img'=>'images/catalog_list/vily_one.png',
      ],

  ];
@endphp


<div class="container">
<div class="row justify-content-end mt-3 mb-3"> 
  <div class="col-sm-12 col-md-6">
    <h1 class="h2 text-center">Продажа запчастей и шин на складскую и дорожно-строительную технику</h1>
  </div>
  <div class="col-sm-12 col-md-4 text-right">
    <div><span>8-804-333-68-99</span></div>
    <div><span>Звонок по России БЕСПЛАТНО</span></div>
    <div><span>7 (343) 383-58-13 (14)</span></div>
    <div><span>E-mail: 3835813@gmail.com</span></div>
  </div>
</div>

<div class="row justify-content-md-center shadow rounded-bottom bg-gradient-primary pt-2">
  @foreach ($catalogParent as $item)
    <a class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-2 text-dark catalog-link" href="{{ $item['link'] }}">
      <div class="text-center catalog-link-img">
        <img class="img-fluid" src="{{ $item['img'] }}">
      </div>
      <p class="text-center"><span>{{ $item['title'] }}</span></p>
    </a>
  @endforeach
</div>