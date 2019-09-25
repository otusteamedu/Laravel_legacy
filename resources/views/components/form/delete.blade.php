<a class="button is-outlined button-delete is-small" style="margin-bottom: 40px"
   href="{{ $url }}"
   onclick="
       event.preventDefault();
       confirm('{{ $confirmation }}')
       ? document.getElementById('delete-form').submit()
       : false;"
>
    {{ $text }}
</a>

<form id="delete-form" action="{{ $url }}" method="POST"
      style="display: none;">
    @csrf
    @method('DELETE')
</form>
