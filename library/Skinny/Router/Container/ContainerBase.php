<?php

namespace Skinny\Router\Container;

/**
 * Description of ContainerBase
 *
 * @author Daro
 */
class ContainerBase implements ContainerInterface {

    protected $_action;
    protected $_actionParts;
    protected $_actionDepth;
    protected $_actionMatch;
    protected $_args;
    protected $_argsCount;
    protected $_params;
    protected $_paramsCount;

    public function getAction() {
        return $this->_action;
    }

    public function getActionDepth() {
        return $this->_actionDepth;
    }

    public function getActionMatch() {
        return $this->_actionMatch;
    }

    public function getActionParts() {
        return $this->_actionParts;
    }

    public function getArgs() {
        return $this->_args;
    }

    public function getParams() {
        return $this->_params;
    }

    public function setAction(array $actionParts) {
        $this->_actionParts = $actionParts;
        $this->_action = implode('/', $actionParts);
        $this->_actionDepth = count($actionParts);
    }

    public function setActionMatch(bool $actionMatch) {
        $this->_actionMatch = (bool) $actionMatch;
    }

    public function setArgs(array $args) {
        $this->_args = $args;
        $this->_argsCount = count($args);
    }

    public function setParams(array $params) {
        $this->_params = $params;
        $this->_paramsCount = count($params);
    }

}
