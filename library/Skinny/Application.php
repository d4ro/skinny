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

    protected $_env;
    protected $_config;
    protected $_settings;
    protected $_loader;
    protected $_components;
    protected $_router;
    protected $_request;
    protected $_response;

    /**
     * Konstruktor obiektu aplikacji Skinny
     * @param string $config_path ścieżka do katalogu z konfiguracją względem miejsca, w którym tworzona jest instancja
     */
    public function __construct($config_path = 'config') {
        // config
        require_once __DIR__ . '/Store.php';
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

        //router
        $this->_router = new Router(
                $this->_config->paths->content('content', true), $this->_config->paths->cache('cache', true), $this->_config->router()
        );

        //request
        $this->_request = new Request();
    }

    public function getEnvironment() {
        return $this->_env;
    }

    public function getConfig($key = null) {
        if (null === $key)
            return $this->_config;

        return $this->_config->$key(null);
    }

    public function getSettings($key = null) {
        if (null === $key)
            return $this->_settings;

        return $this->_settings->$key(null);
    }

    public function getComponents() {
        return $this->_components;
    }

    public function getComponent($name) {
        // TODO
    }

    public function __get($name) {
        return $this->getComponent($name);
    }

    public function getRouter() {
        return $this->_router;
    }

    public function getRequest() {
        return $this->_request;
    }

    public function getResponse() {
        return $this->_response;
    }

    public function run($request_url = null, $params = array()) {
        if (null === $request_url)
            $request_url = $_SERVER['REQUEST_URI'];

        $this->_request->next(new Request\Step($request_url, $params));
        if (null === $this->_response)
            $this->_response = new Response\Http();
        $this->_request->setResponse($this->_response);

        while (!$this->_request->isProcessed()) {
            try {

                if (!$this->_request->isResolved())
                    $this->_request->resolve();

                $action = $this->_request->current()->getAction();
                if (null === $action) {
                    $notFoundAction = $this->_config->actions->notFound(null);
                    if (null === $notFoundAction) {
                        $this->_request->next(new Request\Step($notFoundAction, ['error' => 'notFound', 'requestStep' => $this->_request->current()]));
                        $this->_request->proceed();
                        continue;
                    }
                    else
                    // TODO: błąd 404
                        throw new Action\Exception('Cannot find action corresponding to URL "' . $this->_request->current()->getRequestUrl() . '".');
                }

                if (!($action instanceof Action))
                    throw new Action\Exception('Action found is not an instance of the Skinny\Action base class.');

                $action->_permit();

                if ($this->isRequestForwarded())
                    continue;

                if (!$action->getUsage()->hasAny()) {
                    $errorAction = $this->_config->actions->error(null);
                    if (null !== $errorAction) {
                        $this->_request->next(new Request\Step($errorAction, ['error' => 'accessDenied', 'requestStep' => $this->_request->current()]));
                        $this->_request->proceed();
                        continue;
                    }
                    else
                    // TODO: 403
                        throw new Action\Exception('Access denied');
                }

                $action->_prepare();

                if ($this->isRequestForwarded())
                    continue;

                $action->_action();

                if ($this->isRequestForwarded())
                    continue;

                $action->_cleanup();

                $this->_request->proceed();
            } catch (\Exception $e) {
                $errorAction = $this->_config->actions->error(null);
                if (null === $errorAction) {
                    $this->_request->next(new Request\Step($errorAction, ['error' => 'exception', 'requestStep' => $this->_request->current(), 'exception' => $e]));
                    $this->_request->proceed();
                    continue;
                }
                else
                    throw $e;
            }
        }

        $this->_response->respond();
    }

    protected function isRequestForwarded() {
        $forwarded = null !== $this->_request->next();
        if ($forwarded)
            $this->_request->proceed();
        return $forwarded;
    }

}