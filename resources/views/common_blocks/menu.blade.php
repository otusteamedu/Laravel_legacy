<div class="list-group">
    <a href="/?lang={{$currLang}}" class="list-group-item">@lang('common_layout.page_welcome')</a>
    @auth
        <a href="/account/?lang={{$currLang}}" class="list-group-item">{{__('common_layout.page_usercab')}}</a>
    @endauth
    @guest
        <a href="/registration/?lang={{$currLang}}" class="list-group-item">{{__('common_layout.page_registration')}}</a>
    @endguest
    <a href="/about/?lang={{$currLang}}" class="list-group-item">{{__('common_layout.page_about')}}</a>
</div>
