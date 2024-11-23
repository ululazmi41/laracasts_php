<?php

use Core\App;
use Core\Database;

$db = App::container()->resolve(Database::class);

$currentUserId = 2;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
  'id' => $_GET['id'],
])->findOrFail();

$db->authorize($note['user_id'] === $currentUserId);

view('notes/edit.view.php', [
  'heading' => 'Edit Note',
  'errors' => [],
  'note' => $note,
]);