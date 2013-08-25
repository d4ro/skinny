<?php

namespace Skinny\Router\Container;

/**
 *
 * @author Daro
 */
interface ContainerInterface {

    public function setAction(array $actionParts);

    public function setActionMatch(bool $actionMatch);

    public function setArgs(array $args);

    public function setParams(array $params);

    public function getAction();

    public function getActionParts();

    public function getActionDepth();

    public function getActionMatch();

    public function getArgs();

    public function getParams();
}