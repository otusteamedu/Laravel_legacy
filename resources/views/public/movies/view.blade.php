@extends('public.movies.layout')

@section('pageTitle')
    {{ $item['name'] }}: информация о фильме
@endsection

@section('pageHeader')
    {{ $item['name'] }}: информация о фильме
@endsection

@section('pageContentMain')
    <div class="movie-detail i-iblock container-fluid">
        <div class="row">
            <div class="col-sm-5 my-3 p-0">
                <div class="image">
                @if($item['poster'])
                    <i style="background-image: url({{ asset($item['poster']) }})"></i>
                @else:
                    <i class="no-photo"></i>
                @endif
                </div>
                <span class="age-limit">{{ $item['ageLimit'] }}</span>
                <div class="buttons">
                    @if ($item['trailer'])
                        <a class="btn btn-warning shadow" href="#" role="button" id="btnTrailer">
                            <i class="fas fa-play"></i>
                            Смотреть трейлер
                        </a>
                        <a class="btn btn-success shadow" href="{{ route('public.movies.order', ['id' => $item['id']]) }}" role="button">
                            <i class="fas fa-cart-arrow-down"></i>
                            Купить билет
                        </a>
                        <div id="trailerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="trailerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Трейлер
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe width="100%" height="350" frameborder="0" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#btnTrailer').click(function () {
                                var src = '{{ $item['trailer'] }}&amp;autoplay=1';
                                $('#trailerModal').modal('show');
                                $('#trailerModal iframe').attr('src', src);
                                return false;
                            });

                            $('#trailerModal button').click(function () {
                                $('#trailerModal iframe').removeAttr('src');
                            });
                        </script>
                    @endif
                </div>
            </div>
            <div class="col-sm-7 my-3 desc">
                <ul class="properties">
                    <li>
                        <span class="p-name">Наименование:</span>
                        <span class="p-value">{{ $item['name'] }}</span>
                    </li>
                    @if (count($item['genres']) > 0)
                    <li>
                        <span class="p-name">Жанры:</span>
                        <span class="p-value">
                            @foreach($item['genres'] as $value)
                                {{ $value['name'] }}@if (!$loop->last), @endif
                            @endforeach
                        </span>
                    </li>
                    @endif
                    @if ($item['premiereDate'])
                        <li>
                            <span class="p-name">Дата премьеры:</span>
                            <span class="p-value">{{ $item['premiereDate']->format('d.m.Y') }}</span>
                        </li>
                    @endif
                    @if ($item['producer'])
                        <li>
                            <span class="p-name">Режисер:</span>
                            <span class="p-value">{{ $item['producer']['name'] }}</span>
                        </li>
                    @endif
                    @if (count($item['actors']) > 0)
                        <li>
                            <span class="p-name">В ролях:</span>
                            <span class="p-value">
                            @foreach($item['actors'] as $value)
                                    {{ $value['name'] }}@if (!$loop->last), @endif
                                @endforeach
                        </span>
                        </li>
                    @endif
                    @if (count($item['countries']) > 0)
                        <li>
                            <span class="p-name">Страна:</span>
                            <span class="p-value">
                            @foreach($item['countries'] as $value)
                                    {{ $value['name'] }}@if (!$loop->last), @endif
                                @endforeach
                        </span>
                        </li>
                    @endif
                    @if ($item['slogan'])
                        <li>
                            <span class="p-name">Слоган:</span>
                            <span class="p-value">{{ $item['slogan'] }}</span>
                        </li>
                    @endif
                    @if ($item['duration'])
                        <li>
                            <span class="p-name">Длительность:</span>
                            <span class="p-value">{{ $item['duration'] }} мин.</span>
                        </li>
                    @endif
                </ul>
                <div class="text">
                    {{ $item['description'] }}
                </div>
                <div class="buttons">
                    <a class="btn btn-success shadow" href="{{ route('public.movies.order', ['id' => $item['id']]) }}" role="button">
                        <i class="fas fa-cart-arrow-down"></i>
                        Купить билет
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('public.start.elements.movieShow')
    @include('public.elements.filter')

@endsection
