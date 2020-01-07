<table>
    <tbody>
    <tr><td>id</td><td>&nbsp;{{$user->id}}</td></tr>
    <tr><td>сайт</td><td><input type="text" name="source" class="@error('source') is-invalid @enderror" value="{{ $user->source }}"></td></tr>
    <tr><td>тип</td><td><input type="text" name="type" class="@error('type') is-invalid @enderror" value="{{ $user->type }}"></td></tr>
    <tr><td>оператор</td><td><input type="text" name="operator" class="@error('operator') is-invalid @enderror" value="{{ $user->operator }}"></td></tr>
    <tr><td>ФИО</td><td><input type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ $user->name }}"></td></tr>
    <tr><td>телефон</td><td><input type="text" name="phone" class="@error('phone') is-invalid @enderror" value="{{ $user->phone }}"></td></tr>
    <tr><td>эл.почта</td><td><input type="text" name="email" class="@error('email') is-invalid @enderror" value="{{ $user->email }}"></td></tr>
    <tr><td>адрес</td><td><input type="text" name="address" class="@error('address') is-invalid @enderror" value="{{ $user->address }}"></td></tr>
    </tbody>
</table>
<label>Комментарий
    <textarea name="comments">{{$user->comments}}</textarea>
</label>

<!-- Валидация -->
@include('blocks.errors')
