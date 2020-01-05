<h1>Слова</h1>
<hr>
@forelse($words as $word)
    {!!Form::model($words,['method'=>'PUT', 'url' => route('admin.words.update',$word->id )])!!}
    {{ Form::token()}}
    <div class="row form-group">
        <div class="col-md-2"></div>
        <div class="col-md-5">ед</div>
        <div class="col-md-5">мн</div>
    </div>
    <div class="row form-group">
        <div class="col-md-2">Рус</div>
        {{Form::text('rus_word', $word->rus_word,[
            'class'=>'form-control col-md-5',
        ])}}

        {{Form::text('rus_word_mn', $word->rus_word_mn,[
            'class'=>'form-control col-md-5',
        ])}}
    </div>
    <div class="row form-group">
        <div class="col-md-2">Ар</div>
        {{Form::text('ar_word', $word->ar_word,[
            'class'=>'form-control col-md-5',
        ])}}
        {{Form::text('ar_word_mn', $word->ar_word_mn,[
            'class'=>'form-control col-md-5',

        ])}}
    </div>

    <div class="row form-group">
        {{Form::text('id',$word->id,[
                        'class'=>'form-control col-md-1',
                        'readonly'=> 'true'
                    ])}}
        {{Form::select('lessen_id', $listGrammar,$word->lessen_id,[
        'class'=>'form-control col-md-8'
        ])}}
        {{Form::select('word_type', [
            'ism'=>'ism',
            'figl'=>'figl',
            'harf'=>'harf'
        ],$word->word_type,[
        'class'=>'form-control col-md-2'
        ])}}
        {{Form::select('fig_simpol', [
            ''=>'',
            'A'=>'A',
            'I'=>'I',
            'U'=>'U'
        ],$word->word_type,[
        'class'=>'form-control col-md-1'

        ])}}
    </div>
    {{Form::submit('Обновить',[
'class'=>'btn btn-primary',
           'name'=>'save'])}}
    {!! Form::close() !!}

    <hr>
@empty
    <p>слов нет</p>
@endforelse

<h1>Добавить слово</h1>

{!!Form::model($words,['method'=>'POST', 'url' => route('admin.words.store')])!!}
{{ Form::token()}}
<div class="row form-group">
    <div class="col-md-2"></div>
    <div class="col-md-5">ед</div>
    <div class="col-md-5">мн</div>
</div>
<div class="row form-group">
    <div class="col-md-2">Рус</div>
    {{Form::text('rus_word','',[
        'class'=>'form-control col-md-5',
    ])}}

    {{Form::text('rus_word_mn', '',[
        'class'=>'form-control col-md-5',
    ])}}
</div>
<div class="row form-group">
    <div class="col-md-2">Ар</div>
    {{Form::text('ar_word', '',[
        'class'=>'form-control col-md-5',
    ])}}
    {{Form::text('ar_word_mn', '',[
        'class'=>'form-control col-md-5',
    ])}}
</div>

<div class="row form-group">

    {{Form::select('lessen_id', $listGrammar,'',[
    'class'=>'form-control col-md-9'
    ])}}
    {{Form::select('word_type',
    [
        'ism'=>'ism',
        'figl'=>'figl',
        'harf'=>'harf'
    ],
    '',
    [
    'class'=>'form-control col-md-2'
    ])
    }}

    {{Form::select('fig_simpol', [
        ''=>'',
        'A'=>'A',
        'I'=>'I',
        'U'=>'U'
    ],
    '',
    [
    'class'=>'form-control col-md-1'
    ])}}
</div>
{{Form::submit('Добавить',[
'class'=>'btn btn-primary',
       'name'=>'save'])}}
{!! Form::close() !!}
