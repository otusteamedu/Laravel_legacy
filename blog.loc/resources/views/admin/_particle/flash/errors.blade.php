<div class="col-4 flash">
    @foreach ($errors->all() as $message)
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
</div>