<?php

use Core\App;
use Core\Database;

$db=App::resolve(Database::class);

$subject=$db->query('SELECT * FROM subjects WHERE id=:id',[
    'id'=>$_GET['id']
])->findOrFail();

view('subjects/edit.view.php',[
    'heading'=>'Edit Subject',
    'errors'=>[],
    'subject'=>$subject
]);