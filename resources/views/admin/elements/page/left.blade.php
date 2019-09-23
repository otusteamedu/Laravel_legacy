@php
    $menuData = [
        [
            'href' => '#',
            'text' => __('admin.menu.movies.index'),
            'icon' => 'film',
            'items' => [
                [
                    'href' => route('admin.people.index'),
                    'text' => __('admin.menu.movies.people'),
                    'icon' => 'user-friends'
                ], [
                    'href' => route('admin.genres.index'),
                    'text' => __('admin.menu.movies.genres'),
                    'icon' => 'hamburger'
                ], [
                    'href' => route('admin.countries.index'),
                    'text' => __('admin.menu.movies.countries'),
                    'icon' => 'flag'
                ], [
                    'href' => '#',
                    'text' => __('admin.menu.movies.movies'),
                    'icon' => 'video'
                ]
            ]
        ]
    ];

    if(!function_exists('setMenuActive')) {
        function setMenuActive(&$menuArray) {
            $bChildActive = false;
            foreach($menuArray as &$item) {
                if(array_key_exists('items', $item))
                    $item['active'] = setMenuActive($item['items']);
                else
                    $item['active'] = false;

                if($item['active'])
                    $bChildActive = true;
            }

            return $bChildActive;
        }
    }

    setMenuActive($menuData);
@endphp

<nav class="col-md-3 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        @include('admin.elements.menu', ['menu' => $menuData, 'depth' => 0])
    </div>
</nav>
