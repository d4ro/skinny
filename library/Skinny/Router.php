<?php

namespace Skinny;

use Skinny\Router\Container;

/**
 * Description of Router
 *
 * @author Daro
 */
class Router implements Router\IBase {

    protected $_action_path;
    protected $_cache_path;
    protected $_base_path;

    /**
     *
     * @var Store
     */
    protected $_config;

    /**
     *
     * @var Router
     */
    protected static $_instance;

    /**
     * 
     * @return Router
     */
    public static function getInstance() {
        return static::$_instance;
    }

    public function __construct($action_path, $cache_path, $config = array()) {
        $this->_action_path = $action_path;
        $this->_cache_path = $cache_path;
        $this->_config = ($config instanceof Store) ? $config : new Store($config);

        static::$_instance = $this;
    }

    public function getRoute($path, Container\IBase $container = null) {
        if (is_null($container))
            $container = new Container ();

        $base_path = $this->getBasePath();
        if ($base_path && strpos($path, "/$base_path/") === 0) {
            // jest base_path
        }

        return $container;
    }

    public function getBasePath() {
        if (is_null($this->_base_path))
            $this->_base_path = trim($this->_config->base_path('/', true), '/');
        return $this->_base_path;
    }

}
