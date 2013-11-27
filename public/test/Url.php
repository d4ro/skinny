<?php

/**
 * Description of Url
 *
 * @author Daro
 */
class Model_BB_Url extends Model_BB {

    public function __construct($code) {
        $this->_htmlTag = 'a';
        $this->_tag = 'url';
        $this->_hasEndHtmlTag = true;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

    public function _parseInner(&$code, $forceText) {
        if (empty($this->_attr))
            $forceText = true;
        $content = self::internalParse($code, $forceText);
        if (empty($this->_attr))
            $this->_attr = $content->toBB();
        $this->_htmlAttrs = array('href' => $this->_attr);
        return $content;
    }

}