<footer class="footer fixed-bottom bg-light">
    @include('portal.blocks.navigation.menu', [
        'items' => $pageMenu->roots(),
        'class' => 'navbar float-lg-left float-md-left'
    ])
    <div class="float-right navbar">
        <div class="nav-item nav-link text-black-50">
            &copy News Portal - {{date('Y')}}
        </div>
    </div>
    <div class="clearfix"></div>
</footer>