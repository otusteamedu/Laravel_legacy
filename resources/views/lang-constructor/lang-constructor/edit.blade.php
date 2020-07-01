@extends('app')

@section('content')
    <div class="page-header">
        <h3 class="page-title">{{__('lang-constructor.title')}}</h3>
        @include('partials.system.breadcrumb')
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('partials.system.status')
                    <h4 class="card-title">{{__('lang-constructor.title')}}</h4>
                    <p class="card-description">{{__('lang-constructor.description')}}</p>
                    {!! Form::open(['url' => route('lang-constructor-save',['locale' => $locale]),'class'=>'pt-3']) !!}

                    @include('partials.form.text', [
                         "label"=> __('form.name'),
                         "name"=> "name",
                         "value"=> $langConstructor->name,
                         "placeholder"=>  __('form.name-placeholder'),
                    ])

                    @include('partials.form.text', [
                         "label"=> __('form.code'),
                         "name"=> "code",
                         "value"=> $langConstructor->code,
                         "placeholder"=> __('form.code-placeholder'),
                    ])

                    @include('partials.form.number', [
                         "label"=> __('lang-constructor.form-hard'),
                         "name"=> "hard",
                         "value"=> $langConstructor->code,
                         "placeholder"=> __('lang-constructor.form-hard-placeholder'),
                    ])

                    @include('partials.form.select', [
                         "label"=> __('lang-constructor.constructor-type'),
                         "name"=> "type_code",
                         "value"=> $langConstructor->type_code,
                         "option"=> $langConstructorTypes,
                         "placeholder"=> __('lang-constructor.constructor-type-placeholder'),
                    ])

                    @include('partials.form.textarea', [
                         "label"=> __('form.description'),
                         "name"=> "description",
                         "value"=> $langConstructor->description,
                         "placeholder"=> __('form.description-placeholder'),
                    ])

                    {!! Form::submit(__('form.send'),['class'=>'btn btn-gradient-primary float-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
