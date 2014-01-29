<?php

namespace Skinny;

use Skinny\Router\Container;

//require_once 'Skinny/Router/RouterInterface.php';

/**
 * Router ma za zadanie przeparsować request url i porównać ze ścieżką akcji w celu określenia akcji do wykonania.
 *
 * @author Daro
 */
class Router implements Router\RouterInterface {

    protected $_content_path;
    protected $_cache_path;
    protected $_base_url;

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

    public function __construct($content_path, $cache_path, $config = array()) {
        $this->_content_path = $content_path;
        $this->_cache_path = $cache_path;
        $this->_config = ($config instanceof Store) ? $config : new Store($config);

        static::$_instance = $this;
    }

    public function getRoute($request_url, Container\ContainerInterface $container = null) {
        // jeżeli nie ma gdzie składować wyników, tworzymy nowy kontener
        if (null === $container)
            $container = new Container();

        // pobieramy ścieżkę bazową aplikacji
        $base_path = $this->getBaseUrl();
        if ($base_path && strpos($request_url, "/$base_path") === 0) {
            $request_url = substr($request_url, strlen($base_path) + 1);
        }

        // ustawiamy argumenty wywołania
        $request_url = ltrim($request_url, '/');
        $args = explode('/', $request_url);
        $container->resetArgs($args);

        // określamy akcję
        // TODO: akcja nie odnaleziona i co wtedy?
        $action_length = $this->findAction($args);
        $action_parts = array_slice($args, 0, $action_length);
        $container->setActionParts($action_parts);

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

    public function getBaseUrl() {
        if (null === $this->_base_url)
            $this->_base_url = trim($this->_config->base_path('/', true), '/');
        return $this->_base_url;
    }

    public function findAction($args) {
        // TODO
        // bardzo TODO
        // bardzo kurwa TODO
        // teraz to już kurwa trzeba to zrobić bo ja pierdole bez tego nie będzie działać w ogóle podstawka... czy zdajesz sobie z tego kurwa sprawę??? zrób to już i nie marudź!
    }

}