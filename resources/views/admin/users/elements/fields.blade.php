<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('name', __('admin.users.uname')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::text('name', $name, ['class' => 'form-control']) }}
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('surname', __('admin.users.surname')) }}
    </div>
    <div class="col-sm-7">
        {{ Form::text('surname', $surname, ['class' => 'form-control']) }}
        @error('surname')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('email', __('admin.users.email')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::text('email', $name, ['class' => 'form-control']) }}
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('phone', __('admin.users.phone')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::text('phone', $phone, ['class' => 'form-control', 'role' => 'phone']) }}
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('birthday', __('admin.users.birthday')) }}
    </div>
    <div class="col-sm-3">
        {{ Form::text('birthday', $birthday, ['class' => 'form-control input-date', 'role' => 'date']) }}
        @error('birthday')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('roles_id', __('admin.users.roles')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::select('roles_id[]', $roles, $roles_id, ['multiple' => true, 'placeholder' => __('admin.choose'), 'size' => 5, 'class' => 'form-select', 'roles_id']) }}
        @error('roles_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('sex', __('admin.users.sex')) }}
    </div>
    <div class="col-sm-7">
        <div class="form-check-inline">
            {{ Form::radio('sex', null, is_null($sex), ['id' => 'sex_opt-none', 'class' => 'form-check-input']) }}
            {{ Form::label('sex_opt-none', __('admin.sex_opt.none'), ['class' => 'form-check-label']) }}
        </div>
        @foreach ($sexes as $value)
            <div class="form-check-inline">
                {{ Form::radio('sex', $value, ($sex == $value), ['id' => 'sex_opt-' . $value, 'class' => 'form-check-input']) }}
                {{ Form::label('sex_opt-'.$value, __('admin.sex_opt.' . $value), ['class' => 'form-check-label']) }}
            </div>
        @endforeach
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('poster', __('admin.photo')) }}
    </div>
    <div class="col-sm-8">
        @if(count($uploads) > 0)
            <div class="upload-block">
                <p><strong>Загруженная фотография (не сохранен)</strong></p>
                <ul class="upload-list r-block clearfix">
                    @foreach($uploads as $file)
                        <li class="item shadow">
                            <div class="image" style="background-image: url({{ $file['file_src'] }});"></div>
                            <div class="name">
                                {{ Form::text($file['field'].'_description'.$file['id'], $file['description'], ['class' => 'form-control']) }}
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox($file['field'].'_delete'.$file['id'], 'Y', false, ['id' => $file['field'].'_delete'.$file['id'], 'class' => 'form-check-input']) }}
                                {{ Form::label($file['field'].'_delete'.$file['id'], __('admin.delete'), ['class' => 'form-check-label']) }}
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="actions clearfix">
                    <button class="btn btn-primary" onclick="submitCmd(this, 'UpdateFileData')">
                        <i class="fas fa-edit"></i>
                        <span>@lang('admin.update')</span>
                    </button>
                    <button onclick="if(!confirm('@lang('admin.deleteconfirms')')) return false; submitCmd(this, 'DeleteFile')"
                       class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        <span>@lang('admin.delete')</span>
                    </button>
                </div>
            </div>
        @endif

        @if($file)
            <div class="upload-block">
                <p><strong>Текущий постер</strong></p>
                <ul class="upload-list r-block clearfix">
                    <li class="item shadow">
                        <div class="image" style="background-image: url({{ $file['file_src'] }});margin:0;"></div>
                        <!--div class="name">
                            {{ Form::text('poster_description', /*$poster['description']*/'', ['class' => 'form-control']) }}
                        </div-->
                    </li>
                </ul>
                <div class="actions clearfix">
                    <!--button class="btn btn-primary" onclick="submitCmd(this, 'UpdatePosterData')">
                        <i class="fas fa-edit"></i>
                        <span>@lang('admin.update')</span>
                    </button-->
                    <button onclick="if(!confirm('@lang('admin.deleteconfirm')')) return false; submitCmd(this, 'DeletePoster', {itemId: {{ $userId }}})" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        <span>@lang('admin.delete')</span>
                    </button>
                </div>
            </div>
        @endif

        @if (Session::has('uploadedMessage'))
            <div class="alert alert-success">
                {{ Session::get('uploadedMessage') }}
            </div>
        @endif
        @error('file')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="upload-block">
            <div class="mb-2">
                {{ Form::file('file', ['class' => 'mb-1']) }}
            </div>
            <div class="mb-2">
                {{ Form::text('file_description', null, ['class' => 'form-control']) }}
            </div>
            <button class="btn btn-success" onclick="submitCmd(this, 'UploadFile')">
                <i class="fas fa-plus"></i>
                <span>@lang('admin.create')</span>
            </button>
        </div>
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('active', __('admin.active')) }}
    </div>
    <div class="col-sm-7">
        <div class="form-check-inline">
            {{ Form::checkbox('active', null, $active, ['class' => 'form-check-input']) }}
            {{ Form::label('active', __('admin.yes'), ['class' => 'form-check-label']) }}
        </div>
    </div>
</div>
@if($userId)
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('change_token_api', __('admin.users.change_token_api')) }}
    </div>
    <div class="col-sm-7">
        <div class="form-check-inline">
            {{ Form::checkbox('change_token_api', null, $change_token_api, ['class' => 'form-check-input']) }}
            {{ Form::label('change_token_api', __('admin.yes'), ['class' => 'form-check-label']) }}
        </div>
    </div>
</div>
@endif
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('confirm_user', __('admin.users.confirm_user')) }}
    </div>
    <div class="col-sm-7">
        <div class="form-check-inline">
            {{ Form::checkbox('confirm_user', null, $confirm_user, ['class' => 'form-check-input']) }}
            {{ Form::label('confirm_user', __('admin.yes'), ['class' => 'form-check-label']) }}
        </div>
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label"></div>
    <div class="col-sm-8">
        @if($userId)
            {{ Form::submit(__('admin.users.edit'), array('class' => 'btn btn-success')) }}
            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="return false;">
                <span>@lang('admin.delete')</span>
            </button>
        @else
            {{ Form::submit(__('admin.users.create'), array('class' => 'btn btn-success')) }}
        @endif
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">@lang('admin.cancel')</a>
    </div>
</div>

