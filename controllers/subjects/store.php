<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db= App::resolve(Database::class);

$errors=[];

if(! Validator::string($_POST['subject_name'], 1, 1000)){
    $errors['subject_name']='A name of no more than 55 characters is required.';
}

if(! empty($errors['subject_name'])){
    return view("subjects/create.view.php", [
        'heading' => 'New Subject',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO subjects(subject_name) VALUES(:subject_name)',[
    'subject_name'=>$_POST['subject_name']
]);

header('location: /subjects');