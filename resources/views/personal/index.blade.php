@extends('layouts.app')
@section('breadcrumbs', '')

@section("content")
    <div class="row my-2">
        <div class="col-lg-4 mb-4 text-center">
            <img src="@if (empty($pictureFullPath = $user->getPictureFullPath())) {{\Config::get('images.avatar.default_path')}}
                @else{{ $pictureFullPath }}@endif"
                class="mx-auto img-fluid img-circle d-block" alt="avatar" width="200px" height="200px">
        </div>
        <div class="col-lg-8 mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">@lang('pages/personal_index.profile')</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">@lang('pages/personal_index.to_edit')</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">@lang('pages/personal_index.profile')</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>@lang('pages/personal_index.user')</strong><br>
                                @lang('global.default_first_name') @lang('global.default_last_name')
                            </p>
                            <p>
                                <strong>@lang('pages/personal_index.contacts')</strong><br>
                                email@test.ru <br>
                                +7 908 999 99 99
                            </p>
                            <p>
                                <strong>@lang('global.address')</strong><br>
                                @lang('global.default_country'), @lang('global.default_city').
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>@lang('pages/personal_index.results'):</h6>
                            <p>
                                @lang('pages/personal_index.completed_events'): <a href="/" class="badge badge-dark badge-pill">23</a>
                            </p>
                            <p>
                                @lang('pages/personal_index.created_events'): <a href="/" class="badge badge-dark badge-pill">14</a>
                            </p>
                            <p>
                                @lang('pages/personal_index.left_comments'): <a href="/" class="badge badge-dark badge-pill">124</a>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span>
                                @lang('pages/personal_index.last_activity'):
                            </h5>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>
                                <tr>
                                    <td>
                                        @lang('pages/personal_index.completed_event') <strong>"Тайна заброшенного элеватора"</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @lang('pages/personal_index.created_an_event') <strong>Сюрприз меловой пещеры</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @lang('pages/personal_index.left_comment') <strong>История старого дуба</strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="edit">
                    @include('layouts.blocks.form.errors')
                    {{ Form::model(
                        $user,
                        [
                            'route' => ['user.update', $user->id],
                            'files' => true,  'method' => 'put', 'role' => 'form', 'enctype'=>'multipart/form-data'
                        ])
                    }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.avatar')</label>
                            <div class="col-lg-9">
                                <label class="custom-file">
                                    <input type="file" id="file" name="avatar" class="custom-file-control">
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.first_name')</label>
                            <div class="col-lg-9">
                                {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => __('global.default_first_name')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.last_name')</label>
                            <div class="col-lg-9">
                                {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => __('global.default_last_name')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => __('global.default_email')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.phone_number')</label>
                            <div class="col-lg-9">
                                {{ Form::text('phone', $user->phone, ['class' => 'form-control', 'placeholder' => __('global.default_phone_number')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.country')</label>
                            <div class="col-lg-9">
                               {{ Form::select(
                                    'country_id',
                                    ['1' => 'Россия', '2' => 'Украина'],
                                    null,
                                    ['class' => 'form-control'])
                                }} <!-- @ToDo: заменить на динамические значения  -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.city')</label>
                            <div class="col-lg-9">
                                {{ Form::text('region', $user->region, ['class' => 'form-control', 'placeholder' => __('global.default_city')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.locality')</label>
                            <div class="col-lg-9">
                                {{ Form::text('locality', $user->locality, ['class' => 'form-control', 'placeholder' => __('global.default_locality')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('global.timezone')</label>
                            <div class="col-lg-9">
                                <select id="user_time_zone" class="form-control" size="0">
                                    <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                    <option value="Alaska">(GMT-09:00) Alaska</option>
                                    <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp;
                                        Canada)
                                    </option>
                                    <option value="Arizona">(GMT-07:00) Arizona</option>
                                    <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp;
                                        Canada)
                                    </option>
                                    <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00)
                                        Central Time (US &amp; Canada)
                                    </option>
                                    <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp;
                                        Canada)
                                    </option>
                                    <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('alerts/forms.password')</label>
                            <div class="col-lg-9">
                                {{ Form::text('password', '', ['class' => 'form-control', 'placeholder' => __('alerts/forms.password_default')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('alerts/forms.confirm_password')</label>
                            <div class="col-lg-9">
                                {{ Form::text('password_confirm', '', ['class' => 'form-control', 'placeholder' => __('alerts/forms.password_default')]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="@lang('alerts/forms.cancel')">
                                <input type="submit" class="btn btn-primary" value="@lang('alerts/forms.save_changes')">
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
