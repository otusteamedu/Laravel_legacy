<a class="nav-link p-2" href="{{ route('public.order.checkout') }}" aria-label="@lang('public.myorder')">
    <i class="fas fa-shopping-cart"></i>
    <span class="d-none d-lg-inline">@lang('public.myorder')</span>
    <span class="badge badge-warning">
        @if($summary['count'] > 0)
            {{ $summary['count'] }}шт. / {{ $summary['total'] }}р.
        @else
            {{ $summary['count'] }}
        @endif
    </span>
</a>
