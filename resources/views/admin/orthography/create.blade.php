@extends('admin.layouts.admin')
@section('content')
    <h1>
        Страница Орфография
    </h1>

    <hr>


    {!! Form::model($detail,['method'=>'POST',
            'url' => route('admin.orthography.store'),
            'enctype'=>"multipart/form-data"
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
        {{ Form::label('harf_free_img', 'Свободное',[
        'class'=>'col-lg-2'
        ]) }}
        {{ Form::file('harf_free_img')}}
        @if($detail->harf_free_img)
            <img width="100" src="{{$detail->harf_free_img}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_first_img', 'В начале',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_first_img')}}
        @if($detail->harf_first_img)
            <img width="100" src="{{$detail->harf_first_img}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_center_img', 'В середине',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_center_img')}}
        @if($detail->harf_center_img)
            <img width="100" src="{{$detail->harf_center_img}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_last_img', 'В конце',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_last_img')}}
        @if($detail->harf_last_img)
            <img width="100" src="{{$detail->harf_last_img}}" alt="">
        @endif
    </div>

    <h1>Звуки</h1>
    <div class="row form-group">
        {{ Form::label('harf_name_sound', 'Название',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_name_sound')}}
        @if($detail->harf_name_sound)
            <img width="100" src="{{$detail->harf_name_sound}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_fatha_sound', 'Звук с фатхой',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_fatha_sound')}}
        @if($detail->harf_fatha_sound)
            <img width="100" src="{{$detail->harf_fatha_sound}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_kesra_sound', 'Звык с касрой',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_kesra_sound')}}
        @if($detail->harf_kesra_sound)
            <img width="100" src="{{$detail->harf_kesra_sound}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_damma_sound', 'Звук с даммой',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_damma_sound')}}
        @if($detail->harf_damma_sound)
            <img width="100" src="{{$detail->harf_damma_sound}}" alt="">
        @endif
    </div>
    <div class="row form-group">
        {{ Form::label('harf_saken_sound', 'Звук с сакеном',['class'=>'col-lg-2']) }}
        {{ Form::file('harf_saken_sound')}}
        @if($detail->harf_saken_sound)
            <img width="100" src="{{$detail->harf_saken_sound}}" alt="">
        @endif
    </div>

    <h1>Картинка</h1>
    <div class="row form-group">
        {{ Form::label('img_tell', 'Картинка',['class'=>'col-lg-2']) }}
        {{ Form::file('img_tell')}}
        @if($detail->img_tell)
            <img width="100" src="{{$detail->img_tell}}" alt="">
        @endif
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

