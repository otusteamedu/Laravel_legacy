<div class="d-flex align-items-center">
    <h1 class="title">{{ $project->url }}</h1>
    <div class="pl-5">
        <a href="{{ route('projects.index') }}">@lang('projects.back')</a>
    </div>
</div>

@if($project->href)
    <div class="row">
        <div class="col-12">
            <a href="{{ $project->href }}" target="_blank">{{ $project->href }} <i class="fa fa-external-link-alt"></i>
            </a>
        </div>
    </div>
@endif
