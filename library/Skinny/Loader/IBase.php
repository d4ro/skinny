<?php

namespace Skinny\Loader;

/**
 * Description of IBase
 *
 * @author Daro
 */
interface IBase {
    
    public function isRegistered();

    public function register();

    public function load($class_name);
}