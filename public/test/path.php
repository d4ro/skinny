<?php

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);
assert_options(ASSERT_QUIET_EVAL, 0);
assert_options(ASSERT_WARNING, 1);

require '../../library/Skinny/Path.php';

assert(Skinny\Path::combine('a', 'b') == 'a' . DIRECTORY_SEPARATOR . 'b');
assert(Skinny\Path::combine('a', 'b', 'c') == 'a' . DIRECTORY_SEPARATOR . 'b' . DIRECTORY_SEPARATOR . 'c');

return;

function nope() {
    
}

//xdebug_start_trace('trace.txt');
// test czasu wykonywania
list($usec, $sec) = explode(' ', microtime());
$script_start = (float) $sec + (float) $usec;

nope();
$a = array(
    'a' => 'b',
    'b' => array(
        'c' => 'd',
        'e' => 'f'
    )
);

$b = array(
    'a' => 'c',
    'b' => array(
        'c' => 'e',
        'd' => 'f'
    )
);

$c = array_merge($a, $b);
nope();

list($usec, $sec) = explode(' ', microtime());
$script_end = (float) $sec + (float) $usec;

$elapsed_time = round($script_end - $script_start, 8);
echo '<br>' . $elapsed_time . '<br>';

// test czasu wykonywania
list($usec, $sec) = explode(' ', microtime());
$script_start = (float) $sec + (float) $usec;

$aa = new Skinny\Store($a);
$bb = new Skinny\Store($b);
$aa->merge($bb);
nope();

list($usec, $sec) = explode(' ', microtime());
$script_end = (float) $sec + (float) $usec;

$elapsed_time = round($script_end - $script_start, 8);
echo '<br>' . $elapsed_time . '<br>';

xdebug_stop_trace();
xdebug_var_dump($c, $aa->toArray());
die();

$var = new Skinny\Store();
assert($var->length() === 0);

$a = $var->a->b;
assert($var->a->b->length() === 0);
assert($var->a->b->c->length() === 0);
assert($var->a->length() === 0);
assert($var->length() === 0);

$var->a->b = 'c';
assert($var->a->length() === 1);
assert($var->length() === 1);

$var->a = 'b';
assert($var->a === 'b');
assert($var->a() === 'b');
assert($var->a('c') === 'b');
assert($var->a('c', false, false) === 'b');

assert($var->b('c', false, false) instanceof Skinny\Store);
assert($var->b('c') === 'c');
assert($var->b() instanceof Skinny\Store);
assert($var->b('c', true) === 'c');
assert($var->b() === 'c');

$var->c->d()->e = 'f';
assert($var->c->isEmpty());

