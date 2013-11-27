<?php

/**
 * Description of I
 *
 * @author Daro
 */
class Model_BB_I extends Model_BB {

    public function __construct($code) {
        $this->_htmlTag = 'i';
        $this->_tag = 'i';
        $this->_hasEndHtmlTag = true;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

}