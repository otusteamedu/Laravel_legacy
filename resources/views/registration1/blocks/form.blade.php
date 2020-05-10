

{!! Form::open(['url' => 'foo/bar', 'method' => 'post', 'class' => 'form-signin']) !!}
    <div class="text-center mb-4">
        {{--        <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">--}}
        <h1 class="h3 mb-3 font-weight-normal">Floating labels</h1>
        <p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p>
    </div>

    <div class="form-label-group">
        {{ Form::email('email', null, array('class'=>'form-control', 'placeholder' => 'Email address', 'required' , 'autofocus')) }}
        {{ Form::label('email', 'Email address') }}
        {{--        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>--}}
{{--        <label for="inputEmail">Email address</label>--}}
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            {{ Form::checkbox('remember-me', 'remember-me') }}  Remember me
        </label>
    </div>
{{--    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>--}}
{{ Form::submit('Sign in' , ['class' => 'btn btn-lg btn-primary btn-block']) }}
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2019</p>
{!! Form::close() !!}



{{--{!! Form::open(['url' => 'foo/bar', 'method' => 'post', 'class' => 'form-signin']) !!}
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
{!! Form::close() !!}--}}
