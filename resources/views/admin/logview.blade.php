<!-- Управление системой -->
@extends('layouts.admin')
@section('content')
    @include('blocks.navbars.admin-menu')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 ">
        <div class="table-wrapper">
            <div class="table-title border-bottom">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>@lang('messages.admin.menu.logview')</h2>
                    </div>
                </div>
            </div>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('messages.admin.activitylog.created_at')</th>
                    <th>@lang('messages.admin.activitylog.url')</th>
                    <th>@lang('messages.admin.activitylog.user_name')</th>
                    <th>@lang('messages.admin.activitylog.ip')</th>
                    <th>@lang('messages.admin.activitylog.status')</th>
                    <th>@lang('messages.admin.activitylog.duration')</th>
                </tr>
                </thead>
                <tbody>

                @foreach($rows as $row)
                    <tr>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->url }}</td>
                        <td>{{ $row->user ? $row->user->name : '-' }}</td>
                        <td>{{ $row->ip }}</td>
                        <td>{{ $row->status }}</td>
                        <td>{{ $row->duration }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($rows->total() > $rows->count())
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            {{ $rows->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
@section('footer')
    <footer class="blog-footer border-top pt-3">
        @include('blocks.footer.footer')
    </footer>
@endsection
