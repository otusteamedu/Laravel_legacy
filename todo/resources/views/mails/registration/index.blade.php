<!DOCTYPE html>
<html>
<head>
    <title>Подтверждение регистрации</title>
</head>

<body>
<h2> {{$user['name']}}, Вы успешно зарегистрировались на сайте {{ config('app.name') }}</h2>
<br/>
Зарегистрированный email  {{$user['email']}}
</body>

</html>