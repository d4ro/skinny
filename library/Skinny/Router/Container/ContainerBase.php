<?php

namespace Skinny\Router\Container;

/**
 * Klasa bazowa kontenera na wyliczone części składowe zapytania do aplikacji.
 *
 * @author Daro
 */
abstract class ContainerBase implements ContainerInterface {

    /**
     * Ścieżka żądania do akcji
     * @var string
     */
    protected $_action;

    /**
     * Części składowe ścieżki do akcji
     * @var array
     */
    protected $_actionParts;

    /**
     * Głębokość ścieżki do akcji
     * @var integer
     */
    protected $_actionDepth;

    /**
     * Czy akcja docelowa zgadza się z wywoływaną
     * @var boolean
     */
    protected $_actionMatch;

    /**
     * Argumenty zapytania
     * @var array
     */
    protected $_args;

    /**
     * Ilość argumentów zapytania
     * @var integer
     */
    protected $_argsCount;

    /**
     * Parametry zapytania
     * @var array
     */
    protected $_params;

    /**
     * Ilość parametrów zapytania
     * @var integer
     */
    protected $_paramsCount;

    /**
     * Konstruktor inicjujący wartości domyślne.
     */
    public function __construct() {
        $this->_action = '';
        $this->_actionParts = array();
        $this->_actionDepth = 0;
        $this->_actionMatch = false;
        $this->_args = array();
        $this->_argsCount = 0;
        $this->_params = array();
        $this->_paramsCount = 0;
    }

    /**
     * Pobiera ścieżkę akcji
     * @return string
     */
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

    public function getArgsCount() {
        return $this->_argsCount;
    }

    public function getParams() {
        return $this->_params;
    }

    public function getParamsCount() {
        return $this->_paramsCount;
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
