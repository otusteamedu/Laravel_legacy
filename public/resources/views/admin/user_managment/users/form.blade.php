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
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="email" name="email" placeholder="Email пользователя" class="form-control"
               value="@if(old('email')){{old('email')}}@else{{$user->email ?? ""}}@endif" >
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="phone" name="phone" placeholder="Мобильный телефон" class="form-control"
               value="@if(old('phone')){{old('phone')}}@else{{$user->phone ?? ""}}@endif" >
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="name" name="password" placeholder="Пароль" class="form-control">
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="name" name="password_confirmation" placeholder="Подтверждение пароля" class="form-control">
    </div>
</div>

<div class="form-check">
    @foreach($roles as $role)
    <div class="checkbox">
        <label for="checkbox_{{$role->id}}" class="form-check-label ">
            <input type="checkbox" id="checkbox_{{$role->id}}" name="roles[]" value="{{$role->id}}" class="form-check-input"
                   @isset($user->roles)
                   @if($user->roles->where('id',$role->id)->count()) checked="checked" @endif
            @endisset
            >{{ucfirst($role->name)}}
        </label>
    </div>
    @endforeach
</div>


<div class="form-actions form-group">
    <button type="submit" class="btn btn-success btn-sm">Создать</button>
</div>
