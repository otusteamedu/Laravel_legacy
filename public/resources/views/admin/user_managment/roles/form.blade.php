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
        <input type="text" id="name" name="name" placeholder="Название роли" class="form-control"
               value="@if(old('name')){{old('name')}}@else{{$role->name ?? ""}}@endif" >
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="slug" name="slug" placeholder="slug" class="form-control"
               value="@if(old('slug')){{old('slug')}}@else{{$role->slug ?? ""}}@endif" >
    </div>
</div>


<div class="form-actions form-group">
    <button type="submit" class="btn btn-success btn-sm">Создать</button>
</div>
