<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'database'=>[
        'host'=>$_ENV['CONNECTION'],
        'port'=>$_ENV['PORT'],
        'dbname'=>$_ENV['DB_NAME'],
        'charset'=>$_ENV['CHARSET'],
        'password'=>$_ENV['PASSWORD'],
        'username'=>$_ENV['USERNAME'],
    ],
];