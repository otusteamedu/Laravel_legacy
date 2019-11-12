<div class="header">
    <h3><a href="/"> {{ $title }} </a></h3>
    <p>{{ $description }}</p>
    {{ $slot }}
</div>
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
