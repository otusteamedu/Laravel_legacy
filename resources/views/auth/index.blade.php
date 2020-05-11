@section('content')
    <div class="auth-block">
        <h1>{{ $title }}</h1>
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('email', trans('auth/general.form.email')) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('auth/general.form.email.placeholder')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', trans('auth/general.form.password')) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('auth/general.form.password.placeholder')]) !!}
            <small class="form-text"><a href="/auth/recover/">{{ __('auth/general.form.recover') }}</a></small>
        </div>
        <div class="form-group form-check">
            <label for="remember">
                {!! Form::checkbox('remember', '1', false,  ['id' => 'remember', 'class' => 'form-check-input']) !!}
                {{ __('auth/general.form.remember_me') }}
            </label>
        </div>
        {!! Form::submit(trans('auth/general.form.submit'), ['class' => 'btn btn-primary']) !!}
        @csrf
        {!! Form::close() !!}
    </div>
@endsection

@include('layouts.general')
