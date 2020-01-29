@if($errors->all())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
@if (session('status'))
    <div class="alert alert-danger">
        {{session('status')}}
    </div>
@endif
