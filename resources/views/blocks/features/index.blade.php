<!-- START THE FEATURETTES -->

@foreach($items as $item)
    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 {{($loop->iteration % 2 == 0) ?'order-md-2':''}}">
            <h2 class="featurette-heading">{!! $item['name'] !!}</h2>
            <p class="lead">{!! $item['text'] !!}</p>
        </div>
        <div class="col-md-5 {{($loop->iteration % 2 == 0) ?'order-md-1':''}}">

            @if(!empty($item['image']))
                <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"  width="500"
                     height="500" src="{{$item['image']}}"/>
            @else
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false"
                     role="img" aria-label="Placeholder: 500x500">
                    <rect width="100%" height="100%" fill="#eee"/>
                </svg>
            @endif

        </div>
    </div>
@endforeach

<!-- /END THE FEATURETTES -->