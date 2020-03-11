<?php /** @var \App\Models\Segment $segment */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.segments.show', ['segment' => $segment->id]), $segment->id) }}</th>
    <th>{{ link_to(route('cms.segments.show', ['segment' => $segment->id]), $segment->name) }}</th>
    <td>{{ link_to(route('cms.segments.show', ['segment' => $segment->id]), $segment->condition) }}</td>
</tr>
