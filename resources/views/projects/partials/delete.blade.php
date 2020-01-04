<form id="delete-form" action="{{ route('projects.destroy', $project) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-outline-danger" href="{{ route('projects.destroy', $project) }}"
            onclick="
                event.preventDefault();
                confirm('@lang('projects.delete_confirmation')')
                ? document.getElementById('delete-form').submit()
                : false;"
    >
        @lang('projects.delete')
    </button>
</form>
