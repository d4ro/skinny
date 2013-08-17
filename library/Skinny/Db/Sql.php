<?php

namespace Skinny\Db;

use Skinny\Db;

/**
 * Description of Sql
 *
 * @author Daro
 */
class Sql {

    /**
     * Obiekt połączenia z bazą danych
     * @var Db
     */
    protected $_db;
    /**
     * Metoda użyta do zapytania SQL
     * Dozwolone wartości (ci):
     * - SELECT
     * - UPDATE
     * - INSERT
     * - REPLACE
     * - DELETE
     * - SET
     * - CALL
     * Propozycje:
     * - TRUNCATE
     * - DROP (table)
     * - ALTER (table)
     * - CREATE (table)
     * - RENAME
     * @var string
     */
    protected $_method;
    protected $_table;
    protected $_columns;
    protected $_data;
    protected $_where;
    protected $_having;
    protected $_groupby;
    protected $_orderby;
    protected $_limit;

    public function __construct(Db $db, $method = null, $table = null) {
        $this->_db = $db;
        $this->_method = $method;
        $this->_table = $table;
    }

    public function __set($name, $value) {
        $this->_data[$name] = $value;
    }

    public function __get($name) {
        // TODO: walidacja
        return $this->_data[$name];
    }

    public function setMethod($method) {
        // sprawdzanie poprawności
    }

    public function setColumns($columns) {
        // usuwa wszystkie przypisane kolumny i zastępuje je nowymi
    }

    public function addColumns($columns) {
        // dodaje kolumnę lub kolumny do listy pobieranych z bazy kolumn
    }

}
