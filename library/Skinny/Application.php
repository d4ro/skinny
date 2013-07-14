<?php

namespace Skinny;

require_once 'library/skinny/Store.php';
require_once 'library/skinny/Router.php';

/**
 * Description of Application
 *
 * @author Daro
 */
class Application {

    protected $_config;
    protected $_env;

    public function __construct($config_path = 'config') {
        $env = isset($_SERVER['APPLICATION_ENV']) ? $_SERVER['APPLICATION_ENV'] : 'development';
        $config = new Store(include $config_path . '/global.conf.php');
        if (file_exists($local_config = $config_path . '/' . $env . '.conf.php'))
            $config->merge(include $local_config);

        $this->_env = $env;
        $this->_config = $config;
    }

    public function run() {
        $router = new Router(
                        $this->_config->path->action('action', true),
                        $this->_config->path->cache('cache/skinny', true),
                        $this->_config->router());
    }

}