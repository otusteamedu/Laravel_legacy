# Фабричный метод

## Создание провайдера

Класс хоть и называется Repository, но он занимается созданием объектов 
в зависимости от требования, основная зависимость это авторизованный аккаунт.

Сюда бы еще интерфейс и можно было держать несколько реализаций, хотя на практике
новое поведение оказалось слишком "новым", т.к. была смена структуры данных в базе.

```php
class ProviderAuthorizationRepository
{
    /** @var Auth  */
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $id
     * @return Provider|Model
     */
    public function findById($id)
    {
        /** @var Account $account */
        $account = $this->auth->getAccount();

        return Provider::with('setting')
            ->where('id', $id)
            ->whereHas('setting', function ($query) use ($account) {
                $query
                    ->where('account_id', $account->id);
            })->firstOrFail();
    }

    /**
     * @param $name
     * @return Provider|Model
     */
    public function findByName($name)
    {
        return $this->getQuery()->where('nameEn', $name)->firstOrFail();
    }

    /**
     * @param string[] $filterByName
     * @return \Illuminate\Database\Eloquent\Collection|Provider[]
     */
    public function findAll(array $filterByName = array())
    {

        $query = $this->getQuery()->where('active', 1);

        return count($filterByName) > 0 ?
            $query->whereIn('nameEn', $filterByName)->get() : $query->get();
    }

    public function findWithLocationByLocation($location_id, array $filter = array())
    {
        $query = $this
            ->getQuery()
            ->with(['locations' => function ($query) use ($location_id) {
                $query->where('engineLocationId', $location_id);
            }])
            ->where('active', 1);

        if(count($filter) > 0){
            $query->whereIn('nameEn', $filter);
        }

        $query->whereHas('locations', function ($query) use ($location_id) {
                $query->where('engineLocationId', $location_id);
            });

        return $query->get();
    }

    /**
     * @param $hotelId
     * @return \Illuminate\Database\Eloquent\Collection|Provider|Model
     */
    public function findByHotelId($hotelId)
    {
        $provider_id = Hotel::select(['provider_id'])->findOrFail($hotelId)['provider_id'];

        return $this->findById($provider_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getQuery()
    {
        /** @var Account $account */
        $account = $this->auth->getAccount();

        return Provider::query()
            ->with('setting')
            ->whereHas('setting', function ($query) use ($account) {
                $query
                    ->where('account_id', $account->id)
                    ->where('active', 1);
            });

    }
}
```