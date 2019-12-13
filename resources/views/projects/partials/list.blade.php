<ul class="list-unstyled">
@foreach($projects as $project)
    <li style="font-size: larger" class="mt-2">
        <a href="{{ route('projects.show', $project) }}">
            {{ $project->git }}
        </a>
    </li>
@endforeach
</ul>
