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
        // punkt wejścia z przeglądarki; domyślnie 'public'
        'public' => 'public',
        // katalog cache silnika; domyślnie 'cache/skinny'
        'cache' => 'cache/skinny'
    ),
    'loader' => array(
        // czy loader ma być aktywny, domyślnie tak (1)
        'enabled' => 1,
        'loaders' => array(
            'standard' => array(
            // spl 
            ),
            'namespace' => array(
                // ścieżki automatycznego ładowania z użyciem przestrzeni nazw
                'Skinny' => 'library/Skinny'
            ),
            'prefix' => array(
                // ścieżki automatycznego ładowania z użyciem prefiksów
                'Zend' => 'library/Zend'
            )
        )
    ),
    'router' => array(
        'action_cache' => array(
            // czy cache'owanie akcji ma być włączone, domyślnie tak (1); dla dev lepiej wyłączyć
            'enabled' => 1
        ),
    ),
);