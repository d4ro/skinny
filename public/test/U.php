<?php

/**
 * Description of U
 *
 * @author Daro
 */
class Model_BB_U extends Model_BB {

    public function __construct($code) {
        $this->_htmlTag = 'u';
        $this->_tag = 'u';
        $this->_hasEndHtmlTag = true;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

}