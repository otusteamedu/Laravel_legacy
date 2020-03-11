<?php /** @var \App\Models\Country $country */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.countries.show', ['country' => $country->id]), $country->id) }}</th>
    <th>{{ link_to(route('cms.countries.show', ['country' => $country->id]), $country->name) }}</th>
    <td>{{ link_to(route('cms.countries.show', ['country' => $country->id]), $country->continent_name) }}</td>
</tr>
