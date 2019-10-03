<?php /** @var \App\Models\City $city */ ?>
<tr>
    <th scope="row">{{ $city->id }}</th>
    <th>{{ $city->name }}</th>
    <th>{{ $city->country->name }}</th>
    <th>{{ $city->companies->count() }}</th>
    <th>{{ $city->products->count() }}</th>
    <td>@date($city['created_at'])</td>
</tr>