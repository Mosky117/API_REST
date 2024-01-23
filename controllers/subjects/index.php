<?php

use Core\App;
use Core\Database;

$db= App::resolve(Database::class);
$subjects= $db->query('SELECT id, subject_name FROM subjects')->get();

view('subjects/index.view.php',[
    'heading'=>'Subjects',
    'subjects'=>$subjects,
]);