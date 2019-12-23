<div id="mainCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($slides as $slide)
            <li data-target="#mainCarousel" data-slide-to="{{$loop->index}}" class="{{$loop->first?'active':''}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($slides as $slide)
            <div class="carousel-item {{$loop->first?'active':''}}">
                @if(!empty($slide['image']))
                    <img class="bd-placeholder-img" src="{{$slide['image']}}"/>
                @else
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                         preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777"></rect>
                    </svg>
                @endif
                <div class="container">
                    <div class="carousel-caption text-left">
                        <div class="display-4">{{$slide['name']}}</div>
                        <div>{!! $slide['text'] !!}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>