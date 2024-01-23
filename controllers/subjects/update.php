<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db=App::resolve(Database::class);

$subject=$db->query('SELECT * FROM subjects WHERE id=:id',[
    'id'=>$_POST['id']
])->findOrFail();

$errors=[];

if(! Validator::string($_POST['subject_name'],1,55)){
    $errors['subject_name']='A name of no more than 55 characters is required.';
}

if(count($errors)){
    return view('subjects/edit.view.php',[
        'heading'=>'Edit Subject',
        'errors'=>$errors,
        'subject'=>$subject
    ]);
}

$db->query('UPDATE subjects set subject_name=:subject_name WHERE id=:id',[
    'id'=>$_POST['id'],
    'subject_name'=>$_POST['subject_name']
]);

header('location: /subjects');