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
