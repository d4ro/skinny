<?php

namespace content;

/**
 * Description of index
 *
 * @author Daro
 */
class error extends \model\action\standard {

    public function _permit() {
        $this->getUsage()->allowUsage('*');
    }

    public function _action() {
        $this->getRequest()->getResponse()->setBody('wystapil blad');
    }

}