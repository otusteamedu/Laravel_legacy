@extends('layouts.app')

@section('app_content')
    @include('schedule.filter')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <div class="card-body">
                        <h4>@lang('scheduler.week'): 2020-01-27 - 2020-02-02</h4>

                        <table class="table table-hover table-bordered ">
                            <thead>
                            <tr>
                                <th scope="col">@lang('scheduler.lesson_time')</th>
                                <th scope="col">@lang('scheduler.Monday')</th>
                                <th scope="col">@lang('scheduler.Tuesday')</th>
                                <th scope="col">@lang('scheduler.Wednesday')</th>
                                <th scope="col">@lang('scheduler.Thursday')</th>
                                <th scope="col">@lang('scheduler.Friday')</th>
                                <th scope="col">@lang('scheduler.Saturday')</th>
                                <th scope="col">@lang('scheduler.Sunday')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @include('schedule.schedule_week', [
                                    'row' => [
                                        '8:00 - 9:35',
                                        [
                                            'lesson_type' => 'lecture',
                                            'group' => 111,
                                            'subject' => 'chemistry',
                                            'teacher' => 'Ivanov Ivan Ivanovich',
                                            'room' => '101',
                                        ],[
                                            'lesson_type' => 'lecture',
                                            'group' => 111,
                                            'subject' => 'chemistry',
                                            'teacher' => 'Ivanov Ivan Ivanovich',
                                            'room' => '101',
                                        ],[
                                            'lesson_type' => 'lecture',
                                            'group' => 111,
                                            'subject' => 'chemistry',
                                            'teacher' => 'Ivanov Ivan Ivanovich',
                                            'room' => '101',
                                        ],[
                                            'lesson_type' => 'lecture',
                                            'group' => 111,
                                            'subject' => 'chemistry',
                                            'teacher' => 'Ivanov Ivan Ivanovich',
                                            'room' => '101',
                                        ],[
                                            'lesson_type' => 'lecture',
                                            'group' => 111,
                                            'subject' => 'chemistry',
                                            'teacher' => 'Ivanov Ivan Ivanovich',
                                            'room' => '101',
                                        ],
                                        null,
                                        null,
                                    ],
                                ])
                            </tr>
                            <tr>
                                <th scope="row">9:45 - 11:20</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">11:30 - 13:05</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">13:55 - 15:30</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">15:40 - 17:15</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">17:25 - 19:00</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">19:10 - 20:45</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>

@endsection
