@if($opts['choose_match'])
    <div class="input-field">
        <input type="text" name="{{ $prefix }}{{ $name }}[text]" title="{{ $title }}"
               id="{{ $prefix }}{{ $name }}" value="{{ $value['text'] }}" class="input-text" />
    </div>
    <div class="right-cb">
        <input type="hidden" name="{{ $prefix }}{{ $name }}[exact]" value="0" />
        <input type="checkbox" name="{{ $prefix }}{{ $name }}[exact]" title="@lang('admin.filter.match_exact')"
               value="1" @if($value['exact']) checked="checked" @endif />
    </div>
@else
    <div class="input-field">
        <input name="{{ $prefix }}{{ $name }}" title="{{ $title }}"
               id="{{ $prefix }}{{ $name }}" value="{{ $value }}" class="input-text" />
    </div>
@endif

