<?php

// konfiguracja PHP
// konfiduracja skinny'ego
return array(
    'path' => array(
        // katalog akcji aplikacji; domyślnie 'app/Action'
        'action' => 'app/Action',
        // katalog logiki aplikacji; domyślnie 'app/Logic'
        'logic' => 'app/Logic',
        // katalog widoków aplikacji; domyślnie 'app/View'
        'view' => 'app/View',
        // katalog bibliotek; domyślnie 'library'
        'library' => 'library',
        // punkt wejścia z przeglądarki; domyślnie 'public'
        'public' => 'public',
        // katalog cache; domyślnie 'cache'
        'cache' => 'cache',
    ),
    'loader' => array(
        'standard' => array(
            // dodatkowe ścieżki ładowania, każda osobno
            'path' => array(
            )
        ),
        'namespace' => array(
            // ścieżki automatycznego ładowania z użyciem przestrzeni nazw
            'Skinny' => 'library/Skinny'
        ),
        'prefix' => array(
            // ścieżki automatycznego ładowania z użyciem prefiksów
            'Zend' => 'library/Zend'
        ),
        // customowe loadery
        /* 'app/Logic/CustomLoader.php?Logic\CustomLoader' => array(
          // konfiguracja loadera, jako array do konstruktora
          'klucz' => 'wartość'
          ),
          'Logic\Other\CustomLoader' => array(
          ) */
    ),
    'router' => array(
        'action_cache' => array(
            // czy cache'owanie akcji ma być włączone, domyślnie tak (1); dla dev lepiej wyłączyć
            'enabled' => 1,
        ),
        // ścika bazowa www aplikacji
        'base_path' => '/',
    ),
    'db' => array(
    ),
    'view' => array(
    ),
    'components' => array(
        // bootstrap
        'view' => function() {
            //return $view;
            return $this;
        },
        'other' => function() {
            //return $other;
            return $this;
        },
        'test' => function() {
            xdebug_var_dump($this);
            return true;
        }
    ),
);