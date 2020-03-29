<?php /** @var \App\Models\Project $project */ ?>
<tr>
    <th scope="row">{{ link_to(route('cms.projects.show', ['project' => $project->id]), $project->id) }}</th>
    <th>{{ link_to(route('cms.projects.show', ['project' => $project->id]), $project->name) }}</th>
    <td>{{ link_to(route('cms.projects.show', ['project' => $project->id]), $project->description) }}</td>
    <td>{{ link_to(route('cms.projects.show', ['project' => $project->id]), $project->contact_data) }}</td>
</tr>
