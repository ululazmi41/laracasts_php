<?php

use Core\App;
use Core\Database;

$db = App::container()->resolve(Database::class);

$notes = $db->query("SELECT * FROM notes")->get();

view('notes/index.view.php', [
  'heading' => 'My Notes',
  'notes' => $notes
]);