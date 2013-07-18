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

    public function __construct($config = array()) {
        $this->_config = ($config instanceof Store) ? $config : new Store($config);
    }

    public function register() {
        spl_autoload_register(array($this, 'load'));
    }

    public abstract function load($class_name);
}