<div class="container">
{{--    <div class="row justify-content-center">--}}

{{--        @for ($i = 0; $i < 8; $i++)--}}
{{--            <div class="card m-4" style="width: 18rem;">--}}
{{--                <img src="{{ URL::asset('img/default.jpg') }}" class="card-img-top" alt="...">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">2-х комнатная квартира</h5>--}}
{{--                    <p class="card-text">Москва</p>--}}
{{--                    <h6>Цена: 5 000 000 р.</h6>--}}
{{--                    <a href="#" class="btn btn-outline-primary mt-3">просмотр</a>--}}
{{--                    <a href="#" class="btn btn-outline-primary mt-3">в избранное--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="18" height="18" viewBox="0 0 1792 1792">--}}
{{--                            <path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19--}}
{{--                                0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6--}}
{{--                                2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49--}}
{{--                                41l225 455 502 73q56 9 56 46z" fill="#ff9800"></path>--}}
{{--                        </svg>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endfor--}}
{{--    </div>--}}

    <div class="row justify-content-center">
    @foreach($pages as $item)
        <div class="card m-4" style="width: 18rem;">
            <img src="{{ URL::asset('img/default.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$item->title}}</h5>
                <p class="card-text">{{$item->town->name}}</p>
                <h6>Цена: {{$item->price}}</h6>
                <a href="/home/{{$item->id  ?? ''}}" class="btn btn-outline-primary mt-3">просмотр</a>
                <a href="#" class="btn btn-outline-primary mt-3">в избранное
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="18" height="18" viewBox="0 0 1792 1792">
                        <path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19
                                0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6
                                2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49
                                41l225 455 502 73q56 9 56 46z" fill="#ff9800"></path>
                    </svg>
                </a>
            </div>
        </div>
    @Endforeach
    </div>

    {{ $pages->links() }}


</div>
