{{ Form::model($user, ['url' => route('admin.user.update', ['user' => $user]), 'method' => 'PUT']) }}
<div class="row">
<div class="col-12 col-lg-8">
    @include('admin.blocks.errors.errors')
    <div class="form-row">
      <div class="col-12 mb-3">
          {{ Form::label('title', 'Заголовок новости') }}
          {{ Form::text('title', $user->title, array_merge(['class' => 'form-control'], ['placeholder'=>'Заголовок'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('text', 'Текст') }}
          {{ Form::textarea('text', $user->text, array_merge(['class' => 'form-control'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('meta_title', 'Мета заголовок') }}
          {{ Form::text('meta_title', $user->meta_title, array_merge(['class' => 'form-control'], ['placeholder'=>'Мета заголовок'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('meta_description', 'Мета описание') }}
          {{ Form::textarea('meta_description', $user->meta_description, array_merge(['class' => 'form-control'])) }}
      </div>
      <div class="col-12 mb-3">
          {{ Form::label('url', 'Url') }}
          {{ Form::text('url', $user->url, array_merge(['class' => 'form-control'], ['placeholder'=>'Url'])) }}
      </div>
{{--       <div class="col-12 mb-3">
          {{ Form::label('file', 'Загрузка файла') }}
          {{  Form::file('file', array_merge(['class' => 'form-control'])) }}
      </div> --}}
      
    </div>
</div>
<div class="col-12 col-lg-4">
  <div class="col-12 col-lg-10 mb-3 pl-0">
    <div class="card">
      <div class="card-body">
          {!! Form::submit('Обновить', array_merge(['class' => 'btn btn-dark'])) !!}
      </div>
    </div>
    <div class="card mt-5">
      <div class="card-body">
          <h4>Создано</h4>
          <p>{{ $user->created_at }}</p>
          <h4>Изменено</h4>
          <p>{{ $user->updated_at  }}</p>
      </div>
    </div>
  </div>
</div>
</div>
{{ Form::close() }}