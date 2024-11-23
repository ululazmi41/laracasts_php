<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
  protected $routes = [];
  protected $BASE_PATH = '/laracasts-demo';

  public function add($method, $uri, $controller)
  {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'middleware' => null,
    ];
    return $this;
  }

  public function get($uri, $controller)
  {
    return $this->add('GET', $this->BASE_PATH . $uri, $controller);
  }

  public function post($uri, $controller)
  {
    return $this->add('POST', $this->BASE_PATH . $uri, $controller);
  }

  public function delete($uri, $controller)
  {
    return $this->add('DELETE', $this->BASE_PATH . $uri, $controller);
  }

  public function patch($uri, $controller)
  {
    return $this->add('PATCH', $this->BASE_PATH . $uri, $controller);
  }

  public function put($uri, $controller)
  {
    return $this->add('PUT', $this->BASE_PATH . $uri, $controller);
  }

  public function only($key)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    return $this;
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        Middleware::resolve($route['middleware']);

        return require base_path('Http/Controllers/' . $route['controller']);
      }
    }

    $this->abort();
  }

  public function previousUrl()
  {
    return $_SERVER['HTTP_REFERER'];
  }

  protected function abort($code = 404)
  {
    http_response_code($code);
    require base_path("views/$code.php");
    die();
  }
}
