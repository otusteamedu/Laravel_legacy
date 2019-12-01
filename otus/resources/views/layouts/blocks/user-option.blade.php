@php
    /** @var \App\Models\User $user */

$user = Auth::user();

@endphp
<div class="userOptions">
    <button class="ic-logout logout blue"></button>
    <a class="userWrap" href="#">
        <span class="userWrap__userName">{{$user->name}}</span>
        <span class="userWrap__userPhoto">
            <img class="userWrap__userPhotoImg" src="{{ asset('storage/' . $user->photo) }}" alt="" role="presentation"/>
        </span>
    </a>
</div>
