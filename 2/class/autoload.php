<?
spl_autoload_register(function ($class_name) {
    $parts = explode('\\', $class_name);
    require end($parts) . '.php';
});
?>