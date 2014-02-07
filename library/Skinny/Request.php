<?php

namespace Skinny;

/**
 * Description of Request
 *
 * @author Daro
 */
class Request {

    protected $_steps;
    protected $_stepCount;
    protected $_current;
    protected $_router;

    public function __construct() {
        $this->_steps = array();
        $this->_stepCount = 0;
        $this->_current = -1;
    }

    /**
     * 
     * @return Request\Step
     */
    public function current() {
        if ($this->_current < 0 || $this->_stepCount <= $this->_current)
            return null;
        return $this->_steps[$this->_current];
    }

    /**
     * 
     * @return Request\Step
     */
    public function last() {
        return $this->_steps[$this->_stepCount - 1];
    }

    /**
     * 
     * @return Request\Step
     */
    public function first() {
        if ($this->_stepCount < 1)
            return null;
        return $this->_steps[0];
    }

    /**
     * 
     * @return Request\Step
     */
    public function previous() {
        if ($this->_current < 1)
            return null;
        return $this->_steps[$this->_current - 1];
    }

    /**
     * 
     * @param Request\Step $step
     * @return Request\Step
     */
    public function next($step = null) {
        if (null === $step) {
            if ($this->_current < $this->_stepCount - 1)
                return $this->_steps[$this->_current + 1];
            return null;
        }

        $this->_steps[$this->_current + 1] = $step;
        ++$this->_stepCount;

        $current = $this->current();
        if (null !== $current)
            $current->next($step)->previous($current);
        else
            ++$this->_current;
        return $step;
    }

    /* public function length() {
      return count($this->_steps);
      } */

    /* public function get($index) {
      if ($index < 0 || $index >= $this->_stepCount)
      throw new \OutOfRangeException;
      return $this->_steps[$index];
      } */

    // tego na razie nie ruszamy, ale będzie do zastąpienia przez next() i process()
//    protected function _step(Request\Step $step) {
//        $current = $this->current();
//        if (null !== $current)
//            $current->next($step)->previous($current);
//        $this->_steps[] = $step;
//        ++$this->_current;
//        $step->resolve($this->getRouter());
//    }
    // tego na razie nie ruszamy, ale będzie do zastąpienia przez next() i process()
//    public function step($path, $params = array()) {
//        $this->_step(new Request\Step($path, $params));
//    }

    public function proceed() {
        $current = $this->current();
        if (null != $current)
            $current->setProcessed(true);
        ++$this->_current;
    }

    public function isProcessed() {
        $current = $this->current();
        return(null === $current || $current->isProcessed() && null === $current->next());
    }

    public function isResolved() {
        $current = $this->current();
        //if(null === $current && ($current = $this->next()))
        return(null === $current || $current->isResolved());
    }

    public function resolve() {
        $current = $this->current();
        if (null === $current)
            return;

        if ($current->isResolved()) {
            if (null !== $current->next()) {
                ++$this->_current;
                $current = $this->current();
            }
            else
                return;
        }

        $current->resolve($this->getRouter());
    }

    public function setRouter(Router\RouterInterface $router) {
        if (!$router instanceof Router\RouterInterface)
            throw new \InvalidArgumentException;
        $this->_router = $router;
    }

    public function getRouter() {
        if (null === $this->_router)
            $this->_router = Router::getInstance();
        $this->_router->setRequest($this);
        return $this->_router;
    }

}