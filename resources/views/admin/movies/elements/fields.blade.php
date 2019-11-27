<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('name', __('admin.name')) }} <span class="i-req">*</span>
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
        {{ Form::label('premiere', __('admin.movies.premiere')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-3">
        {{ Form::text('premiereDate', $premiere, ['class' => 'form-control input-date', 'role' => 'date']) }}
        @error('premiere')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('slogan', __('admin.movies.slogan')) }}
    </div>
    <div class="col-sm-7">
        {{ Form::textarea('slogan', $slogan, ['class' => 'form-control', 'rows' => 2]) }}
        @error('slogan')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('description', __('admin.description')) }}
    </div>
    <div class="col-sm-7">
        {{ Form::textarea('description', $description, ['class' => 'form-control', 'rows' => 5]) }}
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('duration', __('admin.movies.duration')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-2">
        {{ Form::text('duration', $duration, ['class' => 'form-control', 'size' => 5]) }}
        @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('agelimit', __('admin.movies.agelimit')) }}
    </div>
    <div class="col-sm-7">
        <div class="form-check-inline">
            {{ Form::radio('age_limit', null, is_null($age_limit), ['id' => 'age_limit_opt-none', 'class' => 'form-check-input']) }}
            {{ Form::label('age_limit-none', __('admin.age_limit_opt.none'), ['class' => 'form-check-label']) }}
        </div>
        @foreach ($age_limits as $value)
            <div class="form-check-inline">
                {{ Form::radio('age_limit', $value, ($age_limit == $value), ['id' => 'admin.age_limit_opt.' . $value, 'class' => 'form-check-input']) }}
                {{ Form::label('age_limit-'.$value, __('admin.age_limit_opt.' . $value), ['class' => 'form-check-label']) }}
            </div>
        @endforeach
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('producer_id', __('admin.movies.producer')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::select('producer_id', $producers, $producer_id, ['placeholder' => __('admin.choose'), 'class' => 'form-select']) }}
        @error('producer_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('poster', __('admin.poster')) }}
    </div>
    <div class="col-sm-8">
        @if(count($uploads) > 0)
            <div class="upload-block">
                <p><strong>Загруженный постер (не сохранен)</strong></p>
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

        @if($poster)
            <div class="upload-block">
                <p><strong>Текущий постер</strong></p>
                <ul class="upload-list r-block clearfix">
                    <li class="item shadow">
                        <div class="image" style="background-image: url({{ $poster['file_src'] }});margin:0;"></div>
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
                    <button onclick="if(!confirm('@lang('admin.deleteconfirm')')) return false; submitCmd(this, 'DeletePoster', {itemId: {{ $movieId }}})" class="btn btn-danger">
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
        @error('poster')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="upload-block">
            <div class="mb-2">
                {{ Form::file('poster', ['class' => 'mb-1']) }}
            </div>
            <div class="mb-2">
                {{ Form::text('poster_description', null, ['class' => 'form-control']) }}
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
        {{ Form::label('trailer_link', __('admin.movies.trailer_link')) }} <span class="i-req">*</span> <br />
        <small>@lang('admin.movies.trailer_link_desc')</small>
    </div>
    <div class="col-sm-7">
        {{ Form::text('trailer_link', $trailer_link, ['class' => 'form-control']) }}
        @error('trailer_link')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('actors_id', __('admin.movies.actors')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::select('actors_id[]', $actors, $actors_id, ['multiple' => true, 'class' => 'form-select', 'size' => 10, 'id' => 'actors_id']) }}
        @error('actors_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('countries_id', __('admin.movies.countries')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::select('countries_id[]', $countries, $countries_id, ['multiple' => true, 'class' => 'form-select', 'size' => 5, 'id' => 'countries_id']) }}
        @error('countries_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('genres_id', __('admin.movies.genres')) }} <span class="i-req">*</span>
    </div>
    <div class="col-sm-7">
        {{ Form::select('genres_id[]', $genres, $genres_id, ['multiple' => true, 'class' => 'form-select', 'size' => 5, 'id' => 'genres_id']) }}
        @error('genres_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label"></div>
    <div class="col-sm-8">
        @if($movieId)
            {{ Form::submit(__('admin.movies.edit'), array('class' => 'btn btn-success')) }}
            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                    onclick="return false;">
                <span>@lang('admin.delete')</span>
            </button>
        @else
            {{ Form::submit(__('admin.movies.create'), array('class' => 'btn btn-success')) }}
        @endif
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">@lang('admin.cancel')</a>
    </div>
</div>

