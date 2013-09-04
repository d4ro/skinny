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
     * Dozwolone wartości (case-insensitive):
     * - SELECT
     * - UPDATE
     * - INSERT
     * - REPLACE
     * - DELETE
     * - TRUNCATE
     * Propozycje:
     * - SET
     * - CALL
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
    protected $_insertdata;
    protected $_where;
    protected $_having;
    protected $_groupby;
    protected $_orderby;
    protected $_limit;

    public function __construct(Db $db, $method = null, $table = null) {
        $this->_db = $db;
        $this->setMethod($method);
        $this->_table = $table;
    }

    public function __set($name, $value) {
        $this->_data[$name] = $value;
    }

    public function __get($name) {
        // Daro: o co mi chodziło w tej funkcji?
        // TODO: walidacja
        return $this->_data[$name];
    }

    public function setMethod($method) {
        switch (strtoupper($method)) {
            case 'SELECT':
            case 'INSERT':
            case 'REPLACE':
            case 'UPDATE':
            case 'ORINSERT':
            case 'DELETE':
            case 'TRUNCATE':
                $this->_method = $method;
                break;

            default:
                throw new \UnexpectedValueException('Method "' . $method . '" is not supported by the SQL builder.');
        }
        return $this;
    }

    public function setColumns($columns = null) {
        $this->_columns = (array) $columns;
        return $this;
    }

    public function addColumns($columns) {
        // dodaje kolumnę lub kolumny do listy pobieranych z bazy kolumn
        $this->_columns = array_merge((array) $this->_columns, (array) $columns);
        return $this;
    }

    public function setData($data = null) {
        $this->_data = (array) $data;
        return $this;
    }

    public function setInsertData($data) {
        $this->_insertdata = (array) $data;
        return $this;
    }

    public function select($columns = null) {
        return $this
                        ->setMethod('SELECT')
                        ->setColumns($columns);
    }

    public function update($data = null) {
        return $this
                        ->setMethod('UPDATE')
                        ->setData($data);
    }

    public function insert($data = null) {
        return $this
                        ->setMethod('INSERT')
                        ->setInsertData($data);
    }

    public function delete() {
        return $this
                        ->setMethod('DELETE');
    }

    public function orInsert($data = null) {
        return $this
                        ->setMethod('ORINSERT')
                        ->setInsertData($data);
    }

    public function reset($part) {
        switch (strtolower($part)) {
            case 'where':
                $this->_where = null;
                break;
            case 'order':
            case 'orderby':
                $this->_orderby = null;
                break;
            case 'group':
            case 'groupby':
                $this->_groupby = null;
                break;
            default:
                throw new \UnexpectedValueException('There is no such part as "' . $part . '".');
        }
        return $this;
    }

    public function where($where) {
        // $where może być stringiem, arrayem lub obiektem Where
        // niedozwolone jest użycie where('id = ?', $id); zamiast tego należy użyć where(array('id = ?' => $id));
        // restrykcja ta jest spowodowana niespójnością implementacji where'a w Zendzie, która prowadzi do błedów logicznych
        // where może zostać ustawiony tylko raz
    }

    public function order($orderby) {
        // order może zostać ustawiony tylko raz
        $this->_orderby = $orderby;
        return $this;
    }

    public function group($groupby) {
        // group może zostać ustawiony tylko raz
        $this->_groupby = $groupby;
        return $this;
    }

}
