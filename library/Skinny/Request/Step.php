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
class Step implements Router\Container\IBase {

    protected $_path;
    protected $_params;
    protected $_next;
    protected $_previous;

    public function __construct($path, $params = array()) {
        $this->_path = $path;
        $this->_params = $params;
    }

    public function next(Step $step = null) {
        if (!is_null($step))
            $this->_next = $step;
        return $this->_next;
    }

    public function previous(Step $step = null) {
        if (!is_null($step))
            $this->_previous = $step;
        return $this->_previous;
    }

    public function resolve(Router\IBase $router) {
        $router->getRoute($path, $this);
    }

    public function getAction() {
        
    }

    public function getAllParams() {
        
    }

    public function getParam($name, $default) {
        
    }

    public function getAllArgs() {
        
    }

    public function getArg($index, $default) {
        
    }

    public function getArgsCount() {
        
    }

}