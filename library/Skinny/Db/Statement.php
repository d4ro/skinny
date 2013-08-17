<?php

namespace Skinny\Db;

use Skinny\Db;

/**
 * Description of Statement
 *
 * @author Daro
 */
class Statement extends \PDOStatement {

    protected $_db;

    public function __construct(Db $db) {
        $this->_db = $db;
    }

}