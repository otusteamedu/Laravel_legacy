@php($currentPage = $currentPage ?? 'overview')
<div class="nav flex-column nav-pills sidebar collapse navbar-collapse" id="navbarLeft" role="tablist" aria-orientation="vertical">
    <button type="button" class="close pull-right" data-toggle="collapse" data-target="#navbarLeft">
        <span aria-hidden="true">&times;</span>
    </button>
    @include('blocks.navbar.blocks.left_item', ['page' => 'overview'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'tasks'])

    @can('project.viewAny')
    @include('blocks.navbar.blocks.left_item', ['page' => 'projects'])
    @endcan

    @can('client.viewAny')
    @include('blocks.navbar.blocks.left_item', ['page' => 'clients'])
    @endcan

    @can('staff.viewAny')
    @include('blocks.navbar.blocks.left_item', ['page' => 'staffs'])
    @endcan

    @include('blocks.navbar.blocks.left_item', ['page' => 'stat'])
    @include('blocks.navbar.blocks.left_item', ['page' => 'support'])
</div>

