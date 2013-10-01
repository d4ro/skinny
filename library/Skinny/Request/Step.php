<?php

namespace Skinny\Request;

use Skinny\Router;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Step
 *
 * @author Daro
 */
class Step extends Router\Container\ContainerBase {

    /**
     *
     * @var string
     */
    protected $_path;

    /**
     *
     * @var Step
     */
    protected $_next;

    /**
     *
     * @var Step
     */
    protected $_previous;

    public function __construct($path, $params = array()) {
        $this->_path = $path;
        $this->_params = $params;
        $this->_actionMatch = true;
    }

    public function next(Step $step = null) {
        if (null !== $step)
            $this->_next = $step;
        return $this->_next;
    }

    public function previous(Step $step = null) {
        if (null !== $step)
            $this->_previous = $step;
        return $this->_previous;
    }

    public function first() {
        $first = $this;
        while ($previous = $first->previous())
            $first = $previous;
        return $first;
    }

    public function resolve(Router\RouterInterface $router) {
        $router->getRoute($this->_path, $this);
        // TODO: to jest chyba źle - sprawdzenie chyba powinno być z pierwszym a nie z poprzednim:
        if (null !== $this->_previous && $this->_action !== $this->_previous->_action)
            $this->_actionMatch = false;
    }

    public function getParam($name, $default = null) {
        if (isset($this->_params[$name]))
            return $this->_params[$name];
        return $default;
    }

    public function getArg($index, $default = null) {
        if (isset($this->_args[$index]))
            return $this->_args[$index];
        return $default;
    }

    public function getArgsCount() {
        return $this->_argsCount;
    }

}