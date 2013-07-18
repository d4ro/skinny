<?php

require_once 'Skinny\Loader\Base.php';

namespace Skinny\Loader;


/**
 * Description of Standard
 *
 * @author Daro
 */
class Standard extends Base {

    public function register() {
        // ustaw ścieżki include
        // zarejestruj standardowy loader
        spl_autoload_register();
    }

    public function load($class_name) {
        
    }

}