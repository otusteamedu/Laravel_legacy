<h2>Левое меню</h2>

<ul>
    <li><a href="{{route('admin.main.index', ['locale'=>$locale])}}">Главная</a></li>
    <li><a href="{{route('admin.transaction.index', ['locale'=>$locale])}}">Транзакции</a></li>
    <li><a href="{{route('admin.reason.index', ['locale'=>$locale])}}">Причины</a></li>
    <li><a href="{{route('admin.student.index', ['locale'=>$locale])}}">Студенты</a></li>
</ul>