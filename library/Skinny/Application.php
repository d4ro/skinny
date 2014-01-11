<?php

namespace Skinny;

use Skinny\Application\Components;

/**
 * Główna klasa przygotowująca aplikację bazującą na podstawce Skinny.
 * Odpowiada za przygotowanie konfiguracji, ustawienie loaderów, komponentów, ustalenie routingu i wykonanie akcji.
 *
 * @author Daro
 */
class Application {

    protected $_components;
    protected $_config;
    protected $_env;
    protected $_loader;
    protected $_settings;

    /**
     * Konstruktor obiektu aplikacji Skinny
     * @param string $config_path ścieżka do katalogu z konfiguracją względem miejsca, w którym tworzona jest instancja
     */
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
        set_include_path(dirname(__DIR__) . PATH_SEPARATOR . $this->_config->paths->library('library', true) . PATH_SEPARATOR . get_include_path());

        // settings: only if enabled
        if ($config->settings->enabled(false)) {
            require_once 'Skinny/Settings.php';
            $this->_settings = new Settings($config_path);
        }

        // loader
        require_once 'Skinny/Loader.php';
        $this->_loader = new Loader($this->_config->paths);
        $this->_loader->initLoaders($this->_config->loaders->toArray());
        $this->_loader->register();

        // bootstrap
        $this->_components = new Components($this->_config);
        $this->_components->setInitializers($this->_config->components->toArray());
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
                        $this->_config->paths->content('content', true),
                        $this->_config->paths->cache('cache', true),
                        $this->_config->router()
        );
    }

}