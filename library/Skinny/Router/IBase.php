<?php

namespace Skinny\Router;

/**
 *
 * @author Daro
 */
interface IBase {

    function getRoute($path, Container\IBase $container = null);
}