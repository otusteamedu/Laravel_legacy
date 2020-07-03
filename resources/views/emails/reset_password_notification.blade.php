@component('mail::message')
    @lang('messages.Hello!')

    @component('mail::button', ['url' => $url])
        @lang('auth.Reset Password')
    @endcomponent

    {{-- Subcopy --}}
    @isset($url)
        @slot('subcopy')
            @lang('auth.can not reset by button') <span class="break-all">[{{ $url }}]({{ $url }})</span>
        @endslot
    @endisset
@endcomponent
