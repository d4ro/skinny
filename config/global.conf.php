<?php

// konfiguracja PHP
// konfiduracja skinny'ego
return array(
    'path' => array(
        // katalog akcji aplikacji; domyślnie 'app/Action'
        'action' => 'app/Action',
        // katalog logiki aplikacji; domyślnie 'app/Model'
        'model' => 'app/Model',
        // katalog widoków aplikacji; domyślnie 'app/View'
        'view' => 'app/View',
        // punkt wejścia z przeglądarki; domyślnie 'public'
        'public' => 'public',
        // katalog cache; domyślnie 'cache'
        'cache' => 'cache',
        'library' => 'library',
    ),
    'loader' => array(
        // czy loader ma być aktywny, domyślnie tak (1)
        'enabled' => 1,
        'loaders' => array(
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
            'app/Model/CustomLoader.php?Model\CustomLoader' => array(
            //jakiś config
            )
        )
    ),
    'router' => array(
        'action_cache' => array(
            // czy cache'owanie akcji ma być włączone, domyślnie tak (1); dla dev lepiej wyłączyć
            'enabled' => 1,
        ),
        // ścika bazowa www aplikacji
        'base_path' => '/',
    ),
    'components' => array(
        // bootstrap
        'view' => function ($app) {
            return $view;
        },
        'other' => function ($app) {
            return $other;
        },
    ),
);