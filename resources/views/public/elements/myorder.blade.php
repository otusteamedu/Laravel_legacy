<a class="nav-link p-2" href="{{ route('public.account.order') }}" aria-label="@lang('public.myorder')">
    <i class="fas fa-shopping-cart"></i>
    <span class="d-none d-lg-inline">@lang('public.myorder')</span>
    <span class="badge badge-warning">{{ $cartCount }}</span>
</a>
