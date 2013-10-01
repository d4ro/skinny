<?php

namespace Skinny;

use Skinny\Application\Components;

/**
 * Description of Application
 *
 * @author Daro
 */
class Application {

    protected $_components;
    protected $_config;
    protected $_env;
    protected $_loader;
    protected $_settings;

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
        set_include_path(get_include_path() . PATH_SEPARATOR . $this->_config->path->library('library', true) . PATH_SEPARATOR . dirname(__DIR__));
        require_once 'Skinny/Settings.php';
        require_once 'Skinny/Loader.php';
        require_once 'Skinny/Application/Components.php';
        require_once 'Skinny/Router.php';

        $this->_settings = new Settings($config_path);

        // loader
        $this->_loader = new Loader(
                        $this->_config->path->action('app/Action', true),
                        $this->_config->path->logic('app/Logic', true),
                        $this->_config->path->library('library', true)
        );
        $this->_loader->initLoaders($this->_config->loader->toArray());
        $this->_loader->register();

        // bootstrap
        $this->_components = new Components($this->_config);
        $this->_components->setInitializers($this->_config->components->toArray());

        //
    }

    public function getConfig($key = null) {
        if (null === $key)
            return $this->_config;

        return $this->_config->$key(null);
    }

    public function getComponents() {
        return $this->_components;
    }

    public function run() {
        $router = new Router(
                        $this->_config->path->action('app/Action', true),
                        $this->_config->path->cache('cache', true),
                        $this->_config->router()
        );
    }

}