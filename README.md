## Домашняя работа №2

- Данная работа выполнена с использованием фреймворка Laravel
- Роутинг реализован на базе Laravel роутинга
- Разделены классы для сущностей: Разделы и Элементы
- Реализована модель MVC с тонкими контроллерами, репозиториями и сервисами.
- Для реализации логики фильтров по Элементам и Разделам созданы сторители,
которые формируют запрос в зависимости от входных параметров.
- Классы, использующиеся, для сущности Раздел:
    - `Models/Section` - Модель
    - `Repositories/Section/SectionRepositoryInterface` - интерфейс репозитория
    - `Repositories/Section/SectionRepository` - реализация репозитория
    - `Services/Section/SectionServices` - сервис Раздела (описание бизнес логики)
    - `Http/Controllers/Section/SectionController` - контроллер Раздела
- Классы, использующиеся, для сущности Элемент
    - `Models/Element` - Модель
    - `Repositories/Element/ElementRepositoryInterface` - интерфейс репозитория
    - `Repositories/Element/ElementRepository` - реализация репозитория
    - `Services/Element/ElementServices` - сервис Элемента (описание бизнес логики)
    - `Http/Controllers/Element/ElementController` - контроллер Элемента
- Строители запросов:
    - `DataClasses\AbstractListParam` - абстрактный строитель
    - `DataClasses\Section\SectionListParam` - строитель Раздела
    - `DataClasses\Element\ElementListParam` - строитель Элемента
