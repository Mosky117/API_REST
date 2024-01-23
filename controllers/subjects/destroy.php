<?php

use Core\App;
use Core\Database;

$db=App::resolve(Database::class);

$subject= $db->query('SELECT * FROM subjects WHERE id=:id',[
    'id'=>$_POST['id']
])->findOrFail();

$db->query('DELETE FROM subjects WHERE id=:id',[
    "id"=>$_POST['id']
]);

header('location: /subjects');
exit();