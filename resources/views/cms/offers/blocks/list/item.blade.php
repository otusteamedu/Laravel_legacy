<?php /** @var \App\Models\Offer $offer */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->id) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->name) }}</th>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->description) }}</td>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->expiration_date) }}</td>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), App\Models\Project::find($offer->project_id)->name) }}</td>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), App\Models\City::find($offer->city_id)->name) }}</td>
</tr>
