@php
$brands =[
  [
    'images/footer_slide/sl1.png',
    'images/footer_slide/sl2.png',
    'images/footer_slide/sl3.png',
    'images/footer_slide/sl4.png',
    
    
  ],
  [
    'images/footer_slide/sl6.png',
    'images/footer_slide/sl7.png',
    'images/footer_slide/sl8.png',
    'images/footer_slide/sl9.png',

  ],
  [
    'images/footer_slide/sl5.png',
    'images/footer_slide/sl10.png',
  ],
];
@endphp
<div class="container rounded-lg bg-content mt-3 mb-3">
<div class="row justify-content-center">
<div class="col-12 col-md-10 m-3 m-md-4">
  <div id="my-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @foreach ($brands as $brandBlock)
      @if ($loop->first)
        <div class="carousel-item active">
          <div class="row justify-content-center">
            @foreach ($brandBlock as $img)
              <div class="col-3 col-md-2">
                <img class="d-block w-100" src="{{ $img }}" alt="">    
              </div>
            @endforeach
          </div>
        </div>
      @else
      <div class="carousel-item">
        <div class="row justify-content-center">
          @foreach ($brandBlock as $img)
          <div class="col-3 col-md-2">
            <img class="d-block w-100" src="{{ $img }}" alt="">    
          </div>
          @endforeach
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>
</div>
</div>