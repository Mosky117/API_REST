<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db=App::resolve(Database::class);

$course=$db->query('SELECT * FROM courses WHERE id=:id',[
    'id'=>$_POST['id']
])->findOrFail();

$errors=[];

if(! Validator::string($_POST['course_name'],1,55)){
    $errors['course_name']=['A name of no more than 55 characters is required.'];
}
if(! Validator::string($_POST['places'],1,3)){
    $errors['course_name']=['At least one place available.'];
}

if(count($errors)){
    return view('courses/edit.view.php',[
        'heading'=>'Edit Course',
        'errors'=>$errors,
        'course'=>$course
    ]);
}

$db->query('UPDATE courses set course_name=:course_name, places=:places WHERE id=:id',[
    'id'=>$_POST['id'],
    'course_name'=>$_POST['course_name'],
    'places'=>$_POST['places']
]);

$db->query('DELETE FROM courses_subjects WHERE course_id=:id',[
    'id'=>$_POST['id']
]);

foreach($_POST['subjects'] as $subject){

    $sql = "INSERT INTO courses_subjects (course_id, subject_id) VALUES(:course_id, :subject_id)";

    $params = array('course_id' => $_POST['id'], 'subject_id' => $subject); 

    $db->query($sql, $params);

}

header('location: /courses');