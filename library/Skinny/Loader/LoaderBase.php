<?php

namespace Skinny\Loader;

use Skinny\Store;

require_once 'Skinny\Loader\LoaderInterface.php';
require_once 'Skinny\Store.php';

/**
 * Description of LoaderBase
 *
 * @author Daro
 */
abstract class LoaderBase implements LoaderInterface {

    protected $_config;
    protected $_registered;
    protected $_action_path;
    protected $_logic_path;
    protected $_library_path;

    public function __construct($action_path, $logic_path, $library_path, $config = array()) {
        $this->_config = ($config instanceof Store) ? $config : new Store($config);
        $this->_registered = false;
        $this->_action_path = $action_path;
        $this->_logic_path = $logic_path;
        $this->_library_path = $library_path;
    }

    public function isRegistered() {
        return $this->_registered;
    }

    public function register() {
        spl_autoload_register(array($this, 'load'));
    }

    public abstract function load($class_name);
}