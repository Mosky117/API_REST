<?php

use Core\App;
use Core\Database;

$db=App::resolve(Database::class);

$subject_list=$db->query('SELECT * FROM subjects')->get();

view('courses/create.view.php',[
    'heading'=>'New Course',
    'subjects'=>$subject_list,
    'errors'=>[]
]);