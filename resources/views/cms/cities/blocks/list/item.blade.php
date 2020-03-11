<?php /** @var \App\Models\City $city */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.cities.show', ['city' => $city->id]), $city->id) }}</th>
    <th>{{ link_to(route('cms.cities.show', ['city' => $city->id]), $city->name) }}</th>
    <td>{{ link_to(route('cms.cities.show', ['city' => $city->id]), $city->country_id) }}</td>
</tr>
