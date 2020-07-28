<div class="col-4 flash">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>