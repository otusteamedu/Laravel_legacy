<?php
/**
 * @var string $method
 * @var string $route
 * @var array $route_params
 * @var string $button_text
 * @var \Illuminate\Support\ViewErrorBag $errors
 */
?>

<form action="{{ route($route, $route_params) }}" method="POST">
    @csrf
    @method($method)

    @yield('form_content')

    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach

    <div class="form-group text-right py-4">
        <button type="submit" class="btn btn-primary">{{ $button_text }}</button>
    </div>
</form>
