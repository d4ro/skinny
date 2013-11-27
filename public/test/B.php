<?php

/**
 * Description of B
 *
 * @author Daro
 */
class Model_BB_B extends Model_BB {

    public function __construct($code) {
        $this->_htmlTag = 'b';
        $this->_tag = 'b';
        $this->_hasEndHtmlTag = true;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

}