@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        @if (session('error'))
            {{ session('error') }}
        @endif
    </div>
@endif
