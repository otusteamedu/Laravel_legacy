<div class="file-uploader">
    {!! Form::label($label); !!}

    @if($photo)
        <a href="{{ \App\Services\File\FilePathHelper::getUrl($photo->subdir, $photo->file_name) }}" target="_blank">
            <img class="file-uploader__img" src="{{ \App\Services\File\FilePathHelper::getUrl($photo->subdir, $photo->file_name) }}" alt="">
        </a>
        {!! Form::hidden($name . "_id", $photo->id) !!}
    @endif
    {!! Form::file($name, ['class' => 'form-control-file']) !!}
</div>
