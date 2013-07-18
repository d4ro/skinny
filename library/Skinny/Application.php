<?php

namespace Skinny;

require_once 'Skinny/Store.php';
require_once 'Skinny/Router.php';
require_once 'Skinny/Loader/Standard.php';
require_once 'Skinny/Loader/NSpace.php';
require_once 'Skinny/Loader/Prefix.php';

/**
 * Description of Application
 *
 * @author Daro
 */
class Application {

    protected $_config;
    protected $_env;
    protected $_loaders;

    public function __construct($config_path = 'config') {
        // config
        $env = isset($_SERVER['APPLICATION_ENV']) ? $_SERVER['APPLICATION_ENV'] : 'development';
        $config = new Store(include $config_path . '/global.conf.php');
        if (file_exists($local_config = $config_path . '/' . $env . '.conf.php'))
            $config->merge(include $local_config);

        $this->_env = $env;
        $this->_config = $config;
        
        // loader
        
        // bootstrap
    }

    public function run() {
        $router = new Router(
                        $this->_config->path->action('app/Action', true),
                        $this->_config->path->cache('cache/skinny', true),
                        $this->_config->router());
    }

}