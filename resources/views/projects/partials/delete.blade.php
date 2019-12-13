<a class="nav-link delete-link" href="{{ route('projects.destroy', $project) }}"
   onclick="
       event.preventDefault();
       confirm('@lang('projects.delete_confirmation')')
       ? document.getElementById('delete-form').submit()
       : false;"
>
    @lang('projects.delete')
</a>

<form id="delete-form" action="{{ route('projects.destroy', $project) }}" method="POST"
      style="display: none;">
    @csrf
    @method('DELETE')
</form>
