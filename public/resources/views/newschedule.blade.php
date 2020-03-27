@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h3>Новый маршрут</h3>
        </div>
        <div>
            <form action="/newroute" method="post">
                @csrf
                <div class="form-group">
                    <label for="transport_id">Транспорт</label>
                    <select id="transport_id" name="transport_id" class="form-control">
                        @foreach ($transports as $transport)
                                <option value="{{ $transport['id'] }}">
                                    {{ $transport['model'] }}
                                    {{ $transport['register'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="defaultRegion">Отправление</label>
                    <input type="text" id="defaultRegion" class="form-control" placeholder="Москва" disabled>
                </div>
                <div class="form-group">
                    <label for="region_id">Пункт назначения</label>
                    <select id="region_id" name="region_id" class="form-control">
                        @foreach ($regions as $region)
                            @if ($region['id'] != 0)
                            <option value="{{ $region['id'] }}">{{ $region['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Дата</label>
                    <input type="date"
                               class="form-control"
                               id="date"  name="date"
                               placeholder=" date">
                </div>
                <div class="form-group">
                    <label for="time">Время: </label>
                    <input id="time" type="time" name="time" placeholder=" time" class="form-control">
                </div>
                <input type="hidden"
                       name="hidden_id"
                       value=" ">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Добавить</button>
            </form>
        </div>
    </div>
@endsection


