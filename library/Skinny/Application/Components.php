<?php

namespace Skinny\Application;

/**
 * Description of Components
 *
 * @author Daro
 */
class Components {

    protected $_config;
    protected $_components;
    protected $_initializers;

    public function __construct($config) {
        $this->_components = array();
        $this->_initializers = array();
        $this->_config = $config;
    }

    public function __get($name) {
        return $this->getComponent($name);
    }

    public function getConfig($key = null) {
        if (is_null($key))
            return $this->_config;

        return $this->_config->$key(null);
    }

    public function hasComponent($name) {
        return isset($this->_components[$name]) || isset($this->_initializers[$name]);
    }

    public function getComponent($name) {
        if ($this->isInitialized($name))
            return $this->_components[$name];

        return null;
    }

    public function isInitialized($name) {
        return isset($this->_components[$name]) && !$this->hasInitializer($name);
    }

    public function areInitialized($name = null) {
        if (is_null($name))
            return empty($this->_initializers);

        $names = (array) $name;
        foreach ($names as $component) {
            if (!$this->isInitialized($component))
                return false;
        }
        return true;
    }

    public function setInitializers($initializers = array()) {
        if (!empty($initializers))
            foreach ($initializers as $name => $initializer) {
                if (is_numeric($name))
                    throw new \InvalidArgumentException('Component name "' . $name . '" cannot be numeric.');
                if (!$initializer instanceof \Closure)
                    throw new \InvalidArgumentException('Component name "' . $name . '" initializer is not a function.');
                $this->_initializers[$name] = $initializer;
            }
    }

    public function hasInitializer($name) {
        return isset($this->_initializers[$name]) && $this->_initializers[$name] instanceof \Closure;
    }

    public function initialize($name = null) {
        if (is_null($name))
            $name = array_keys($this->_initializers);

        $names = (array) $name;
        foreach ($names as $component) {
            if ($this->isInitialized($component))
                throw new \InvalidArgumentException('Component name "' . $component . '" has already been initialized.');

            if (!$this->hasInitializer($component))
                throw new \InvalidArgumentException('Component name "' . $component . '" does not have proper initializer.');

            $initializer = $this->_initializers[$component];
            $result = $initializer();
            if (is_null($result))
                throw new \BadFunctionCallException('Component name "' . $component . '" initializer does not return object.');

            $this->_components[$component] = $result;
            unset($this->_initializers[$component]);
        }
    }

}
