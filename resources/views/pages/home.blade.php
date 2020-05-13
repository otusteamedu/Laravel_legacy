@php
    $userJson = '
    {
      "id": "1",
      "name": "Max",
      "description": "Lorem ipsum",
      "fullName": "Max Fullname",
      "friendsCount": "23",
      "avatarLink": "https://picsum.photos/50/50",
      "avatarLinkSmall": "https://picsum.photos/50/50"
    }
    ';
    $postJson = '
    [
        {
          "id": "1",
          "text": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos ipsa praesentium esse magnam nemo dolor sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.",
          "created": "2020-02-01 20:00:00",
          "author": {
             "id": "1",
              "name": "Max",
              "description": "Lorem ipsum",
              "fullName": "Max Fullname",
              "friendsCount": "23",
              "avatarLink": "https://picsum.photos/50/50",
              "avatarLinkSmall": "https://picsum.photos/50/50"
          }
        },
        {
          "id": "2",
          "text": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos ipsa praesentium esse magnam nemo dolor sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.",
          "created": "2020-02-02 20:00:00",
          "author": {
             "id": "1",
              "name": "Max",
              "description": "Lorem ipsum",
              "fullName": "Max Fullname",
              "friendsCount": "23",
              "avatarLink": "https://picsum.photos/50/50",
              "avatarLinkSmall": "https://picsum.photos/50/50"
          }
        },
        {
          "id": "3",
          "text": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos ipsa praesentium esse magnam nemo dolor sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.",
          "created": "2020-02-03 20:00:00",
          "author": {
             "id": "1",
              "name": "Max",
              "description": "Lorem ipsum",
              "fullName": "Max Fullname",
              "friendsCount": "23",
              "avatarLink": "https://picsum.photos/50/50",
              "avatarLinkSmall": "https://picsum.photos/50/50"
          }
        }
    ]

    ';
    $user = json_decode($userJson);
    $posts = json_decode($postJson);
@endphp
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-md-3">
            @include('components.profile.profile' , [$user])
        </div>
        <div class="col-md-6 feed">
            @include('components.feed.form')
            @foreach($posts as $post)
                @include('components.feed.post.post', [$post])
            @endforeach
        </div>
    </div>
@endsection
