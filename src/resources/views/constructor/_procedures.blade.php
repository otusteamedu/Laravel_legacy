<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
<section id="procedures">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ __('headers.constructor.procedure') }}</h1>
        <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap
            example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>

    <div class="container pb-4">
        <div class="card-deck mb-3 text-center">
            @forelse($business->procedures as $procedure)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{ $procedure->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ $procedure->price }} р.</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Продолжительность: <i class="far fa-clock"></i> {{ $procedure->duration }} мин.</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Записаться</button>
                    </div>
                </div>
            @empty
                <div class="text-center flex-grow-1">
                    <a href="{{ route('procedure.create') }}">Добавить процедуры ...</a>
                </div>
            @endforelse
        </div>

        @if($business->procedures->count() > 3)
        <div class="text-center">
            <a href="#">Все процедуры ...</a>
        </div>
        @endif
    </div>
</section>
