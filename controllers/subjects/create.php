<?php

use Core\App;
use Core\Database;

$db=App::resolve(Database::class);

view('subjects/create.view.php',[
    'heading'=>'New Subject',
    'errors'=>[]
]);