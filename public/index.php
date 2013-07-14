<?php

chdir(dirname(__DIR__) . '/app');

// Setup autoloading
require 'library/skinny/Application.php';
$application = new Skinny\Application();
$application->run();