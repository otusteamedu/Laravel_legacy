<form>
    <div class="form-group">
        <label for="name">{{ __('forms.business.add.name') }}</label>
        <input type="text" class="form-control" id="name">
    </div>

    <div class="form-group">
        <label for="type_id">{{ __('forms.business.add.type_id') }}</label>
        <select class="form-control" name="type_id">
            @foreach($businessTypes as $type)
                <option value="{{ $type->id }}"
                    {{ $business->type_id == $type->id ? "selected" : "" }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group text-right py-4">
        <button type="submit" class="btn btn-primary">{{ __('buttons.business.add') }}</button>
    </div>
</form>
