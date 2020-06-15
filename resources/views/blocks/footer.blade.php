<div class="footer">
    @if (count($locales) > 1)
    <div class="float-right m-1">
        @foreach($locales as $locale)
            @if (!$loop->first) / @endif
            @if ($currentLocale == $locale)
                <b>{{ $locale }}</b>
            @else
                <a href="/{{ $locale }}{{ $currentUrl }}">{{ $locale }}</a>
            @endif
        @endforeach
    </div>
    @endif
    <p class="mt-1">{!! __('blocks/footer.developer') !!}</p>
</div>
