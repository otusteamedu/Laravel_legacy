<?php
    /** @var \App\Models\Post\Rubric $rubric */
?>
<tr>
    <th scope="row">{{ $rubric->id }}</th>
    <td>{{ link_to(route('cms.rubrics.show', ['rubric' => $rubric->id, 'locale' => \App::getLocale()]), $rubric->name) }}</td>
    <td style="width: 10%">{{ $rubric->slug }}</td>
    <td>{{$rubric->created_at->format('d.m.Y H:m:i')}}</td>
</tr>