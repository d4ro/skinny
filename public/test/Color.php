<?php

/**
 * Description of Color
 *
 * @author Daro
 */
class Model_BB_Color extends Model_BB {
    /*
     * <span style="color:#3366ff">
     */

    public function __construct($code) {
        $this->_htmlTag = 'span';
        $this->_tag = 'color';
        $this->_hasEndHtmlTag = true;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

    public function _parseInner(&$code, $forceText) {
        $this->_htmlAttrs = array('style' => 'color:' . $this->_attr);
        return self::internalParse($code, $forceText);
    }

}