@php /** @var \App\Models\Widget $widget */ @endphp
{{ Form::model($widget, ['route' => ['admin.widgets.update', $widget], 'class' => 'form-model', 'method' => 'PUT']) }}
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.companies.model.single_name')  }}: {{ $widget->company_name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('domain', __('Domain')) }}
            {{ Form::text('domain', null, ['class' => 'form-control' . ( $errors->has('domain') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'domain'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('Save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
