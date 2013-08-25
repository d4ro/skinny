<?php

benchmark();

function benchmark() {
    static $var;

    $runs = 1000000;
    $rounds = 10;

    header('Content-Type: text/plain;');
    printf("Iterations: %d  (%d Runs)\n", $runs, $rounds);
    printf(" #  | NULL 1   | rel %%  | NULL 2   | rel %%  | is_null() | rel %%  | isset()   | rel %%  | empty()   | rel %%  \n");
    printf("----+----------+--------+----------+--------+-----------+--------+-----------+--------+-----------+--------\n");
    $time_sa = $time_sb = $time_sc = $time_sd = $time_se = 0;

    for ($b = 0; $b < $rounds; $b++) {

        $start = microtime(true);
        for ($i = 0; $var === null, $i < $runs; $i++)
            ;
        $time_a = microtime(true) - $start;
        $time_sa += $time_a;

        $start = microtime(true);
        for ($i = 0; null === $var, $i < $runs; $i++)
            ;
        $time_b = microtime(true) - $start;
        $time_sb += $time_b;

        $start = microtime(true);
        for ($i = 0; is_null($var), $i < $runs; $i++)
            ;
        $time_c = microtime(true) - $start;
        $time_sc += $time_c;

        $start = microtime(true);
        for ($i = 0; isset($var), $i < $runs; $i++)
            ;
        $time_d = microtime(true) - $start;
        $time_sd += $time_d;

        $start = microtime(true);
        for ($i = 0; empty($var), $i < $runs; $i++)
            ;
        $time_e = microtime(true) - $start;
        $time_se += $time_e;

        printf(" %2d |  %01.5f | %4.1f %% |  %01.5f | %4.1f %% |   %01.5f | %6.1f%%|   %01.5f | %6.1f%%|   %01.5f | %6.1f%%\n", $b + 1, $time_a, ($time_a / $time_c) * 100, $time_b, ($time_b / $time_c) * 100, $time_c, ($time_c / $time_c) * 100, $time_d, ($time_d / $time_c) * 100, $time_e, ($time_e / $time_c) * 100);
    }
    
    printf("----+----------+--------+----------+--------+-----------+--------+-----------+--------+-----------+--------\n");
    printf("Avg |  %01.5f | %4.1f %% |  %01.5f | %4.1f %% |   %01.5f | %6.1f%%|   %01.5f | %6.1f%%|   %01.5f | %6.1f%%\n", ($time_sa / $rounds), ($time_sa / $time_sc) * 100, ($time_sb / $rounds), ($time_sb / $time_sc) * 100, ($time_sc / $rounds), ($time_sc / $time_sc) * 100, ($time_sd / $rounds), ($time_sd / $time_sc) * 100, ($time_se / $rounds), ($time_se / $time_sc) * 100);
}