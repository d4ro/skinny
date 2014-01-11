<?php

//chdir(dirname(__DIR__));

// Setup and run application
require '../library/Skinny/Application.php';
$application = new Skinny\Application('../config');
$application->run();

die('Executed properly.');