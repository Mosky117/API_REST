<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path){
    return BASE_PATH . $path;
}

function urlIs($value){
    return $_SERVER['REQUEST_URI'] === $value;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function organizeCourses($courses){

    $coursesData = [];

    foreach ($courses as $course) {
        $courseId = $course['id'];
        $courseName = $course['course'];
        $subject = $course['subject'];

        if (!array_key_exists($courseId, $coursesData)) {
            $coursesData[$courseId] = [
                'id'=>$course['id'],
                'course_name' => $courseName,
                'subjects' => [],
                'places' => $course['places']
            ];
        }

        if (!in_array($subject, $coursesData[$courseId]['subjects'])) {
            $coursesData[$courseId]['subjects'][] = $subject;
        }
    }
    return $coursesData;
}