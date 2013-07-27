<?php

require_once 'Skinny\Loader\IBase.php';
require_once 'Skinny\Store.php';

namespace Skinny\Loader;

use Skinny\Store;

/**
 * Description of Base
 *
 * @author Daro
 */
abstract class Base implements IBase {

    protected $_config;
    protected $_action_path;
    protected $_model_path;
    protected $_library_path;

    public function __construct($action_path, $model_path, $library_path, $config = array()) {
        $this->_config = ($config instanceof Store) ? $config : new Store($config);
        $this->_action_path = $action_path;
        $this->_model_path = $model_path;
        $this->_library_path = $library_path;
    }

    public function register() {
        spl_autoload_register(array($this, 'load'));
    }

    public abstract function load($class_name);
}