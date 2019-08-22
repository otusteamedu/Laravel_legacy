# Patterns and Practices

### Patterns
1. Можно было использовать Builder
```php
class User
{
    const TABLE = "users";
    private $login;
    private $email;
    private $password_hash;
    private $password;
    private $admin = 0;
    private $queryBuilder;
    private $userId;
    private $db;
    function __construct(array $kwargs)
    {
        if ($kwargs["login"]) {
            $this->login = $kwargs["login"];
        }
        if ($kwargs["password"]) {
            $this->password = $kwargs["password"];
            $this->password_hash = hash("whirlpool", $kwargs["password"]);
        }
        if ($kwargs["email"]){
            $this->email = $kwargs["email"];
        }
        if ($kwargs["user_id"]) {
            $this->userId = $kwargs["user_id"];
        }
        $this->db = new PDO("mysql:host=db; dbname=myDb", "user", "test");
        $this->queryBuilder = new QueryBuilder(["db" => $this->db]);
    }
...
```
2. Использование абстрактной фабрики
```php
class FinderController extends Controller
{
    private $finder;
    public function __construct(ContainerInterface $c)
    {
        parent::__construct($c);
        $this->finder = new Finder($c);
    }
    public function findPerson(Request $request, Response $response)
    {
        $cond = $request->getParams();
        $foundUsers = $this->finder->findPerson($cond);
```
Можно было использовать статический метод абстрактной фабрики 
для получения объекта класса Finder
3. Можно сказать, что тут есть некое подобие Singleton, так как 
QueryBuilder создается только один раз
```php
$settings = require __DIR__ . '/../src/settings.php';
$app = new App($settings);
$container = $app->getContainer();
$container["qb"] = function () {
    return new QueryBuilder([
       "db" => new PDO("mysql:host=db;dbname=myDb", "root", "test")
    ]);
};
$container["db"] = function () {
  return new PDO("mysql:host=db;dbname=myDb", "root", "test");
};
```

### Practices
1. Разделенный return
```php
class Liker extends MainClass
{
    public function addLike($fromUserId, $toUserId, $date)
    {
        $like = $this->qb->filterDataByCond("likes", [
            "user_id_to" => $toUserId,
            "user_id_from" => $fromUserId,
        ])[0];
        
        if (!empty($like)) {
            $this->qb->deleteRowByCond("likes", [
                "user_id_to" => $toUserId,
                "user_id_from" => $fromUserId,
            ]);
            return true;
        }
        
        if (!$this->qb->insertDataIntoTable("likes", [
            "user_id_from" => $fromUserId,
            "user_id_to" => $toUserId,
            "created_at" => $date
        ])) {
            throw new Exception("Like was not added");
        } else
            return true;
    }
}
```
2. Автозагурзка
```php
 "autoload": {
        "psr-4": {
            "Classes\\": "src/Classes",
            "Controllers\\": "src/Controllers",
            "Middleware\\": "src/Middleware"
        }
    }
```
3. Нужно использовать PHPDoc и TypeHints
```php
class Loader extends MainClass
{   
    /**PHPDoc
    *
    *
    **/
    private function moveUploadedFile(string $directory, UploadedFile $uploadedFile): string
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ["png", "jpg", "jpeg", "gif"])) {
            return false;
        }
        try {
            $basename = bin2hex(random_bytes(8));
        } catch (Exception $e) {
            return "error";
        }
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        return $filename;
    }

```
4. использование camelCase и 4 пробела
5. Использование исключений, но в этом примере нужно было его логировать, 
а пользователя перекидывать на страницу с ошибкой
```php
 public function login(Request $request, Response $response)
    {
        try {
            if ($this->user->loginUser()) {
                return $response->withRedirect($this->router->pathFor("home"));
            }
            return $response->write("Invalid login or password");
        } catch (Exception $exception) {
            return $response->write($exception->getMessage());
        }
    }
```