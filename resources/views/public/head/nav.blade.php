

@php
$menuList =[
  [
    'id'=>1,
    'link'=>'/',
    'title'=>'Главная'
  ],
  [
    'id'=>2,
    'link'=>'/delivery',
    'title'=>'Доставка и оплата'
  ],
  [
    'id'=>3,
    'link'=>'/',
    'title'=>'Заказать'
  ],
  [
    'id'=>4,
    'link'=>'/',
    'title'=>'Спецпредложения'
  ],
  [
    'id'=>5,
    'link'=>'/contact',
    'title'=>'Контакты'
  ],

];
@endphp
<!-- Menu -->
<nav class="menu" id="theMenu">
<div class="menu-wrap brl-3">
<div class="position-relative full-higth">
<div class="row mb-4 mt-4">
  <a class="col-10 " href="/">
    <img class="img-fluid" src="{{asset('images/index/logo.png')}}" alt="РТД" class="logo-img">
  </a>
</div>
@foreach ($menuList as $menu)
  <a class="brb-2" href="{{ $menu['link'] }}"><u>{{ $menu['title'] }}</u></a>
@endforeach
@php
    $social = [
      [
        'link'=>'#',
        'img'=>'images/social/facebook.svg'
      ],
      [
        'link'=>'#',
        'img'=>'images/social/instagram.svg'
      ],
      [
        'link'=>'#',
        'img'=>'images/social/ok.svg'
      ],
      [
        'link'=>'#',
        'img'=>'images/social/vk.svg'
      ],
      [
        'link'=>'#',
        'img'=>'images/social/viber.svg'
      ],
      [
        'link'=>'#',
        'img'=>'images/social/whatsapp.svg'
      ],
    ];
@endphp
<div class="row justify-content-center mt-3 ">
  @foreach ($social as $item)
    <a href="{{ $item['link'] }}" class="col-1 ml-2 mr-2 p-0">
      <img class="img-fluid" src="{{ $item['img'] }}" alt="">
    </a>
  @endforeach
</div>
<div class="row ab-br-2 position-absolute mb-3">
  <div class="col-12 text-right mr-1">
    <div><span>8-804-333-68-99</span></div>
    <div><span>Звонок по России БЕСПЛАТНО</span></div>
    <div><span>7 (343) 383-58-13 (14)</span></div>
    <div><span>E-mail: 3835813@gmail.com</span></div>
  </div>
</div>
</div>
</div>

<!-- Menu button -->
<div id="menuToggle"><i class="fa fa-bars"></i></div>
</nav>

