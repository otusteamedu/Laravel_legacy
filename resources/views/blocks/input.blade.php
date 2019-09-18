<input id="{{ $field }}"
       type="text"
       class="input @error($field) is-danger @enderror"
       name="{{ $field }}"
       value="{{ $value }}"
       @isset($required)
       required
       @endisset
       autocomplete="off"
>
