<?php

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);
assert_options(ASSERT_QUIET_EVAL, 0);
assert_options(ASSERT_WARNING, 1);

require '../library/skinny/Store.php';
require '../library/skinny/Settings.php';

$s = new \Skinny\Settings('../config');
$s->a = 'b';
$s->save();