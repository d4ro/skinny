<?php

namespace Skinny;

/**
 * Description of Action
 *
 * @author Daro
 */
abstract class Action {

    public function __construct() {
        $this->init();
    }

    public function init() {
        
    }

    public function preDispatch() {
        
    }

    abstract public function action();

    public function postDispatch() {
        
    }

    public function getArgsCount() {
        
    }

    public function getArg($index, $default = null) {
        
    }

    public function getAllArgs() {
        
    }

    public function getParam($name, $default = null) {
        
    }

    public function getAllParams() {
        
    }

    public function getAction() {
        
    }

}