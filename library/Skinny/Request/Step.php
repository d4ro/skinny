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
class Step implements Router\Container\ContainerInterface {

    protected $_path;
    protected $_params;
    protected $_next;
    protected $_previous;

    public function __construct($path, $params = array()) {
        $this->_path = $path;
        $this->_params = $params;
    }

    public function next(Step $step = null) {
        if (!null === ($step))
            $this->_next = $step;
        return $this->_next;
    }

    public function previous(Step $step = null) {
        if (!null === ($step))
            $this->_previous = $step;
        return $this->_previous;
    }

    public function resolve(Router\RouterAbstract $router) {
        $router->getRoute($path, $this);
    }

    public function getAction() {
        
    }

    public function getParams() {
        
    }

    public function getParam($name, $default) {
        
    }

    public function getArgs() {
        
    }

    public function getArg($index, $default) {
        
    }

    public function getArgsCount() {
        
    }

    public function setArgs($args) {
        
    }

}