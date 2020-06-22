@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
@if($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                {{ $errors->first() }}
            </div>
        </div>
    </div>
@endif
