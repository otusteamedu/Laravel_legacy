@extends('layouts.site1')
@section('content')
    <div class="container">
        <h1>{{$detail->name}}</h1>
        <hr>
        <h2>Грамматика</h2>
        {!! $detail->grammar_text !!}
        <hr>
        <h2>Арабский текст</h2>
        <div class="h2 text-right">
            {!! $detail->arabic_text !!}
        </div>

        @if(!empty($words))


            @foreach($words as $key=>$w)
                @if($key===0)
                    <br>
                    <h2>Слова</h2>
                    <div class="row">
                        <div  class="col-md-4">Ар мн</div>
                        <div  class="col-md-4">Ар</div>
                        <div  class="col-md-4">Рус</div>
                    </div>
                @endif
                <div class="row">
                    <div  class="col-md-4">
                        {{$w->ar_word_mn}}
                    </div>
                    <div  class="col-md-4">
                        {{$w->ar_word}}
                    </div>
                    <div class="col-md-4">
                        {{$w->rus_word}}
                    </div>
                </div>

            @endforeach
        @endif


        @if($tests)
            <br>
            <h2>Задания</h2>
            @foreach($tests as $key=>$t)
                <div>
                    <b>{{($key+1).") ".$t->name}}</b>
                </div>
                <div>
                    {!!$t->text!!}
                </div>
            @endforeach
        @endif
    </div>
@endsection
