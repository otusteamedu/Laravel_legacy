@php
    $userJson = '
    [
      {
        "id": 1,
        "fullName": "Rebecca Wagner",
        "name": "Cook",
        "description": "Eu ut ex ea esse enim ea adipisicing sit amet duis veniam voluptate. Exercitation duis laboris ea reprehenderit id voluptate mollit dolore. Consectetur laborum sint ipsum laboris exercitation excepteur anim minim culpa dolore ipsum. Aute anim pariatur nostrud dolor.\r\n",
        "friendsCount": 36,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 2,
        "fullName": "Mcknight Martin",
        "name": "Edwards",
        "description": "Nostrud deserunt occaecat magna esse sit est tempor adipisicing cillum et do sunt occaecat. Consectetur qui ut magna ex eiusmod ex et quis et ad sint in. Cillum id exercitation labore aliqua mollit non proident esse eu labore amet sunt. Ipsum reprehenderit enim labore ut aliquip consectetur qui commodo reprehenderit anim consectetur amet.\r\n",
        "friendsCount": 29,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 3,
        "fullName": "Mcintosh Maxwell",
        "name": "Veronica",
        "description": "Ullamco cillum commodo ex adipisicing ipsum. Qui consequat eu quis culpa ea. Officia Lorem ea aliquip ullamco amet. Culpa Lorem velit adipisicing qui pariatur laborum.\r\n",
        "friendsCount": 39,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 4,
        "fullName": "Yates York",
        "name": "Ellis",
        "description": "In pariatur ea officia exercitation in mollit dolor laborum in. Ipsum labore nisi officia consequat consequat officia non veniam dolor amet ea nostrud nostrud dolor. Laboris do anim cupidatat aute aliquip quis magna amet.\r\n",
        "friendsCount": 23,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      }
    ]
    ';
    $users = json_decode($userJson);
@endphp
@extends('layouts.app')
@section('navbar',false)
@section('main')
    <div class="row-cols-1">
            <div class="jumbotron">
                <h1 class="display-4">Another cool social network!</h1>
                <p class="lead">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h1>
                Our cool users!
            </h1>
            <div class="row row-cols-1 row-cols-md-4">
                @foreach($users as $user)
                    <div class="col mb-4">
                        @include('components.profile.profile_card', [$user])
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            @include('components.registration.form')
        </div>
    </div>
@endsection
