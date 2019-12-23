@if(!empty($title))
<div class="display-4">
    {!! $title !!}
</div>
@endif
<div class="owl-carousel owl-theme">
    @foreach($slides as $slide)
        @include('blocks.card.slide', [
            'card' => $slide,
        ])
    @endforeach
</div>