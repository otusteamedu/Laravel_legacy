<div class="uk-inline uk-margin uk-margin-medium-top uk-width-1-1">
    <div class="tm-form__buttons">
        {{ Form::submit($submit_name, ['class' => "uk-button uk-button-primary uk-button-large"]) }}
        <div class="tm-login__socials tm-socials tm-socials-large tm-socials-color">
            @include('blocks.link.social_button', ['url' => 'https://google.com', 'icon' => 'google'])
            @include('blocks.link.social_button', ['url' => 'https://facebook.com', 'icon' => 'facebook'])
            @include('blocks.link.social_button', ['url' => 'https://vk.com', 'icon' => 'vk'])
            @include('blocks.link.social_button', ['url' => 'https://yandex.com', 'icon' => 'yandex'])
        </div>
    </div>
</div>
