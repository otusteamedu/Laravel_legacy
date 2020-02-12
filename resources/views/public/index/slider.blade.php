<div class=" container">
    @php
        $slider = [
          'images/index_slider/slaid1.jpg',
          'images/index_slider/slaid2.jpg',
          'images/index_slider/slaid3.jpg',
          'images/index_slider/slaid4.jpg'
        ];
    @endphp
    <div id="carouselExampleSlidesOnly" class="carousel slide mt-3" data-ride="carousel">
      <div class="carousel-inner">
        @foreach ($slider as $slide)
          @if ($loop->first)
            <div class="carousel-item active">
              <img src="{{ $slide }}" class="d-block w-100" alt="">
            </div>
          @else
          <div class="carousel-item">
            <img src="{{ $slide }}" class="d-block w-100" alt="">
          </div>
          @endif
        @endforeach
      </div>
    </div>
</div>