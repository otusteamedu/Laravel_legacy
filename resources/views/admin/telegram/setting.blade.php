@extends('layouts.app')

@section('app_content')
    <div class="container">
        @if(\Illuminate\Support\Facades\Session::has('status'))
            <div class="alert alert-info">
                <span>{{ \Illuminate\Support\Facades\Session::get('status') }}</span>
            </div>
        @endif
        {!! Form::open(['url' => route('admin.settings.store')]) !!}
        <h4>Url callback для TelegramBot</h4>
            {{ Form::label('value', 'web hook', ['class' => 'control-label']) }}
        <div class="form-group">
            {{ Form::url(
                'value',
                $urlCallbackBot ?? '',
                [
                    'class' => 'form-control',
                    'id' => 'url_callback_bot',
                ]
            ) }}
            {{ Form::hidden(
                'key',
                \App\Services\Settings\SettingService::URL_CALLBACK_BOT
            ) }}
        </div>
        <div class="form-group">
            @include('blocks.buttons.primary', [
            'buttonName' => 'Встаить текущий url',
            'onclick' => 'document.getElementById(\'url_callback_bot\').value = "' . url('') . '"',
            'src' => '#',
        ])
        </div>

        {{Form::submit(__('buttons.save'), ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

    </div>
<hr>
    @include('blocks.buttons.primary', [
        'buttonName' => 'Отправить web hook',
        'src' => route('admin.telegram.setwebhook'),
    ])
    @include('blocks.buttons.primary', [
        'buttonName' => 'Получить web hook info',
        'src' => route('admin.telegram.getwebhookinfo'),
    ])
@endsection
