@php
/**
 @var \App\Models\User $user
 @var \App\Models\Material $material
*/
$userCollection = \App\Models\User::all();
$user = $userCollection->get(0);
@endphp

<div class="listBook">
    <span class="listBook__title">@lang('messages.read_books')</span>
    <ul class="listBook__list">
        @foreach($user->readMaterials as $material)
            <li class="listBook__item"><a class="listBook__link" href="#">
                    <span class="listBook__wrapImg"><img class="listBook__imgBook" src="{{asset('storage/' . $material->preview_image)}}" alt="" role="presentation"/></span>
                    <span class="listBook__wrapText"><span class="listBook__titleBook">{{$material->name}}</span>
                        <span class="listBook__authorBook">
                           @foreach($material->authors as $author)
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
