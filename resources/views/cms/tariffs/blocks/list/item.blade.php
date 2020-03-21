<?php /** @var \App\Models\Tariff $tariff */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.tariffs.show', ['tariff' => $tariff->id]), $tariff->id) }}</th>
    <th>{{ link_to(route('cms.tariffs.show', ['tariff' => $tariff->id]), $tariff->name) }}</th>
    <td>{{ link_to(route('cms.tariffs.show', ['tariff' => $tariff->id]), $tariff->condition) }}</td>
</tr>
