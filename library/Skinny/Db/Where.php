<?php

namespace Skinny\Db;

/**
 * Description of Where
 *
 * @author Daro
 */
class Where implements BindableInterface {

    use Quoting;

    const T_OR = 0;
    const T_AND = 1;

    /**
     * new Where(Where::T_AND, array('col=5'));
     * new Where(Where::T_AND, array('col=5', 'col=:val'));
     * new Where(Where::T_AND, array('col=?'=>'val'));
     * new Where(Where::T_AND, array('col=:val'));
     * new Where(Where::T_AND, array('col=:val', 'col=?'=>'val'));
     * new Where(Where::T_AND, array('col=:val', array('col=?' => 'val')));
     * @param type $type
     * @param type $segments
     */
    public function __construct($type, array $segments = null) {
        $this->_type = $type;
        $this->_segments = (array) $segments;
    }

    public function add($segment) {
        $segment = func_get_args();
    }

    public function bind($param) {
        // TODO: binduje parametry w segmentach i wewnątrz nich (rekurencja)
    }

    protected $_type;
    protected $_segments;

    public function __toString() {
        // TODO: generowanie stringu WHERE na podstawie segmentów i typu ich złączenia
    }

}