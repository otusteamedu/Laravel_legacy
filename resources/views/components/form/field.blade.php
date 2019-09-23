<div class="field" @if(Lang::has($transKey . ".title")) title="{{ __($transKey . ".title") }}" @endif>
    <label for="{{ $name }}" class="label">
        {{ __($transKey . ".label") }}
        @if(Lang::has($transKey . ".title"))
            <span class="has-text-grey is-size-7 has-text-weight-normal">{{ __($transKey . ".title") }}</span>
        @endif
    </label>
    <div class="control">
        {{ $slot }}
    </div>
    @error($name)
    <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>
