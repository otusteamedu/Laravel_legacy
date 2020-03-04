<img src="{{$author['photo']}}" alt="" class="img-fluid">
<div class="custom-file">
    {{ Form::file('photo',['class'=>"custom-file-input", 'id'=>'photo'])}}
    {{ Form::label('photo',' ', ['class'=>"custom-file-label", 'id'=>'photo'])}}
</div>
