<?php

namespace Skinny;

/**
 * Description of Action
 *
 * @author Daro
 */
abstract class Action {

    protected $_request;

    public function __construct(Request $request) {
        $this->_request = $request;
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
        return $this->getRequest()->current()->getArgsCount();
    }

    public function getArg($index, $default = null) {
        return $this->getRequest()->current()->getArg($index, $default);
    }

    public function getAllArgs() {
        return $this->getRequest()->current()->getAllArgs();
    }

    public function getParam($name, $default = null) {
        return $this->getRequest()->current()->getParam($name, $default);
    }

    public function getAllParams() {
        return $this->getRequest()->current()->getAllParams();
    }

    public function getAction() {
        return $this->getRequest()->current()->getAction();
    }

    public function getRequest() {
        return $this->_request;
    }

    public function getBasePath() {
        return '/' . $this->getRequest()->getRouter()->getBasePath();
    }

}