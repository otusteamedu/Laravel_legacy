@if (count($cinemasList) > 0)
    <div class="cinemas-list i-iblock">
        <ul>
            @foreach ($cinemasList as $item)
            <li>
                <a href="{{ route('public.cinemas.item', ['id' => $item['ID']]) }}">{{ $item['NAME'] }}</a>
            </li>
            @endforeach
        </ul>
    </div>
@endif
