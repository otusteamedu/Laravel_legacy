<?php /** @var \App\Models\Country $country */ ?>
<tr>
    <th scope="row">{{ link_to(App\Helpers\RouteBuilder::localeRoute('cms.countries.show', ['country' => $country['id']]), $country['id']) }}</th>
    <th>{{ link_to(App\Helpers\RouteBuilder::localeRoute('cms.countries.show', ['country' => $country->id]), $country['name']) }}</th>
    <td>{{ $country->cities->count() }}</td>
    <td>@date($country['created_at'])</td>
</tr>