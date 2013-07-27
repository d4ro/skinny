<?php

namespace Skinny;

/* require_once 'Skinny/Application/Components.php';
  require_once 'Skinny/Store.php';
  require_once 'Skinny/Router.php';
  require_once 'Skinny/Loader/Standard.php';
  require_once 'Skinny/Loader/NSpace.php';
  require_once 'Skinny/Loader/Prefix.php'; */

/**
 * Description of Application
 *
 * @author Daro
 */
class Application {

    protected $_components;
    protected $_config;
    protected $_env;
    protected $_loaders;

    public function __construct($config_path = 'config') {
        // config
        include_once __DIR__ . '/Store.php';
        $env = isset($_SERVER['APPLICATION_ENV']) ? $_SERVER['APPLICATION_ENV'] : 'production';
        $config = new Store(include $config_path . '/global.conf.php');
        if (file_exists($local_config = $config_path . '/' . $env . '.conf.php'))
            $config->merge(include $local_config);

        $this->_env = $env;
        $this->_config = $config;

        // internal include-driven loader
        set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__DIR__) . '/' . $this->_config->path->library('library')));

        // loader
        // bootstrap
        $this->_components = new Application\Components($this->_config);
        $this->_components->setInitializers($this->_config->components->toArray());
        $this->_components->initialize();
    }

    public function getConfig($key = null) {
        if (is_null($key))
            return $this->_config;

        return $this->_config->$key(null);
    }

    public function Components() {
        return $this->_components;
    }

    public function run() {
        $router = new Router(
                        $this->_config->path->action('app/Action', true),
                        $this->_config->path->cache('cache/skinny', true),
                        $this->_config->router());
    }

}