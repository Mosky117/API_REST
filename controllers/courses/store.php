<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db= App::resolve(Database::class);

$errors= [];

if(! Validator::string($_POST['course_name'], 1, 1000)){
    $errors['course_name']='A nam of no more than 55 characters is required.';
}

if(! empty($errors['course_name'])){
    return view("courses/create.view.php", [
        'heading' => 'New Course',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO courses(course_name, places) VALUES(:course_name, :places)',[
    'course_name'=>$_POST['course_name'],
    'places'=>$_POST['places']
]);

$courseID=$db->getLastID();

foreach($_POST['subjects'] as $subject){

    $sql = "INSERT INTO courses_subjects (course_id, subject_id) VALUES(:course_id, :subject_id)";

    $params = array('course_id' => $courseID, 'subject_id' => $subject); 

    $db->query($sql, $params);

}

header('location: /courses');