<?php

namespace Skinny;

/**
 * Description of Router
 *
 * @author Daro
 */
class Router {

    protected $_action_path;
    protected $_cache_path;
    protected $_config;

    public function __construct($action_path, $cache_path, $config = array()) {
        $this->_action_path = $action_path;
        $this->_cache_path = $cache_path;
        $this->_config = ($config instanceof Store) ? $config : new Store($config);
    }

    public function getRoute($path) {
        
    }

}
