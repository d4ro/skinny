<?php

namespace Skinny;

/**
 * Description of Loader
 *
 * @author Daro
 */
class Loader {

    protected $_loaders;
    protected $_names;
    protected $_action_path;
    protected $_model_path;
    protected $_library_path;

    public function __construct($action_path, $model_path, $library_path) {
        $this->_loaders = array();
        $this->_action_path = $action_path;
        $this->_model_path = $model_path;
        $this->_library_path = $library_path;
    }

    public function putLoader(Loader\LoaderInterface $loader, $name, $priority = 5) {
        if (is_array($loader)) {
            foreach ($loader as $key => $instance)
                $this->putLoader($instance, $name . $key, $priority);
            return;
        }

        if (isset($this->_names[$name]))
            throw new \InvalidArgumentException('Loader named "' . $name . '" has already been put.');

        $p = $priority * 100;
        for ($i = $p; $i < $p + 100; $i++) {
            if (!isset($this->_loaders[$i])) {
                $this->_loaders[$i] = $loader;
                $this->_names[$name] = $i;
                return;
            }
        }

        throw new \OverflowException('Loader named "' . $name . '" cannot be put with priority ' . $priority . '. Container is full.');
    }

    public function register($name = null) {
        // TODO: sortowanie po kluczach $this->_loaders
        $keys = array_keys($this->_loaders);
        sort($keys);
        $loaders = array();
        foreach ($keys as $key) {
            $loaders[$key] = $this->_loaders[$key];
        }
        $this->_loaders = $loaders;

        if (null === ($name)) {
            foreach ($this->_loaders as $loader) {
                if (!$loader->isRegistered())
                    $loader->register();
            }
        } else {
            $names = (array) $name;
            foreach ($names as $loader) {
                if (isset($this->_names[$loader])) {
                    if (!$this->_loaders[$this->_names[$loader]]->isRegistered())
                        $this->_loaders[$this->_names[$loader]]->register();
                } else
                    throw new \InvalidArgumentException('Loader named "' . $loader . '" has not been put to the container.');
            }
        }
    }

    public function initLoaders($loaders, $priority = 5) {
        $loaders = (array) $loaders;
        include_once __DIR__ . '/Loader/Standard.php';
        if (isset($loaders['standard'])) {
            $class = new Loader\Standard($this->_action_path, $this->_model_path, $this->_library_path, $loaders['standard']);
            unset($loaders['standard']);
        } else {
            $class = new Loader\Standard($this->_action_path, $this->_model_path, $this->_library_path);
        }
        $this->putLoader($class, 'standard', $priority);

        foreach ($loaders as $name => $config) {
            switch ($name) {
                case 'namespace':
                    $path = 'Skinny/Loader/NSpace.php?Skinny\Loader\NSpace';
                    break;
                case 'prefix':
                    $path = 'Skinny/Loader/Prefix.php?Skinny\Loader\Prefix';
                    break;
                default:
                    $path = $name;
                    break;
            }
            $parts = explode('?', $path);
            if ($parts > 1) {
                $file = array_shift($parts);
                require_once $file;
            }
            $class_name = array_shift($parts);
            $class = new $class_name($this->_action_path, $this->_model_path, $this->_library_path, $config);
            $this->putLoader($class, $name, $priority);
        }
    }

}