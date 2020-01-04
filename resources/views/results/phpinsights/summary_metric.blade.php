<div class="{{ \App\Helpers\ViewHelpers::phpInsightsCssClass($value) }}" role="alert" style="width: {{ $value }}%">
    @lang('phpinsights.' . $name): <strong>{{ round($value) }}%</strong>
</div>
