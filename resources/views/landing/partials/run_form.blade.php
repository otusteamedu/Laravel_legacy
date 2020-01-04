{!! Form::open()->route('landing.run')->autocomplete('off')->attrs(['']) !!}
@csrf
{!! Form::text('url', trans('landing.run_url'))->placeholder('https://github.com/your/repository')->required()->value($url ?? '') !!}
<div style="margin-top: -15px" class="mb-2">@lang('landing.examples'):
    @include('landing.partials.example_link', ['url' => 'https://github.com/phptrack/phptrack.io'])
    @include('landing.partials.example_link', ['url' => 'https://github.com/laravel/laravel'])
</div>
{!! Form::submit(trans('landing.submit'))->attrs(['data-disable-with' => trans('landing.submit_in_progress'), 'dusk' => 'analyze-button']) !!}
{!! Form::close() !!}
