@php
$contacts = [
  [
    'city'=>'Челябинск',
    'address'=>'454091, г. Челябинск, ул. Свободы, д. 32',
    'phone'=>'8 (804) 333-68-99'
  ],
  [
    'city'=>'Уфа',
    'address'=>'450005, г.Уфа, ул. Революционная, д. 96/4',
    'phone'=>'8 (804) 333-68-99'
  ],
  [
    'city'=>'Пермь',
    'address'=>'614022, г. Пермь, ул. Стахановская, д. 45',
    'phone'=>'8 (804) 333-68-99'
  ],
];
@endphp
<div class="col-12 col-md-6 mt-4 mt-md-0">
<h3>Наши филиалы в городах:</h3>
<div class="row">
@foreach ($contacts as $contact)
<div class="col-12 mb-4">
    <p class="mb-2"><b>{{ $contact['city'] }}</b></p>
  <div>
    <span>{{ $contact['address'] }}</span>
  </div>
  <div>
    <span>Тел.: {{ $contact['phone'] }}</span>
  </div>
</div>
@endforeach
</div>
</div>