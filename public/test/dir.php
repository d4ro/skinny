<?php

$path = '../';
$dir = dir($path);

while ($item = $dir->read()) {
    var_dump($item);

    //$this->readDir($item, &$actions);
}