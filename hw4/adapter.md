# Адаптер

## Единый интерфейс работы с разными поставщиками

```php
interface HotelDriverInterface
{

    /**
     * Поиск отелей по локации
     * @param SearchHotelRequest $request
     * @return SearchHotel[]
     */
    public function searchHotelByLocation(SearchHotelRequest $request);

    /**
     * Возвращает варианты номеров в найденном отеле
     * @param SearchRateRequest $request
     * @return SearchRateResponse
     */
    public function searchVariantsByHotel(SearchRateRequest $request);

...

}
```

Реализуя данный интрефейс, мы можем с разными потсавщиками услуг работать одинаково.