<table class="table table-striped">
    @include('blocks.list.table_headers',[
        'headers' => $headers,
        'links' => $links,
    ])
    @include('blocks.list.table_body',[
        'headers' => $headers,
        'items' => $items,
        'links' => $links,
    ])
</table>

    {{ $items->links() }}