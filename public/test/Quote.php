<?php

/**
 * Description of Quote
 *
 * @author Daro
 */
class Model_BB_Quote extends Model_BB {
    /*
     * <blockquote>
      <cite>Voldemort napisał(a):</cite>
      <div>Na razie obsługuje tylko nie zagnieżdżone quote'y</div>
      </blockquote>
     */

    public function __construct($code) {
        $this->_htmlTag = 'blockquote';
        $this->_tag = 'quote';
        $this->_hasEndHtmlTag = true;
        $this->_hasEndTag = true;

        parent::__construct($code);
    }

    public function toHtml() {
        $html = parent::toHtml();
        if (!empty($this->_attr)) {
            $cite = '<cite>' . $this->_attr . ' napisał(a):</cite><div>';
            $html = substr_replace($html, $cite, 12, 0);
            $html = substr_replace($html, '</div>', -13, 0);
        }
        return $html;
    }

}