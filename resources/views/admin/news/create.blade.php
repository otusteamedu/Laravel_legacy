{{ Form::open(['url' => route('admin.news.store'), 'files'=>'true']) }}
<div class="row">
<div class="col-12 col-lg-8">
    @include('admin.blocks.errors.errors')
    <div class="form-row">
      <div class="col-12 mb-3">
          {{ Form::label('title', 'Заголовок новости') }}
          {{ Form::text('title', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Заголовок'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('text', 'Текст') }}
          {{ Form::textarea('text', null, array_merge(['class' => 'form-control'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('meta_title', 'Мета заголовок') }}
          {{ Form::text('meta_title', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Мета заголовок'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('meta_description', 'Мета описание') }}
          {{ Form::textarea('meta_description', null, array_merge(['class' => 'form-control'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('url', 'Url') }}
          {{ Form::text('url', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Url'])) }}
      </div>
      <div class="card col-12 mb-3">
        <div class="card-body">
          {{ Form::label('file', 'Загрузка файла') }}
          {{  Form::file('file', array_merge(['class' => 'form-control'])) }}
        </div>
      </div> 
      
    </div>
</div>
<div class="col-12 col-lg-4">
  <div class="col-12 col-lg-10 mb-3 pl-0">
    <div class="card">
      <div class="card-body">
          {{ Form::submit('Сохранить',array_merge(['class' => 'btn btn-dark'])) }}
      </div>
    </div>
  </div>
</div>
</div>
{{ Form::close() }}