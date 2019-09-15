@extends('admin.layouts.index')

@section('title', __('admin.pages.user_profile'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.user.profile') }}
@endsection

@section('content')
    <section class="page-section">
        <div id="app">
            <card-simple title="{{ __('admin.pages.user_profile') }}">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="2" class="pb-4">
                                <img src="{{ asset('/img/avatar.png') }}" alt="Sample avatar" width="100">
                            </td>
                        </tr>
                        <tr>
                            <th class="pr-4">{{ __('First name:') }}</th>
                            <td>John</td>
                        </tr>
                        <tr>
                            <th class="pr-4">{{ __('Last name:') }}</th>
                            <td>Smith</td>
                        </tr>
                        <tr>
                            <th class="pr-4">{{ __('Date of registration:') }}</th>
                            <td>01.01.1970</td>
                        </tr>
                        <tr>
                            <th class="pr-4">{{ __('Last login:') }}</th>
                            <td>02.01.1970</td>
                        </tr>
                        <tr>
                            <th class="pr-4">{{ __('Conversations:') }}</th>
                            <td>10</td>
                        </tr>
                    </tbody>
                </table>
            </card-simple>
        </div>
    </section>
@endsection
