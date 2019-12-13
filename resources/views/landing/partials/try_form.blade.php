{!! Form::open()->route('landing.try')->autocomplete('off') !!}
@csrf
{!! Form::text('repository', trans('landing.try_respository'))->placeholder('https://github.com/your/repository')->required()->value($repository ?? '') !!}
{!! Form::submit(trans('landing.submit'))->attrs(['data-disable-with' => trans('landing.submit_in_progress'), 'dusk' => 'analyze-button']) !!}
{!! Form::close() !!}
