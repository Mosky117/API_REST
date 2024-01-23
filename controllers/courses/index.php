<?php

use Core\App;
use Core\Database;

$db= App::resolve(Database::class);
$courses= $db->query('SELECT  places, courses.id AS id, courses.course_name AS course, subjects.subject_name AS subject
FROM courses
JOIN courses_subjects ON courses.id = courses_subjects.course_id 
JOIN subjects ON courses_subjects.subject_id = subjects.id')->get();

view('courses/index.view.php',[
    'heading'=>'Courses',
    'coursesData'=>organizeCourses($courses),
]);