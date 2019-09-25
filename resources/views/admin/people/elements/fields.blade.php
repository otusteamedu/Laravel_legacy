<div class="form-group row align-items-center">
    <div class="col-sm-3 col-form-label">
        {{ Form::label('name', __('admin.name')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-4">
        {{ Form::text('name', $dataItem ? $dataItem->name : null, ['class' => 'form-control']) }}
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-3 col-form-label">
        {{ Form::label('description', __('admin.description')) }}
    </div>
    <div class="col-sm-4">
        {{ Form::textarea('description', $dataItem ? $dataItem->description : null, ['class' => 'form-control', 'rows' => 5]) }}
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-3 col-form-label">
        {{ Form::label('photo', __('admin.photo')) }}
    </div>
    <div class="col-sm-4">
        <div class="">
            {{ Form::file('photo', ['class' => 'mb-1']) }}
        </div>
        @if($dataItem && $dataItem->photo)
            <img src="{{ env('UPLOAD_HTTP') }}{{ $dataItem->photo->getPath() }}" width="100" class="mb-1" alt="" />
            <div class="form-check">
                {{ Form::checkbox('photo_delete', $dataItem->photo->id, false, ['id' => 'photo_delete', 'class' => 'form-check-input']) }}
                {{ Form::label('photo_delete', __('admin.delete'), ['class' => 'form-check-label']) }}
            </div>
        @endif
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-3 col-form-label">
        {{ Form::label('birth_day', __('admin.birthday')) }}
    </div>
    <div class="col-sm-4">
        {{ Form::date('birth_day', $dataItem ? $dataItem->birth_day : null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-3 col-form-label">
        {{ Form::label('birth_day', __('admin.sex')) }}
    </div>
    <div class="col-sm-4">
        <div class="form-check">
            {{ Form::radio('sex', null, !$dataItem || !$dataItem->sex, ['id' => 'sex-none', 'class' => 'form-check-input']) }}
            {{ Form::label('sex-none', __('admin.sex_opt.none'), ['class' => 'form-check-label']) }}
        </div>
        <div class="form-check">
            {{ Form::radio('sex', 'male', ($dataItem && $dataItem->sex == 'male'), ['id' => 'sex-male', 'class' => 'form-check-input']) }}
            {{ Form::label('sex-male', __('admin.sex_opt.male'), ['class' => 'form-check-label']) }}
        </div>
        <div class="form-check">
            {{ Form::radio('sex', 'female', ($dataItem && $dataItem->sex == 'female'), ['id' => 'sex-female', 'class' => 'form-check-input']) }}
            {{ Form::label('sex-female', __('admin.sex_opt.female'), ['class' => 'form-check-label']) }}
        </div>
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-3 col-form-label"></div>
    <div class="col-sm-4">
        @if($dataItem)
            {{ Form::submit(__('admin.people.edit'), array('class' => 'btn btn-secondary')) }}
        @else
            {{ Form::submit(__('admin.people.create'), array('class' => 'btn btn-success')) }}
        @endif
        <a href="{{ route('admin.people.index') }}" class="btn btn-danger">@lang('admin.cancel')</a>
    </div>
</div>
