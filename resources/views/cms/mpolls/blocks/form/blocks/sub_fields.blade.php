<div id="quota_list">
    @if($mpoll->quotas ?? false)
        @foreach ($mpoll->quotas as $quota)
            @include('cms.mpolls.blocks.form.blocks.sub_fields_item',['quota' => $quota, 'quotas' => $quotas])
        @endforeach
    @endif
</div>
