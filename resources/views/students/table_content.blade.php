@php/** @var \App\Models\Student $item */@endphp
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
        <td><a href="{{ route('students.show', $item->id) }}">{{ $item->user->full_name }}</a></td>
        <td><a href="{{ route('students.show', $item->id) }}">{{ $item->id_number }}</a></td>
        @php
            $groupRows = $groupService->wrapGroupsByHref($item->groups);
        @endphp
        <td>{!! $groupRows->join(', ') !!}</td>
        @php
            $courses = $groupService->getCoursesFromGroupCollection($item->groups);
            $courseRows = $courseService->wrapCoursesByHref($courses);
        @endphp
        <td>{!! $courseRows->join(', ') !!}</td>
    </tr>
@endforeach
</tbody>
