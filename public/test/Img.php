<?php

/**
 * Description of Img
 *
 * @author Daro
 */
class Model_BB_Img extends Model_BB {

    public function __construct($code) {
        $this->_htmlTag = 'img';
        $this->_tag = 'img';
        $this->_hasEndHtmlTag = false;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

    public function _parseInner(&$code, $forceText) {
        $inner = self::internalParse($code, true);
        $code = $inner->getRemains();
        $this->_content = $inner->toBB();
        $this->_htmlAttrs = array('src' => $this->_content);
        return null;
    }

}