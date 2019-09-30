@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif



    {{csrf_field()}}
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <input type="text" id="name" name="name" placeholder="Имя пользователя" class="form-control"
                   value="@if(old('name')){{old('name')}}@else{{$user->name ?? ""}}@endif" >
        </div>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <input type="text" id="email" name="email" placeholder="Email пользователя" class="form-control"
                   value="@if(old('email')){{old('email')}}@else{{$user->email ?? ""}}@endif" >
        </div>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <input type="text" id="name" name="password" placeholder="Пароль" class="form-control">
        </div>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <input type="text" id="name" name="password_confirmation" placeholder="Подтверждение пароля" class="form-control">
        </div>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-success btn-sm">Создать</button>
    </div>
