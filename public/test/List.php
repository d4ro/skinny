<?php

/**
 * Description of List
 *
 * @author Daro
 */
class Model_BB_List extends Model_BB implements ArrayAccess {

    public function __construct($list = null) {
        if (is_array($list))
            foreach ($list as $value)
                $this->Add($value);
    }

    protected $_list = array();

    protected function _parse($code) {
        
    }

    public function Add($element) {
        if ($element instanceof Model_BB) {
            $this->_list[] = $element;
            $this->_remains = $element->getRemains();
        }
    }

    public function count() {
        return count($this->_list);
    }

    public function toBB() {
        $str = '';
        foreach ($this->_list as $item)
            $str .= $item->toBB();
        return $str;
    }

    public function toHtml() {
        $str = '';
        foreach ($this->_list as $item)
            $str .= $item->toHtml();
        return $str;
    }

    public function offsetExists($offset) {
        return isset($this->_list[$offset]);
    }

    public function offsetGet($offset) {
        return $this->_list[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->_list[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->_list[$offset]);
    }

}