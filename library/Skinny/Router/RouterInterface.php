<?php

namespace Skinny\Router;

/**
 *
 * @author Daro
 */
interface RouterAbstract {

    function getRoute($path, Container\IBase $container = null);
}