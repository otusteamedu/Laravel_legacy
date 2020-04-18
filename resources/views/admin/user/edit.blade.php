{{ Form::model($user, ['url' => route('admin.user.update', ['user' => $user]), 'method' => 'PUT']) }}
<div class="row">
<div class="col-12 col-lg-8">
    @include('admin.blocks.errors.errors')
    <div class="form-row">
      <div class="col-12 mb-3">
          {{ Form::label('name', 'Имя пользователя') }}
          {{ Form::text('name', $user->name, array_merge(['class' => 'form-control'], 
                                                        ['placeholder'=>'Имя пользователя'],
                                                        ['readonly'=>"readonly"])) }}
      </div>
      <div class="col-12 mb-3">
        {{ Form::label('email', 'Логин/Email') }}
        {{ Form::text('email', $user->email, array_merge(['class' => 'form-control'], 
                                                          ['placeholder'=>'Логин/Email'], 
                                                          ['readonly'=>"readonly"])) }}
      </div>  
      <div class="col-12 mb-3">
        {{ Form::label('role_id', 'Роли') }}
        <select class="custom-select" name="role_id" id="role_id">
          @include('admin.blocks.roles.roles')
        </select>
      </div>   
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