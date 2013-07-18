<?php

chdir(dirname(__DIR__));

// Setup and run application
require 'library/skinny/Application.php';
$application = new Skinny\Application();
$application->run();