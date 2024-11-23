<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::container()->resolve(Database::class);

if (!Validator::email('a@a.com')) {
  dd('That is not a valid email.');
}

$errors = [];

if (!Validator::string($_POST['body'], 1, 10)) {
  $errors['body'] = 'A body of no more than 10 characters is required.';
}

if (!empty($errors)) {
  return view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
  ]);
}

$db->query("INSERT INTO notes (user_id, body) VALUES (:user_id, :body)", [
  'user_id' => 2,
  'body' => $_POST['body'],
]);

header('location: /laracasts-demo/notes');
die();