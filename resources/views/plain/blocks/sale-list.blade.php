<div class="sale-list">
    @foreach ($offers as $offer)
        @include('plain.blocks.sale-iatem', $offer)
    @endforeach
</div>
