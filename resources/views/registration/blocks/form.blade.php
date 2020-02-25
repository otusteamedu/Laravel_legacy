
{!! Form::open(['url' => 'foo/bar', 'method' => 'post', 'class' => 'form-signin']) !!}
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    {{ Form::label('email', 'Email address', ['class' => 'sr-only']) }}
    {{ Form::email('email', null, array('class'=>'form-control', 'placeholder' => 'Email address', 'required' , 'autofocus')) }}
    {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
    {{ Form::password('password', array('class'=>'form-control', 'placeholder' => 'Password')) }}
    <div class="checkbox mb-3">
        <label>
        {{ Form::checkbox('remember-me', 'remember-me') }}  Remember me
        </label>
    </div>
    {{ Form::submit('Click Me!' , ['class' => 'btn btn-lg btn-primary btn-block']) }}
<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
{!! Form::close() !!}
