<?php

namespace Skinny;

use Skinny\Router\Container;

//require_once 'Skinny/Router/RouterInterface.php';

/**
 * Description of Router
 *
 * @author Daro
 */
class Router implements Router\RouterInterface {

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

    public function getRoute($path, Container\ContainerInterface $container = null) {
        // jeżeli nie ma gdzie składować wyników, tworzymy nowy kontener
        if (null === $container)
            $container = new Container();

        // pobieramy ścieżkę bazową aplikacji
        $base_path = $this->getBasePath();
        if ($base_path && strpos($path, "/$base_path") === 0) {
            $path = substr($path, strlen($base_path) + 1);
        }

        // ustawiamy argumenty wywołania
        $path = ltrim($path, '/');
        $args = explode('/', $path);
        $container->setArgs($args);

        // określamy akcję
        // TODO: akcja nie odnaleziona i co wtedy?
        $action_length = $this->findAction($args);
        $action_parts = array_slice($args, 0, $action_length);
        $container->setAction($action_parts);

        // określamy parametry
        $params = array();
        var_dump($action_length, $args);
        for ($i = $action_length; $i < count($args); $i += 2) {
            if (isset($args[$i + 1]))
                $params[$args[$i]] = $args[$i + 1];
        }
        $container->setParams($params);

        return $container;
    }

    public function getBasePath() {
        if (null === $this->_base_path)
            $this->_base_path = trim($this->_config->base_path('/', true), '/');
        return $this->_base_path;
    }

    public function findAction($args) {
        // TODO
        // bardzo TODO
    }

}
