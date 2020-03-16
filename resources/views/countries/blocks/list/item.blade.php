<?php /** @var \App\Models\Country $country */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.countries.show', ['country' => $country['id'], 'locale' => $locale]), $country['id']) }}</th>
    <th>{{ link_to(route('cms.countries.show', ['country' => $country->id, 'locale' => $locale]), $country['name']) }}</th>
    <td>{{ $country->cities->count() }}</td>
    <td>@date($country['created_at'])</td>
</tr>
