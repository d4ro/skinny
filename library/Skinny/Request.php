<?php

namespace Skinny;

/**
 * Description of Request
 *
 * @author Daro
 */
class Request {

    protected $_steps;
    protected $_current;
    protected $_router;

    public function __construct() {
        $this->_steps = array();
        $this->_current = -1;
    }

    /**
     * 
     * @return Request\Step
     */
    public function current() {
        if (empty($this->_steps))
            return null;
        return $this->_steps[$this->_current];
    }

    /**
     * 
     * @return Request\Step
     */
    public function last() {
        return $this->current();
    }

    /**
     * 
     * @return Request\Step
     */
    public function first() {
        if (empty($this->_steps))
            return null;
        return $this->_steps[0];
    }

    /**
     * 
     * @return Request\Step
     */
    public function previous() {
        if (empty($this->_steps))
            return null;
    }

    public function length() {
        return $this->_current + 1;
    }

    public function get($index) {
        if ($index < 0 || $index > $this->_current)
            throw new \OutOfRangeException;
        return $this->_steps[$index];
    }

    protected function _step(Request\Step $step) {
        $this->current()->next($step)->previous($this->current());
        $this->_steps[] = $step;
        ++$this->_current;
        $step->resolve($this->getRouter());
    }

    public function step($path, $params = array()) {
        $this->_step(new Step($path, $params));
    }

    public function setRouter(Router\IBase $router) {
        if (!$router instanceof Router\IBase)
            throw new \InvalidArgumentException;
        $this->_router = $router;
    }

    public function getRouter() {
        if (null ===($this->_router))
            $this->_router = Router::getInstance();
        return $this->_router;
    }

}