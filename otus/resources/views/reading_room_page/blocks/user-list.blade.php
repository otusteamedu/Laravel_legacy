@php /** @var \App\Models\User $user */
 $userCollection = \App\Models\User::all();
@endphp

<div class="userList">
    @foreach($userCollection as $user)
        <div class="userList__item">
            <div class="userList__wrapUserInfo">
                <div class="userList__wrapAvatar">
                    <img class="userList__avatarImg" src="{{ asset('storage/' . $user->photo) }}" alt="" role="presentation"/>
                </div>
                <div class="userList__wrapName"><span>{{$user->name}}</span></div>
            </div>
            <div class="userList__wrapUserStatus">
                <div class="userList__wrapStatus"><span class="userList__statusName">@lang('messages.read')</span>
                    <span class="userList__statusCount">{{$user->readMaterials->count()}}</span>
                </div>
                <div class="userList__wrapStatus"><span class="userList__statusName">@lang('messages.on_hands')</span>
                    <div class="userList__statusCount">1</div>
                </div>
                <div class="userList__wrapStatus">
                    <span class="userList__statusName">@lang('messages.favorite')</span>
                    <span class="userList__statusCount">{{$user->favorites->count()}}</span>
                </div>
                <div class="userList__wrapStatus"><span class="userList__statusName">@lang('messages.reviews')</span>
                    <span class="userList__statusCount">{{$user->reviews->count()}}</span>
                </div>
            </div>
            <a class="userList__linkAbout" href="#">@lang('messages.more')</a>
        </div>
    @endforeach
</div>
