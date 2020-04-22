@foreach ($offers as $offer)
    @include('plain.blocks.sale-item', $offer)
@endforeach

{{--@for ($i = 0; $i < 12; $i++)--}}
{{--    @include('plain.blocks.sale-item')--}}
{{--@endfor--}}
