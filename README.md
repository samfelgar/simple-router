# Simple Router

## Credit

Based on Programming With Gio awesome playlist, available [here](https://www.youtube.com/playlist?list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-).

## Disclaimer

This project is for educational purposes only, **DO NOT USE IT IN PRODUCTION**.

## Usage

To register your routes, use the `\Samfelgar\SimpleRouter\Router` register method.
There is also shorthand methods for each HTTP method.

```php
use Samfelgar\SimpleRouter\Router;

$router = new Router();

$router->register('get', '/', fn () => 'Hello World!');

$router->get('/bye', fn () => 'See you!');
```

To resolve the routes, you may call the `\Samfelgar\SimpleRouter\Router::resolve` method.

```php
use Samfelgar\SimpleRouter\Router;

$router = new Router();

$response = $router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```