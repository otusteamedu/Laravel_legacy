<div class="sale-list">
    @foreach ($offers as $offer)
        @include('plain.blocks.sale-item', $offer)
    @endforeach
</div>
