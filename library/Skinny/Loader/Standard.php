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
        set_include_path(implode(PATH_SEPARATOR,
                $this->_library_path,
                $this->_model_path,
                $this->_action_path,
                implode(PATH_SEPARATOR, $this->_config->path->toArray()),
                get_include_path()
                ));
        // zarejestruj standardowy loader
        spl_autoload_register();
    }

    public function load($class_name) {
        
    }

}