<?php

namespace Skinny\Loader;

use Skinny\Store;

require_once 'Skinny\Loader\IBase.php';
require_once 'Skinny\Store.php';

/**
 * Description of Base
 *
 * @author Daro
 */
abstract class Base implements IBase {

    protected $_config;
    protected $_registered;
    protected $_action_path;
    protected $_model_path;
    protected $_library_path;

    public function __construct($action_path, $model_path, $library_path, $config = array()) {
        $this->_config = ($config instanceof Store) ? $config : new Store($config);
        $this->_registered = false;
        $this->_action_path = $action_path;
        $this->_model_path = $model_path;
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