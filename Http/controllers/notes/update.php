<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::container()->resolve(Database::class);

$currentUserId = 2;

// Find note
$note = $db->query('SELECT * FROM notes WHERE id = :id', [
  'id' => $_POST['id'],
])->findOrFail();

// Authorize
$db->authorize($note['user_id'] === $currentUserId);

// Validate
$errors = [];
if (!Validator::string($_POST['body'], 1, 10)) {
  $errors['body'] = 'A body of no more than 10 characters is required.';
}

// Render
if (count($errors)) {
  return view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note,
  ]);
}

$db->query('UPDATE NOTES SET body = :body WHERE id = :id', [
  'body' => $_POST['body'],
  'id' => $_POST['id'],
]);

// Redirect
header('location: /laracasts-demo/notes');
die();