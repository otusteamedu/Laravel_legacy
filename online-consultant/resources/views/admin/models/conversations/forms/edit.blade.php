@php /** @var \App\Models\Conversation $conversation */ @endphp
{{ Form::model($conversation, ['route' => ['admin.conversations.update', $conversation], 'class' => 'form-model', 'method' => 'PUT']) }}
    @php //TODO add @csrf @endphp
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.companies.model.single_name')  }}: {{ $conversation->company_name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.widgets.model.single_name')  }}: {{ $conversation->widget_domain_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.users.model.single_name')  }}: {{ $conversation->manager_name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <p>{{ __('admin.leads.model.single_name')  }}: {{ $conversation->lead_name_link }}</p>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('text', __('Text')) }}
            {{ Form::textarea('text', null, ['class' => 'form-control' . ( $errors->has('text') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'text'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('admin.models.controls.save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
