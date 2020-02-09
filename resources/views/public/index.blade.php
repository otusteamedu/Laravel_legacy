<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Link - Bootstrap Agency Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  

    <!-- Libraries CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('js/app.js') }}"></script>



</head>

<body>

  @php
      $menuList =[
        [
          'id'=>1,
          'link'=>'/',
          'title'=>'Главная'
        ],
        [
          'id'=>2,
          'link'=>'/',
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
          'link'=>'/',
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
    @php
        $slider = [
          'images/index_slider/slaid1.jpg',
          'images/index_slider/slaid2.jpg',
          'images/index_slider/slaid3.jpg',
          'images/index_slider/slaid4.jpg'
        ];
    @endphp
    <div id="carouselExampleSlidesOnly" class="carousel slide mt-3 mb-3" data-ride="carousel">
      <div class="carousel-inner">
        @foreach ($slider as $slide)
          @if ($loop->first)
            <div class="carousel-item active">
              <img src="{{ $slide }}" class="d-block w-100" alt="">
            </div>
          @else
          <div class="carousel-item">
            <img src="{{ $slide }}" class="d-block w-100" alt="">
          </div>
          @endif
        @endforeach
      </div>
    </div>
    <div class="row rounded-lg bg-content">
      <div class="col content-screw">
        <h2 class="-marginbottom20 left-align">С нами работают потому что:</h2>
        <ul class="-marginbottom20">
            <li>Мы отвечаем на заявки в течение дня.</li>
            <li>Мы работаем официально, по договору, поэтому наши сроки всегда соблюдаются «железно».</li>
            <li>Поставляем детали как оригинальные детали от заводов-производителей, так и качественные аналоги.</li>
            <li>Мы считаем довольных клиентов, а не деньги, наша репутация – это наша сила!.</li>
            <li>У нас низкая цена, так как мы ориентированы на работу с постоянными клиентами.</li>
        </ul>
        <p class="-marginbottom20"><strong>У нас общая цель</strong> – поставить спецтехнику на колеса!</p>
        <h2 class="-marginbottom20 left-align">Схема работы с нами:</h2>
      <img class="img-fluid" src="{{asset('images/step.png')}}" alt="">
    <h2 class="-marginbottom20 left-align">Если вы цените:</h2>
        <p class="-marginbottom20">Качество, стабильность, соблюдение сроков и сервис – то нам по пути!</p>
        <p class="-marginbottom20">
            Корпорация РТД занимается поставкой шин и запчастей на складскую и строительную технику в Екатеринбурге.
            Мы работаем для того, чтобы поиск и покупка комплектующих на штаблеры, погрузчики, ричтраки и транспортировщики
            была простым и быстрым делом. На нашем сайте вы можете найти широкий ассортимент запасных частей для техники разных моделей.
            Мы сотрудничаем только с надежными производителями из стран Европы и Азии, так что вы можете быть уверены,
            что приобретенные в нашем магазине комплектующие прослужат вам долго.
        </p>
        <p>&nbsp;</p>
    <h2 class="-marginbottom20 left-align"><strong>Запчасти на вилочные погрузчики</strong></h2>
        <p class="-marginbottom20">
            В нашем каталоге вы можете найти запчасти на вилочные погрузчики любого типа
            (дизельные, бензиновые, электрические) по доступной цене.
            Также всегда есть в наличии запчасти для погрузчиков балканар и китайских фронтальных погрузчиков.
            Мы сотрудничаем с производителями оригинальных деталей. Покупая товары у нас,
            вы не будете тратить свое время на поиск и подгонку деталей, а сразу можете найти подходящую вам модель.
        </p>
        <p>&nbsp;</p>
    <h2 class="-marginbottom20 left-align"><strong>Запчасти на дорожно-строительную технику</strong></h2>
        <p class="-marginbottom20">
                Если вам нужны запчасти на фронтальные погрузчики, эскаваторы, грейдеры,
                катки и другую дорожно-строительную технику, их вы также можете купить
                в нашем интернет-магазине. Мы заказываем детали напрямую у оригинальных
                производителей, исключая цепочку посредников, поэтому у нас вы можете
                купить комплектующие с минимальной наценкой и короткими сроками поставки.
                А для желающих сэкономить, мы можем предложить аналоги оригинальных изделий,
                нисколько не уступающие им по качеству.
        </p>
        <p>&nbsp;</p>
    <h2 class="-marginbottom20 left-align"><strong>Запчасти на складскую технику</strong></h2>
        <p class="-marginbottom20">
                Прибыль любого магазина, за исключением разве что самых маленьких,
                напрямую зависит от организации склада. Чем быстрее ваши сотрудники могут
                найти и доставить нужный покупателю товар или заполнить опустевшие полки в магазине,
                тем лучшее впечатление вы произведете на клиентов. Сломанные тележки, штаблеры,
                ричтраки и трансполлеты замедляют работу склада, что приводит к снижению вашей выручки.
                Но в нашем интернет-магазине вы можете найти запчасти для складской техники в широком
                ассортименте и по доступной цене, чтобы поскорее обновить вашу складскую технику.
        </p>
        <p>&nbsp;</p>
    <h2 class="-marginbottom20 left-align"><strong>Шины в ассортименте</strong></h2>
        <p class="-marginbottom20">
                Скорость и безопасность движения любой спецтехники зависит от качества шин.
                Если встал вопрос их замены на новые, с его решением медлить нельзя.
                В нашем интернет-магазине вы можете купить шины на эксаваторы, виброкатки,
                фронтальные погрузчики, а также колеса для складской техники и цепи противоскольжения.
                Кроме того, для жителей Екатеринбурга доступна перепрессовка шин и другие услуги шиномонтажа.
        </p>
        <p>&nbsp;</p>
    <h2 class="-marginbottom20 left-align"><strong>Навесное оборудование</strong></h2>
        <p class="-marginbottom20">
                Если вы владеете многофункциональным погрузчиком,
                для получения высокой прибыли следует использовать его по-максимуму.
                Техника данного типа способна выполнять различные задачи,
                а чтобы расширить ее функционал, вы можете купить навесное оборудование для погрузчика.
                В нашем интернет-магазине представлено навесное оборудование для вилочного погрузчика,
                вы можете выбрать нужные вам устройства согласно модели вашей техники и стоящих перед вами задач.
        </p>
        <p>&nbsp;</p>
    <h2 class="-marginbottom20 left-align"><strong>Заказать комплектующие для техники</strong></h2>
        <p class="-marginbottom20">
                Мы предлагаем вам большой выбор запасных частей и шин на складскую технику.
                В нашем каталоге вы без труда сможете найти нужный вам товар и совершить
                заказ за считанные минуты, не выходя из офиса. Все сделки мы заключаем официально,
                с договором и сопутствующими документами, при этом строго соблюдаем обговоренные заранее сроки.
        </p>
        <p class="-marginbottom20">
                Если вам необходима консультация по ассортименту или помощь в выборе
                товара – звоните или пишите нам. Наши консультанты, которые превосходно
                разбираются в складской технике, обязательно вам помогут. Звонок по России бесплатный,
                на письменные заявки отвечаем в течение дня.
        </p>
        <p class="-marginbottom20">
                Возможна доставка товаров как в пределах Екатеринбурга, так и по всей территории России
                с помощью курьерских компаний – мы сотрудничаем с несколькими организациями,
                вы можете выбрать наиболее удобный для вас вариант. Где бы вы ни находились,
                вы можете совершить заказ в нашем интернет-магазине и получить товары на руки
                в короткие сроки. Кроме того, филиалы корпорации РТД работают в Челябинске, Уфе, Тюмени, Перми, Сургуте и Новом Уренгое.
        </p>
      </div>

    </div>
  </div>

  <div class="container rounded-lg bg-content mt-3 mb-3">
    <div class="row justify-content-center">
      <div class="col-10 p-4">
        <div id="my-carousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row justify-content-center">
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl1.png')}}" alt="">    
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl2.png')}}" alt="">
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl3.png')}}" alt="">
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl4.png')}}" alt="">    
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl5.png')}}" alt="">
                </div>
              </div>
              
              
            </div>
            <div class="carousel-item">
              <div class="row justify-content-center">
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl6.png')}}" alt="">    
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl7.png')}}" alt="">
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl8.png')}}" alt="">
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl9.png')}}" alt="">    
                </div>
                <div class="col-2">
                  <img class="d-block w-100" src="{{asset('images/footer_slide/sl10.png')}}" alt="">
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>
</html>
