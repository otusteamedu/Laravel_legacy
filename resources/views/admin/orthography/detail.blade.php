@extends('admin.layouts.admin')
@section('content')
    <h1>
        Страница Орфография
    </h1>

    <hr>


    {!! Form::model($detail,['method'=>'PUT', 'url' => route('admin.orthography.update',
            ['orthography'=>($detail->id)])
        ])!!}
    {{ Form::token()}}

    <div class="row form-group">
        {{ Form::label('id', 'ID',['class'=>'col-lg-2']) }}
        {{ Form::text('id', $detail->id,[
            'class'=>'form-control col-lg-10',
            'id'=>'id',
            'readonly'=> 'true'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('name', 'Название',['class'=>'col-lg-2']) }}
        {{ Form::text('name', $detail->name,[
            'class'=>'form-control col-lg-10',
            'id'=>'name'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('code', 'Код',['class'=>'col-lg-2']) }}
        {{ Form::text('code', $detail->code,[
            'class'=>'form-control col-lg-10',
            'id'=>'code'
        ] ) }}
    </div>



    <h1>Буквы</h1>
    <div class="row form-group">
        {{ Form::label('harf_name', 'Название',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_name', $detail->harf_name,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_name'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_free', 'Свободное',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_free', $detail->harf_free,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_free'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_first', 'В начале',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_first', $detail->harf_first,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_first'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_center', 'В середине',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_center', $detail->harf_center,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_center'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_last', 'В конце',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_last', $detail->harf_last,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_last'
        ] ) }}
    </div>



<h1>Графическое начертание</h1>
    <div class="row form-group">
        {{ Form::label('harf_free_img', 'Свободное',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_free_img', $detail->harf_free_img,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_free_img'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_first_img', 'В начале',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_first_img', $detail->harf_first_img,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_first_img'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_center_img', 'В середине',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_center_img', $detail->harf_center_img,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_center_img'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_last_img', 'В конце',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_last_img', $detail->harf_last_img,[
            'class'=>'form-control col-lg-10',
            'id'=>''
        ] ) }}
    </div>

    <h1>Звуки</h1>
    <div class="row form-group">
        {{ Form::label('harf_name_sound', 'Название',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_name_sound', $detail->harf_name_sound,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_name_sound'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_fatha_sound', 'Звук с фатхой',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_fatha_sound', $detail->harf_fatha_sound,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_fatha_sound'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_kesra_sound', 'Звык с касрой',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_kesra_sound', $detail->harf_kesra_sound,[
            'class'=>'form-control col-lg-10',
            'id'=>''
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_damma_sound', 'Звук с даммой',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_damma_sound', $detail->harf_damma_sound,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_damma_sound'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('harf_saken_sound', 'Звук с сакеном',['class'=>'col-lg-2']) }}
        {{ Form::text('harf_saken_sound', $detail->harf_saken_sound,[
            'class'=>'form-control col-lg-10',
            'id'=>'harf_saken_sound'
        ] ) }}
    </div>

    <h1>Картинка</h1>
    <div class="row form-group">
        {{ Form::label('img_tell', 'Картинка',['class'=>'col-lg-2']) }}
        {{ Form::text('img_tell', $detail->img_tell,[
            'class'=>'form-control col-lg-10',
            'id'=>'img_tell'
        ] ) }}
    </div>
    <h1>Произношение</h1>
    <div class="row form-group">
        {{ Form::textarea('text_about', $detail->text_about,[
            'class'=>'form-control col-sm-12 editor',
            'id'=>'text_about'
        ] ) }}
    </div>
    <h1>Для чтения</h1>
    <div class="row form-group">
        {{ Form::textarea('text_for_reading', $detail->text_for_reading,[
            'class'=>'form-control col-sm-12 editor',
            'id'=>'text_for_reading'
        ] ) }}
    </div>
    <h1>SEO</h1>
    <div class="row form-group">
        {{ Form::label('title', 'title',['class'=>'col-lg-2']) }}
        {{ Form::text('title', $detail->title,[
            'class'=>'form-control col-lg-10',
            'id'=>'title'
        ] ) }}
    </div>

    <div class="row form-group">
        {{ Form::label('meta_keywords', 'meta_keywords',['class'=>'col-lg-2']) }}
        {{ Form::text('meta_keywords', $detail->meta_keywords,[
            'class'=>'form-control col-lg-10',
            'id'=>'meta_keywords'
        ] ) }}
    </div>
    <div class="row form-group">
        {{ Form::label('meta_description', 'meta_description',['class'=>'col-lg-2']) }}
        {{ Form::text('meta_description', $detail->meta_description,[
            'class'=>'form-control col-lg-10',
            'id'=>'meta_description'
        ] ) }}
    </div>

    {{Form::submit('Сохранить',[
    'class'=>'btn btn-primary',
            'name'=>'save'])}}

    {!! Form::close() !!}








@endsection

