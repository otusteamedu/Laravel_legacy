
<div class="dropdown">
    <button class="btn btn-link btn-sm dropdown-toggle " type="button" data-toggle="dropdown">

        @foreach($townList->items as $item)  {{-- //TODO (говнокод ? ) - гдето в другом месте брать название города --}}
            <?php if ($item->id==$town_id)  $town_name = $item->name  ?>
        @Endforeach
        {{$town_name ?? 'Выбор города'}}

        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        @foreach($townList->items as $item)
            <li><a href="{{route('setTown', ['town_id'=>$item->id]) ?? ''}}">{{$item->name ?? ''}}</a></li>
        @Endforeach
    </ul>
</div>


