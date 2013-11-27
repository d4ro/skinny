<?php

/**
 * Description of BB
 *
 * @author Daro
 */
abstract class Model_BB {

    protected $_tag;
    protected $_hasEndTag;
    protected $_signAttr;
    protected $_attr;
    protected $_content;
    protected $_inner;
    protected $_remains;
    protected $_htmlTag;
    protected $_hasEndHtmlTag;
    protected $_htmlAttrs;

    public function __construct($code) {
        $this->_parse($code);
    }

    protected function _parse($code) {
        preg_match('/^\[' . $this->_tag . '([= ]?)([^\]]*)]/', $code, $match);
        $forceText = (!count($match));
        $start = $forceText ? 0 : strlen($match[0]);

        if (count($match))
            $this->_setAttr($match[1], $match[2]);

        $code = substr($code, $start);
        if (false === $code)
            $code = '';
        else
            $this->_inner = $this->_parseInner($code, $forceText);

        getRemains:
        if (!empty($this->_inner))
            $code = $this->_inner->getRemains();

        if (!strlen($code))
            return;

        preg_match('/^\[\/' . $this->_tag . '\]/', $code, $match);
        if (!count($match)) {
            if (!($this->_inner instanceof Model_BB_List))
                $this->_inner = new Model_BB_List(array($this->_inner));

            $this->_inner->Add(self::internalParse($code, true));
            goto getRemains;
        }

        $this->_remains = substr($code, strlen($match[0]));
        if (false === $this->_remains)
            $this->_remains = null;
    }

    public function _parseInner(&$code, $forceText) {
        return self::internalParse($code, $forceText);
    }

    protected function _setAttr($sign, $value) {
        $this->_attr = $value;
        $this->_signAttr = $sign;
    }

    protected function getRemains() {
        $remains = $this->_remains;
        $this->_remains = null;
        return $remains;
    }

    public function toBB() {
        $str = '[' . $this->_tag;
        if ($this->_attr)
            $str .= $this->_signAttr . $this->_attr;
        $str.=']';
        if ($this->_hasEndTag) {
            $str .= isset($this->_inner) ? $this->_inner->toBB() : $this->_content;
            $str .= '[/' . $this->_tag . ']';
        }

        return $str;
    }

    public function toHtml() {
        $str = '<' . $this->_htmlTag;
        if ($this->_htmlAttrs)
            foreach ($this->_htmlAttrs as $key => $value)
                $str .= ' ' . $key . '="' . $value . '"';
        $str.='>';
        if ($this->_hasEndHtmlTag)
            $str .= $this->_inner->toHtml() . '</' . $this->_htmlTag . '>';

        return $str;
    }

    protected static function internalParse($code, $forceText = false) {
        $list = new Model_BB_List();

        while (!empty($code) || $code === '0') {
            preg_match('/^\[(\/?)([^\[\]= ]+)([= ]?)([^\]]*)]/', $code, $match);
            // 0 - cały początkowy znacznik
            // 1 - ewentualny /
            // 2 - tag znacznika
            // 3 - znak = lub spacja do atrybutu
            // 4 - atrybut
            if (!count($match))
                $forceText = true;

            if ($forceText)
                $obj = new Model_BB_Text($code);
            else {
                if ($match[1] == '/') {
                    $list->_remains = $code;
                    return $list;
                }

                $class = 'Model_BB_' . ucfirst(preg_replace('/[^a-zA-Z0-9_]/', '_', $match[2]));
                if (class_exists($class))
                    $obj = new $class($code);
                else
                    $obj = new Model_BB_Text($code);
            }

            $list->Add($obj);
            $code = $list->getRemains();
            $forceText = false;
        }

        if ($list->count() == 1)
            return $list[0];
        return $list;
    }

    public static function parse($code) {
        $result = self::internalParse($code);
        $remains = '';
        while ($remains2 = $result->getRemains()) {
            if (!($result instanceof Model_BB_List))
                $result = new Model_BB_List(array($result));
            $result->Add(self::internalParse($remains, $remains === $remains2));
            $remains = $remains2;
        }
        return $result;
    }

}