@extends('admin.layouts.admin')
@section('content')
    <h1>
        {{$grammar->name}}
    </h1>
    @if(!empty($message))
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
    @endif
    @if(!empty($error))
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endif

    @cannot(App\Policies\Abilities::UPDATE, $grammar)
        <div class="alert alert-warning" role="alert">
            Просмотр
        </div>
    @endcan
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <hr>
    {!!
        Form::model($grammar,['method'=>'PUT', 'url' => route('admin.grammar.update',
            ['grammar'=>($grammar->id)])
        ])
    !!}
    {{ Form::token()}}

    <div class="row form-group">
        {{ Form::label('id', 'ID',['class'=>'col-lg-2']) }}
        {{ Form::text('id', $grammar->id,[
            'class'=>'form-control col-lg-10',
            'id'=>'id',
            'readonly'=> 'true'
        ] ) }}
    </div>
    <div class="row form-group">
        {{Form::label('name', 'Название',['class'=>'col-lg-2'])}}
        {!!  Form::text('name',$grammar->name,[
            'class'=>'form-control col-lg-10',
            'id'=>'name'
        ])!!}
    </div>

    <div class="row form-group">
        {{Form::label('code', 'code',['class'=>'col-lg-2'])}}
        {{Form::text('code',$grammar->code,[
            'class'=>'form-control col-lg-10',
            'id'=>'code'
        ])}}
    </div>
    <hr>
    <div class="row form-group">
        {{Form::label( 'grammar_text','Грамматика',['class'=>'font-weight-bold col-lg-2'])}}
        {{Form::textarea    ('grammar_text',$grammar->grammar_text,[
            'class'=>'form-control editor col-lg-10',
            'id'=>'grammar_text'
        ])}}
    </div>
    <div class="row form-group">
        {{Form::label('arabic_text', 'Арабский текст',['class'=>'font-weight-bold col-lg-2'])}}
        {{Form::textarea    ('arabic_text',$grammar->arabic_text,[
            'class'=>'form-control arabic_editor col-lg-10',
            'id'=>'arabic_text'
        ])}}
    </div>
    <hr>
    <h3>SEO</h3>
    <div class="row form-group">
        {{Form::label('title', 'Title',['class'=>'col-lg-2'])}}
        {{Form::text('title',$grammar->title,[
            'class'=>'form-control col-lg-10',
            'id'=>'title'
        ])}}
    </div>
    <div class="row form-group">
        {{Form::label('meta_keywords', 'meta_keywords',['class'=>'col-lg-2'])}}
        {{Form::text('meta_keywords',$grammar->meta_keywords,[
            'class'=>'form-control col-lg-10',
            'id'=>'meta_keywords'
        ])}}
    </div>
    <div class="row form-group">
        {{Form::label('meta_description', 'meta_description',['class'=>'col-lg-2'])}}
        {{Form::text('meta_description',$grammar->meta_description,[
            'class'=>'form-control col-lg-10',
            'id'=>'meta_description'
        ])}}
    </div>



    @can(App\Policies\Abilities::UPDATE, $grammar)
        {{Form::submit('Сохранить',[
    'class'=>'btn btn-primary',
                'name'=>'save'])}}
    @endcan
    {!! Form::close() !!}

    <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.editor'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('.arabic_editor'))
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection
