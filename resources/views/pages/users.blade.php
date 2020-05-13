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
      },
      {
        "id": 5,
        "fullName": "Roslyn Fields",
        "name": "Frieda",
        "description": "Ipsum sint excepteur consequat duis enim pariatur et reprehenderit qui cillum. Ullamco qui cupidatat tempor ad aliquip proident commodo dolor proident duis adipisicing quis nisi. Irure amet cupidatat pariatur labore sint ullamco amet minim.\r\n",
        "friendsCount": 27,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 6,
        "fullName": "Delaney Decker",
        "name": "Garza",
        "description": "Nulla ea eu minim sunt dolor officia. Do commodo labore qui aliqua. In adipisicing minim Lorem non laboris in officia reprehenderit duis in cillum duis. Ullamco tempor voluptate laborum qui elit ut esse duis laboris consectetur irure eu dolor. Sit deserunt aliqua sunt veniam dolor consectetur mollit minim cupidatat fugiat eu cillum laboris veniam. Sunt esse tempor mollit deserunt dolore sunt sint minim officia veniam sunt pariatur pariatur ea. Nostrud incididunt ullamco elit id.\r\n",
        "friendsCount": 29,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 7,
        "fullName": "Virgie Reyes",
        "name": "Arlene",
        "description": "In irure aliquip consectetur nostrud. Quis aute aute id adipisicing sint voluptate. Consectetur dolor nostrud aliquip et Lorem veniam officia in nostrud laboris aliqua. Do occaecat consequat ipsum nostrud dolor velit non amet deserunt.\r\n",
        "friendsCount": 40,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 8,
        "fullName": "Lynda Garza",
        "name": "Chaney",
        "description": "Eiusmod voluptate ex non culpa cillum mollit quis aliqua ad pariatur excepteur. Pariatur nostrud Lorem deserunt voluptate excepteur eu in et adipisicing est cillum Lorem. Ullamco ipsum consectetur eiusmod aute eu aute et. Esse laboris sit ad anim minim et commodo excepteur cillum est cupidatat aliquip nisi. Eiusmod sit consequat dolor tempor cupidatat dolor pariatur sint excepteur in esse aute.\r\n",
        "friendsCount": 35,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 9,
        "fullName": "Gutierrez Kramer",
        "name": "Joanne",
        "description": "Aliqua eu magna labore consectetur exercitation deserunt id enim in Lorem occaecat. Incididunt pariatur minim eiusmod proident proident anim consequat duis. Sint ea proident qui nulla culpa occaecat eu velit. Tempor exercitation deserunt fugiat velit fugiat anim sit deserunt veniam sunt. Pariatur sit consequat do nulla elit. Sint do sunt consectetur dolor ipsum sit officia laboris dolore cillum. Ullamco pariatur nostrud in anim commodo ex adipisicing dolor aute duis.\r\n",
        "friendsCount": 38,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      },
      {
        "id": 10,
        "fullName": "Liliana Robles",
        "name": "Beard",
        "description": "Ea esse excepteur sint minim anim non est Lorem sunt commodo sunt. Nostrud ut eiusmod ad mollit in laboris adipisicing consequat dolore. Duis consequat pariatur veniam ipsum sunt ex dolor voluptate excepteur proident enim cupidatat. Quis in reprehenderit non Lorem veniam incididunt ex deserunt Lorem deserunt cillum Lorem velit eiusmod. Velit voluptate pariatur consectetur aliquip dolor pariatur quis tempor eu dolore.\r\n",
        "friendsCount": 25,
        "avatarLink": "https://picsum.photos/200/200",
        "avatarLinkSmall": "https://picsum.photos/50/50"
      }
    ]
    ';
    $users = json_decode($userJson);
@endphp
@extends('layouts.app')
@section('main')
    <div class="row row-cols-1 row-cols-md-6">
        @foreach($users as $user)
            <div class="col mb-4">
                @include('components.profile.profile_card', [$user])
            </div>
        @endforeach
    </div>
@endsection
