<?php

require_once '../../library/Skinny/Store.php';
require_once '../../library/Skinny/Router/RouterInterface.php';
require_once '../../library/Skinny/Router.php';
require_once '../../library/Skinny/Router/Container/ContainerInterface.php';
require_once '../../library/Skinny/Router/Container/ContainerAbstract.php';
require_once '../../library/Skinny/Request/Step.php';

$router = new \Skinny\Router('../../app/Action', '', array(
            'base_path' => '/x/y/z'
        ));
$step = new \Skinny\Request\Step('/x/y/z/a/b/c/d');
$step->resolve($router);