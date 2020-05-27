@php($currentPage = $currentPage ?? 'overview')
<div class="nav flex-column nav-pills sidebar collapse navbar-collapse" id="navbarLeft" role="tablist" aria-orientation="vertical">
    <button type="button" class="close pull-right" data-toggle="collapse" data-target="#navbarLeft">
        <span aria-hidden="true">&times;</span>
    </button>
    @include('blocks.navbar.blocks.left_item', ['page' => 'overview'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'tasks'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'projects'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'clients'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'staffs'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'stat'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'support'])
</div>

