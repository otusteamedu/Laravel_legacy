<div class="field">
    <label for="{{ $field }}" class="label">@lang($text)</label>

    <div class="control">
        {{ $slot }}
    </div>
    @error($field)
    <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>
