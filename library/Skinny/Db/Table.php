<?php

namespace Skinny\Db;

use Skinny\Db;

/**
 * Description of Table
 *
 * @author Daro
 */
class Table {

    protected $_db;
    protected $_table;

    public function __construct(Db $db, $table) {
        $this->_db = $db;
        $this->_table = $table;
    }

    public function sql($method = null) {
        return new Sql($this->_db, $method, $this->_table);
    }

    public function select($columns) {
        $sql = $this->_db->sql('select', $this->_table);
        $sql->setColumns($columns);
    }
}
