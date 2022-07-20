<?php

namespace Samfelgar\SimpleRouter;

use Samfelgar\SimpleRouter\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    private function normalizeMethod(string $method): string
    {
        return strtolower($method);
    }

    public function register(string $method, string $route, callable|array $action): Router
    {
        $normalizedMethod = $this->normalizeMethod($method);

        $this->routes[$normalizedMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): Router
    {
        $this->register('get', $route, $action);

        return $this;
    }

    public function post(string $route, callable|array $action): Router
    {
        $this->register('post', $route, $action);

        return $this;
    }

    public function put(string $route, callable|array $action): Router
    {
        $this->register('put', $route, $action);

        return $this;
    }

    public function delete(string $route, callable|array $action): Router
    {
        $this->register('delete', $route, $action);

        return $this;
    }

    public function patch(string $route, callable|array $action): Router
    {
        $this->register('patch', $route, $action);

        return $this;
    }

    public function all(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestMethod, string $requestUri): mixed
    {
        $route = explode('?', $requestUri);

        $normalizedMethod = $this->normalizeMethod($requestMethod);

        $action = $this->routes[$normalizedMethod][$route[0]] ?? null;

        if ($action === null) {
            throw RouteNotFoundException::notFound();
        }

        if (is_callable($action)) {
            return call_user_func_array($action, []);
        }

        [$class, $method] = $action;

        if (!class_exists($class)) {
            throw RouteNotFoundException::notFound();
        }

        return call_user_func_array([new $class(), $method], []);
    }
}
