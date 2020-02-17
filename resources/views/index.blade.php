@extends('layouts.base')

@section('title', __('menu.main'))

@section('content')
    <div class="container">
        <div class="tab-pane mb-2">
            <a class="btn btn-primary btn-lg" href="/{{ App::getLocale() }}/add" role="button">@lang('main.add')</a>
            <a class="btn btn-primary btn-lg" href="?" role="button">@lang('main.refresh')</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped  table-bordered">
                {{--
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('main.field_type')</th>
                    <th scope="col">@lang('main.field_name')</th>
                    <th scope="col">@lang('main.field_price')</th>
                    <th scope="col">@lang('main.field_price_delta')</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                @php
                    $items = [
                        ['type' => 'emission', 'name' => 'Авангард-Агро, БО-001P-01', 'price' => 100.4, 'price_delta' => -0.20],
                        ['type' => 'emission', 'name' => 'БАНК УРАЛСИБ, БО-П01', 'price' => 97, 'price_delta' => 0.5],
                        ['type' => 'index', 'name' => 'USD/RUB', 'price' => 63.47, 'price_delta' => -0.1],
                        ['type' => 'index', 'name' => 'XMR/RUB', 'price' => 5378.63, 'price_delta' => 0],
                    ]
                @endphp
                @foreach($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@lang("main.type_" . $item['type'])</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td class="@if($item['price_delta'] > 0) text-success @elseif($item['price_delta'] < 0) text-danger @endif">
                            {{ $item['price_delta'] }}
                        </td>
                        <td>
                            <a class="btn btn-default btn-sm text-danger">@lang("main.remove")</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                --}}

                <tbody>
                @foreach($data as $item)
                    <tr>
                        {{--<td>{{ $loop->iteration }}</td>--}}
                        <td>{{ $item->id }}</td>
                        <td>{{ $lang == 'en' ? $item->name_eng : $item->name }}</td>
                        <td>{{ $lang == 'en' ? $item->country->name_eng : $item->country->name }}</td>
                        <td>{{ $lang == 'en' ? $item->orgBranch->name_eng : $item->orgBranch->name }}</td>
                        <td>{{ $lang == 'en' ? $item->orgType->name_eng : $item->orgType->name }}</td>
                        <td>{{ $lang == 'en' ? $item->orgGroup->name_eng : $item->orgGroup->name }}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>

        </div>

    </div>
@endsection
