{!! Form::hidden('id', $author->id ?? 0); !!}
<div class="form-group">
    {!! Form::label('Наименование'); !!}
    {!! Form::text('name', $author->name ?? '', ['class' => 'form-control']); !!}
</div>

<div class="form-group">

    @include('cms.components.photo', ['name' => 'photo', 'label' => 'Фото для анонса', 'photo' => $author->photo ?? null])

</div>

<div class="form-group">
    {!! Form::submit(trans('Сохранить'), array('class' => 'btn btn-primary', 'name' => 'save')) !!}
    {!! Form::submit(trans('Отмена'), array('class' => 'btn btn-secondary', 'name' => 'cancel')) !!}
</div>
