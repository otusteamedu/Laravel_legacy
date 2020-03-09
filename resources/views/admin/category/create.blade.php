{{ Form::open(['url' => route('admin.category.store')]) }}
<div class="row">
<div class="col-12 col-lg-8">
    @include('admin.blocks.errors.errors')
    <div class="form-row">
      <div class="col-12 mb-3">
          {{ Form::label('title', 'Заголовок новости') }}
          {{ Form::text('title', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Заголовок'])) }}
      </div>
      <div class="col-12 mb-3">
          
          {{ Form::label('parent_id', 'Категории') }}
          <select class="custom-select" name="parent_id" id="parent_id">
            <option value="0">Без категории</option>
            @include('admin.blocks.category.category')
          </select>
      </div>
      <div class="col-12 mb-3">
        <div class="form-check">
          {{ Form::checkbox('visible', null,null, array_merge(['class' => 'form-check-input'],['id'=>'visible'])) }}
          {{ Form::label('visible', 'Отображать категорию', array_merge(['class' => 'form-check-label'])) }}
        </div>
      </div>
      <div class="col-12 mb-3">
        {{ Form::label('description', 'Описание') }}
        {{ Form::textarea('description', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Описание категории'])) }}
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
          {{ Form::submit('Сохранить',array_merge(['class' => 'btn btn-dark'])) }}
      </div>
    </div>
  </div>
</div>
</div>
{{ Form::close() }}