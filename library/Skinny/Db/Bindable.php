<?php

namespace Skinny\Db;

/**
 * Reprezentuje sparametryzowane wyrażenie SQL lub jego fragment.
 * Pod parametry można podstawić wartości metodą bind() lub w samym konstruktorze podając tablicę.
 *
 * @author Daro
 */
class Bindable implements BindableInterface {

    use Quoting;

    /**
     * Wyrażenie
     * @var string
     */
    protected $_expression;

    /**
     * Wartości parametrów
     * @var array
     */
    protected $_params;

    /**
     * Tworzy nowy obiekt ustalając treść sparametryzowanego wyrażenia.
     * Jeżeli $expression jest tablicą, której klucz jest stringiem, uznaje klucz za wyrażenie, a wartość tablicy za wartość parametru.
     * @param mixed $expression obiekt, string lub jednoelementowy array
     * @throws InvalidArgumentException array nie jest jednoelementowy
     */
    public function __construct($expression) {
        if (is_string($expression))
            $this->_expression = $expression;
        elseif (is_object($expression))
            $this->_expression = $expression->__toString();
        elseif (is_array($expression)) {
            if (count($expression) !== 1)
                throw new InvalidArgumentException('Expression is not a single element array.');
            $key = key($expression);
            if (is_string($key)) {
                $this->_expression = $key;
                $this->_params[] = $expression[$key];
            }else
                $this->_expression = $expression[$key];
        }
    }

    public function bind($param) {
        $this->_params = array_merge((array) $this->_params, (array) $param);
    }

    public function __toString() {
        $this->_prepare();
        return $this->_expression;
    }

    protected function _prepare() {
        // przygotouje expression
        // TODO: podpisuje wszystkie parametry ich wartościami, tak jak to robi Zend
        // jeżeli jest tylko jeden nienazwany paramert, wszystkie znaki zapytania zmieniamy na jego wartość
        // usuwa parametry, expression jest już w wersji kompletnej
    }

}
