<?php
/**
 * @var string $method
 * @var string $route
 * @var array $route_params
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
</form>
