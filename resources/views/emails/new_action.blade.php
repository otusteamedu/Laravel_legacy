@component('mail::message')

<p>{{ $user->name }},</p>
<p>у нас для Вас новая акция !</p>
<br/>
@component('mail::panel')
  Купите 2 кг фруктов до 1 апреля и получите 3й кг в подарок!
@endcomponent


@component('mail::button', ['url' => 'juicy-fruits.ru', 'color' => 'success'])
  Перейти в магазин
@endcomponent

Мы Вас любим,<br>
{{ config('shop.default_source') }}
@endcomponent
