{{ Form::open(['route' => 'admin.companies.store', 'class' => 'form-model']) }}
    <div class="form-row">
        <div class="col">
            {{ Form::label('name', __('admin.companies.fields.name')) }}
            {{ Form::text('name', null, ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'name'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('email', __('E-Mail')) }}
            {{ Form::email('email', null, ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'email'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('url', __('Url')) }}
            {{ Form::text('url', null, ['class' => 'form-control' . ( $errors->has('url') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'url'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            @php /** @var \App\Models\User $currentUser */ @endphp
            {{ Form::hidden('created_user_id', $currentUser->id) }}
            {{ Form::submit(__('admin.models.controls.save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
