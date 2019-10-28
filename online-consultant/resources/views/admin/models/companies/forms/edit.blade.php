@php /** @var \App\Models\Company $company */ @endphp
{{ Form::model($company, ['route' => ['admin.companies.update', $company], 'class' => 'form-model', 'method' => 'PUT']) }}
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.companies.fields.created_user')  }}: {{ $company->createdUser->name_link }}</p>
        </div>
    </div>
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
            {{ Form::submit(__('admin.models.controls.save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
