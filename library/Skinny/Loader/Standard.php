<?php

namespace Skinny\Loader;

require_once 'Skinny\Loader\LoaderBase.php';

/**
 * Description of Standard
 *
 * @author Daro
 */
class Standard extends LoaderBase {

    public function register() {
        // ustaw ścieżki include
        set_include_path(
                implode(PATH_SEPARATOR, array(
                    $this->_library_path,
                    $this->_logic_path,
                    $this->_action_path,
                    implode(PATH_SEPARATOR, $this->_config->path->toArray()),
                    get_include_path()
                )));
        // zarejestruj standardowy loader
        spl_autoload_register();
    }

    public function load($class_name) {
        // NOT USED
    }

}