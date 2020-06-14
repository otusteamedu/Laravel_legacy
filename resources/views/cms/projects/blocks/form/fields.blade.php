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
            {{ Form::label('address1', 'Адрес 1') }}
            {{ Form::text('address1', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('instagram', 'instagram') }}
            {{ Form::text('instagram', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('address2', 'Адрес 2') }}
            {{ Form::text('address2', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('vk', 'ВКонтакте') }}
            {{ Form::text('vk', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('address3', 'Адрес 3') }}
            {{ Form::text('address3', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('website', 'Сайт') }}
            {{ Form::text('website', null, array('class'=>'form-control')) }}
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
    <div class="form-group">
        {{ Form::label('logo_path', 'Логотип компании') }}
        {{ Form::file('logo_path', null, array('class'=>'form-control-file')) }}
    </div>
</div>
