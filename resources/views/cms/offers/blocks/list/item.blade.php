<?php /** @var \App\Models\Offer $offer */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->id) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->name) }}</th>
    <td>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->description) }}</td>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->teaser_image) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->expiration_date) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->project_id) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->city_id) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->lat) }}</th>
    <th>{{ link_to(route('cms.offers.show', ['offer' => $offer->id]), $offer->lon) }}</th>
</tr>
