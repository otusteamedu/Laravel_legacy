@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('email', trans('auth/recover.form.email')) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('auth/recover.form.email.placeholder')]) !!}
        </div>
        {!! Form::submit(trans('auth/recover.form.submit'), ['class' => 'btn btn-primary']) !!}
        <span class="ml-2">{!! __('auth/recover.form.auth', ['link' => '/']) !!}</span>
        @csrf
        {!! Form::close() !!}
    </div>
@endsection

@include('layouts.general')
