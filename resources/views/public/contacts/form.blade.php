<div class="col-12 col-md-6">
    <h3>Контакты</h3>
    {{ Form::open() }}
      <div class="form-row">
        <div class="col-12 col-md-6">
            {{ Form::label('name', 'Имя*') }}
            {{ Form::text('name', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Имя', 'required'=>''])) }}
        </div>
        <div class="col-12 col-md-6">
            {{ Form::label('phone', 'Телефон*') }}
            {{ Form::text('phone', null, array_merge(['class' => 'form-control'], ['placeholder'=>'+7 (999) 999 99 99'])) }}
        </div>
        <div class="col-12 col-md-6">
            {{ Form::label('city', 'Город') }}
            {{ Form::text('city', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Город'])) }}
        </div>
        <div class="col-12 col-md-6">
            {{ Form::label('company', 'Должность') }}
            {{ Form::text('company', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Должность'])) }}
        </div>
        <div class="col-12">
            {{ Form::label('email', 'Email*') }}
            {{ Form::text('email', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Email', 'required'=>''])) }}
        </div>
        <div class="col-12">
            <label for="text">Сообщение</label>
            <textarea id="text" name="xxx" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-12">
          <div class="float-right mt-2">
            <input id="email" class="form-control" name="text" type="hidden">
            <button type="submit" class="btn btn-dark">Отправить</button>
          </div>
        </div>
      </div>
    {{ Form::close() }}
  </div>