<?php

use Core\App;
use Core\Database;

$db = App::container()->resolve(Database::class);

$currentUserId = 2;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
  'id' => $_POST['id'],
])->findOrFail();

$db->authorize($note['user_id'] === $currentUserId);

$db->query("DELETE FROM NOTES WHERE id = :id", [
  'id' => $_POST['id'],
]);

header('location: /laracasts-demo/notes');
exit();
