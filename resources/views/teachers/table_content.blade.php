@php/** @var \App\Models\User $item */@endphp
@php/** @var \App\Services\Groups\GroupService $groupService */@endphp
@php/** @var \App\Services\Courses\CourseService $courseService */@endphp

<thead>
<tr>
    @foreach($content['titles'] as $title)
        <th>{{$title}}</th>
    @endforeach
</tr>
</thead>
<tbody>
@foreach($content['items'] as $item)
    <tr>
        <td><a href="{{ route('teachers.show', $item->id) }}">{{ $item->full_name }}</a></td>
        <td><a href="{{ route('teachers.show', $item->id) }}">{{ $item->email }}</a></td>
        @php/** @var \App\Services\Subjects\SubjectService $subjectService */@endphp
        <td>
            @foreach($subjectService->wrapGroupsByHref($item->subjects) as $subject)
            {!! $subject !!}<br>
            @endforeach
        </td>
        @php/** @var \App\Services\EducationPlans\EducationPlanService $educationPlanService */@endphp
        <td>{{ $educationPlanService->getHoursForEducationPlans($item->educationPlans) }}</td>
    </tr>
@endforeach
</tbody>
