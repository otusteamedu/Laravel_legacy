<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
@include('constructor._menu')

<section class="jumbotron text-center">
    <div class="container">
        <h6>{{ $business->type->name }}</h6>
        <h1>{{ $business->name }}</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
            etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
            <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
    </div>
</section>

@include('constructor._procedures', ['constructor' => 1])

@include('constructor._address')

@include('constructor._feedback')

@include('constructor._footer')

