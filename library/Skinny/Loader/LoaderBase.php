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
    protected $_paths;

    public function __construct($paths, $config = array()) {
        $this->_config = ($config instanceof Store) ? $config : new Store($config);
        $this->_registered = false;
        $this->_paths = $paths;
    }

    public function isRegistered() {
        return $this->_registered;
    }

    public function register() {
        spl_autoload_register(array($this, 'load'));
        $this->_registered = true;
    }

    public abstract function load($class_name);
}