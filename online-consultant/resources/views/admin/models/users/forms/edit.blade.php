@php /** @var \App\Models\User $user */ @endphp
{{ Form::model($user, ['route' => ['admin.users.update', $user], 'class' => 'form-model', 'method' => 'PUT']) }}
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.companies.model.single_name')  }}: {{ $user->company_name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('name', __('Name')) }}
            {{ Form::text('name', null, ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'name'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('email', __('E-Mail')) }}
            {{ Form::email('email', null, ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'email'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('Save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
