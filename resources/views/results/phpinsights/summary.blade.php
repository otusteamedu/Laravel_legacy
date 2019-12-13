<div class="row">
    <div class="col-6">
        @include('results.phpinsights.summary_metric', ['name' => 'code', 'value' => $summary['code']])
        @include('results.phpinsights.summary_metric', ['name' => 'complexity', 'value' => $summary['complexity']])
        @include('results.phpinsights.summary_metric', ['name' => 'architecture', 'value' => $summary['architecture']])
        @include('results.phpinsights.summary_metric', ['name' => 'style', 'value' => $summary['style']])
    </div>
</div>
