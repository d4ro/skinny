<?php

/**
 * Description of Text
 *
 * @author Daro
 */
class Model_BB_Text extends Model_BB {

    public function toBB() {
        return $this->_content;
    }
    
    public function toHtml() {
        return $this->_content;
    }

    protected function _parse($code) {
        $pos = strpos($code, '[', 1);
        if ($pos) {
            $this->_content = substr($code, 0, $pos);
            $this->_remains = substr($code, $pos);
        } else {
            $this->_content = $code;
        }
    }

}