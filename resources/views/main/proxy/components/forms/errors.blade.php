@if($errors->count())
    <div class="alert alert-danger errors">
        @foreach($errors->toArray() as $error)
            @foreach($error as $err)
                {{ $err }}<br>
            @endforeach
        @endforeach
    </div>
@endif
