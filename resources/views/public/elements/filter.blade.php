<div class="filter-movie i-iblock">
    <div class="i-title"><span class="">Го в кино!</span></div>
    <form action="{{ \route('public.movies.search') }}" method="get" class="">
        <div class="i-content container">
            <div class="row">
                <div class="form-group col-md-2">
                    <a class="btn btn-primary w-100 shadow" href="{{ \route('public.movies.search', ['filter_date' => date(\App\Helpers\Views\AdminHelpers::FORMAT_SITE_DATE) ]) }}" role="button">Сегодня</a>
                </div>
                <div class="form-group col-md-2">
                    <a class="btn btn-primary w-100 shadow" href="#" role="button" style="padding-left: 0; padding-right: 0;">Премьеры недели</a>
                </div>
                <div class="form-group col-md-2">
                    <div class="input-group date shadow" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" role="date" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="Дата" name="filter_date" value="{{ $filter_date }}" />
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <select class="custom-select shadow" name="filter_genreId">
                        <option value="">Жанры...</option>
                        @foreach($filter_genres as $item)
                            <option @if($item['id'] == $filter_genreId) selected="selected" @endif >{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="custom-select shadow" name="filter_cinemaId">
                        <option value="">Кинотеатр...</option>
                        @foreach($filter_cinemas as $item)
                            <option @if($item['id'] == $filter_cinemaId) selected="selected" @endif >{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" class="btn btn-success w-100 shadow" value="Искать!">
                </div>
            </div>
        </div>
    </form>
</div>
