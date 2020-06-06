@if($errors->all())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif


@if (session()->has('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
