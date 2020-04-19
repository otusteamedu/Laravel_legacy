@php
    $users = \App\Models\User::all();

    if (isset($project)){
        $name = $project->name;
        $description = $project->description;
        $contact_data = $project->contact_data;
    }else{
        $name = '';
        $description = '';
        $contact_data = '';
    }
@endphp

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('user_id', 'Владелец проекта (магазина)') }}
            {{ Form::select('user_id', $users->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Наименование') }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('description', 'Описание') }}
            {{ Form::textarea('description', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('contact_data', 'Контактные данные') }}
            {{ Form::textarea('contact_data', null, array('class'=>'form-control')) }}
        </div>
    </div>
</div>
