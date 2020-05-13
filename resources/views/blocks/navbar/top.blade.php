@php($topNavGeneral = [
[
    'name' => 'home',
    'url' => '/',
],
[
    'name' => 'about_page',
    'url' => '/about',
],
])
@if ($userAuthorized)
    @php($topNavUser = [
        [
            'name' => 'user_page',
            'url' => '/user',
        ],
    ])
@else
    @php($topNavUser = [
        [
            'name' => 'user_reg',
            'url' => '/signUp',
        ],
    ])
@endif
<div class="top-nav">
    <ul class="row justify-content-end">
        @each('blocks.navbar.nav-item', $topNavGeneral, 'item')
        @each('blocks.navbar.nav-item', $topNavUser, 'item')
    </ul>
</div>
