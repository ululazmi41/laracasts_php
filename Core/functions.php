<?php

function dd($value)
{
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  die();
}

function abort($code = 404)
{
  http_response_code($code);
  require base_path("views/$code.php");
  die();
}

function getUrl($path)
{
  return '/laracasts-demo' . $path;
}

function urlIs($value)
{
  return $_SERVER['REQUEST_URI'] === $value;
}

function base_path($path)
{
  return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
  extract($attributes);
  require base_path('views/' . $path);
}

function redirect($path)
{
  header('location: ' . getUrl($path));
  exit();
}

function old($key, $default = '')
{
  return Core\Session::get('old')[$key] ?? $default;
}