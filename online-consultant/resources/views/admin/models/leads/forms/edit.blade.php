@php /** @var \App\Models\Lead $lead */ @endphp
{{ Form::model($lead, ['route' => ['admin.leads.update', $lead], 'class' => 'form-model', 'method' => 'PUT']) }}
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.leads.fields.created_user')  }}: {{ $lead->createdUser->name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.companies.model.single_name')  }}: {{ $lead->company_name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('name', __('Name')) }}
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
            {{ Form::submit(__('admin.models.controls.save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}