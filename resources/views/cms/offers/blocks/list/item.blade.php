<?php /** @var \App\Models\Offer $offer */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->id) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->name) }}</th>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->description) }}</td>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->expiration_date) }}</td>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $projectName = App\Models\Project::find(1)->name) }}</td>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $cityName = App\Models\City::find(1)->name) }}</td>
</tr>
