#ДЗ #1 

## Описание проекта
Callback сервис “перезвоним вам через 30 секунд” на Laravel. В админке клиент создает виджет, который ставит себе на сайт. Посетитель сайта заполняет форму, и мы создаем звонок между ним и менеджером.

Достался в наследство по работе, поэтому могу показать только части кода. Предыдущий разработчик, как и я, не применял принципы SOLID, поэтому заложил слабую архитектуру, которую я по незнанию продолжил развивать. До этого не было опыта с Laravel, поэтому многие вещи я делал неправильно без использования возможностей фреймворка и самого PHP.

## Проблемы в коде

* SRP и OCP рассмотрены в комментариях
* LSP - не имел пока дел с наследованием, поэтому нет примеров несоблюдения этого принципа
* ISP - аналогично
* DIP - в комментариях