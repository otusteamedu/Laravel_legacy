@php
    $pages = [
        [
            'name' => __('messages.about'),
            'is_active' => false,
            'slug' => '/about'
        ],
        [
            'name' => __('messages.politic'),
            'is_active' => false,
            'slug' => '/politic'
        ],
        [
            'name' => __('messages.rules'),
            'is_active' => false,
            'slug' => '/rules'
        ],
        [
            'name' => __('messages.auth'),
            'is_active' => false,
            'slug' => '/auth'
        ],
        [
            'name' => __('messages.register'),
            'is_active' => false,
            'slug' => '/register'
        ],
    ];
@endphp
<footer class="footer fixed-bottom bg-light">
    @include('portal.blocks.navigation.menu', ['pages' => $pages, 'class' => ' float-lg-left float-md-left'])
    <div class="float-right navbar">
        <div class="nav-item nav-link text-black-50">
            &copy News Portal - {{date('Y')}}
        </div>
    </div>
    <div class="clearfix"></div>
</footer>