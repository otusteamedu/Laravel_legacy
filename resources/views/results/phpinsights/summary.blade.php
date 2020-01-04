<div class="row">
    <div class="col-6">
        <h5><strong>PHP Insights</strong></h5>
        <p class="text-black-50">@lang('phpinsights.note')</p>
        @include('results.phpinsights.summary_metric', ['name' => 'code', 'value' => $code])
        @include('results.phpinsights.summary_metric', ['name' => 'complexity', 'value' => $complexity])
        @include('results.phpinsights.summary_metric', ['name' => 'architecture', 'value' => $architecture])
        @include('results.phpinsights.summary_metric', ['name' => 'style', 'value' => $style])
    </div>
</div>
