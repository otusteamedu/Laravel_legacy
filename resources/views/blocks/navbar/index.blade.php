<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="<?=route('home')?>"><?= __('messages.main_page')?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            @foreach($links as $l)
                <li class="nav-item">
                    <a class="nav-link" href="{{$l['link']}}">{{$l['name']}}</a>
                </li>
            @endforeach
            @if($countries)
                <li class="nav-item dropdown">
                    <div class="dropdown-menu" aria-labelledby="selectCountry">
                        @foreach($countries as $country)
                            <a class="dropdown-item {{$country['active']?'active':''}}"
                               href="?country={{$country['id']}}">{{$country['name']}}</a>
                            @if($country['active'])
                                @section('active-country', $country['name'])
                            @endif
                        @endforeach
                    </div>
                    <a class="nav-link dropdown-toggle" href="#" id="selectCountry" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @yield('active-country')
                    </a>
                </li>
            @endif
            @if($cities)
                <li class="nav-item dropdown">
                    <div class="dropdown-menu" aria-labelledby="selectCity">
                        @foreach($cities as $city)
                            <a class="dropdown-item {{$city['active']?'active':''}}"
                               href="?country={{$city['id']}}">{{$city['name']}}</a>
                            @if($city['active'])
                                @section('active-city', $city['name'])
                            @endif
                        @endforeach
                    </div>
                    <a class="nav-link dropdown-toggle" href="#" id="selectCity" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @yield('active-city')
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>