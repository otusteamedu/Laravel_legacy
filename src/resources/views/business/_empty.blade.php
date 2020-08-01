<div class="text-center justify-content-center row mt-5">
    <div class="col-md-3">
        <img src="/images/flag.svg" width="150px"/>
    </div>
    <div class="col-md-4 d-flex align-items-center justify-content-center flex-column">
        <p class="text-muted">{{ __('business.empty') }}</p>
        <a href="{{ url('business/create') }}" class="btn btn-success mt-2">
            <i class="fa fa-plus"></i> {{ __('buttons.business.add') }}
        </a>
    </div>
</div>
