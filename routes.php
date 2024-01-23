<?php

$router->get('/','index.php');
$router->get('/courses','courses/index.php');
$router->get('/subjects','subjects/index.php');

$router->get('/courses/new_course','courses/create.php');
$router->post('/courses','courses/store.php');
$router->delete('/courses','courses/destroy.php');

$router->get('/subjects/new_subject','subjects/create.php');
$router->post('/subjects','subjects/store.php');
$router->delete('/subjects','subjects/destroy.php');

$router->get('/edit_course','courses/edit.php');
$router->patch('/course_editing','courses/update.php');

$router->get('/edit_subject','subjects/edit.php');
$router->patch('/subject_editing','subjects/update.php');
