@php
    /**
     @var \App\Models\User $user
     @var \App\Models\Favorite $favorite
    */
    $userCollection = \App\Models\User::all();
    $user = $userCollection->get(0);
@endphp
<div class="listBook"><span class="listBook__title">@lang('messages.favorite')</span>
    <ul class="listBook__list">

        @foreach($user->favorites as $favorite)
            <li class="listBook__item">
                <a class="listBook__link" href="{{route('admin.materials.show', ['material' => $favorite->materials])}}">
                    <span class="listBook__wrapImg">
                        <img class="listBook__imgBook" src="{{asset('storage/' . $favorite->materials->preview_image)}}" alt="" role="presentation"/>
                    </span>
                    <span class="listBook__wrapText">
                        <span class="listBook__titleBook">{{$favorite->materials->name}}</span>
                        <span class="listBook__authorBook">
                             @foreach($favorite->materials->authors as $author)
                                @if(isset($author))
                                    {{$author->name}}
                                    @if(!$loop->last)
                                        ,
                                    @endif
                                @endif
                            @endforeach
                        </span>
                    </span>
                </a>
            </li>
       @endforeach
    </ul>
</div>
