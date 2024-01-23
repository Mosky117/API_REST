<?php

use Core\App;
use Core\Database;

$db=App::resolve(Database::class);

$course=$db->query('SELECT *FROM courses WHERE id=:id',[
    'id'=>$_POST['id']
])->findOrFail();

$db->query('DELETE FROM courses_subjects WHERE course_id=:id',[
    'id'=>$_POST['id']
]);

$db->query('DELETE FROM courses WHERE id=:id',[
    'id'=>$_POST['id']
]);

header('location: /courses');
exit();