<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">{{ $business->name }}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#procedures">{{ __('constructor.procedure') }}</a>
        <a class="p-2 text-dark" href="#addresses">{{ __('constructor.address') }}</a>
        <a class="p-2 text-dark" href="#feedback">{{ __('constructor.feedback') }}</a>
    </nav>
    <a class="btn btn-outline-primary" href="#">Sign up</a>
</div>
