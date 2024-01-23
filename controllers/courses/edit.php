<?php

use Core\App;
use Core\Database;

$db=App::resolve(Database::class);

$course=$db->query('SELECT * FROM courses WHERE id=:id',[
    'id'=>$_GET['id']
])->findOrFail();

$subjectJoint=$db->query('SELECT * FROM courses_subjects WHERE course_id=:id',[
    'id'=>$_GET['id']
])->get();

$subjectIDs= array_column($subjectJoint,'subject_id');

$allSubjects=$db->query('SELECT * FROM subjects')->get();

view('courses/edit.view.php',[
    'heading'=>'Edit Course',
    'errors'=>[],
    'course'=>$course,
    'subjects'=>$subjectIDs,
    'allSubjects'=>$allSubjects
]);