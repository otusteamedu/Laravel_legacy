@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-4 col-sm-3 col-lg-2 text-center">
                    <img src="/{{ $user['image'] }}" alt="{{ $user['name'] }}" class="rounded profile-img">
                </div>
                <div class="col-8 col-sm-9 col-lg-10">
                    <div>{{ __('profile/general.field.id') }}: <b>{{ $user['id'] }}</b></div>
                    <div>{{ __('profile/general.field.email') }}: <b>{{ $user['email'] }}</b></div>

                    <p class="mt-2">
                        <a href="/profile/edit" class="btn btn-primary">{{ __('profile/general.change') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.general')
