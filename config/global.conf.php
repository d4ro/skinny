<?php

// konfiguracja PHP
// konfiguracja Skinny'ego
return array(
    'settings' => array(
        // settings jest włączone; domyślnie false
        'enabled' => true
    ),
    // ścieżki względem katalogu public aplikacji
    'paths' => array(
        // katalog zawartości aplikacji; domyślnie 'content'
        'content' => 'content',
        // katalog modeli danych aplikacji; domyślnie '.'
        // TODO: przemysleć...
        'model' => '../',
        // katalog bibliotek; domyślnie 'library'
        'library' => '../library',
        // katalog cache; domyślnie 'cache'
        'cache' => '../cache',
    ),
    'loaders' => array(
        'standard' => array(
            //pole wymagane, aby 'standard' nie było 'puste'
            'enabled',
            // dodatkowe ścieżki ładowania, każda osobno
            'paths' => array(
            )
        ),
        'namespace' => array(
        // ścieżki automatycznego ładowania z użyciem przestrzeni nazw
        //'Skinny' => '../library/Skinny'
        ),
        'prefix' => array(
            // ścieżki automatycznego ładowania z użyciem prefiksów
            'Zend' => '../library/Zend'
        ),
    // customowe loadery
    /* 'CustomLoader.php?CustomLoader' => array(
      // konfiguracja loadera, jako array do konstruktora
      'klucz' => 'wartość'
      ),
      'OtherCustomLoader' => array(
      ) */
    ),
    'router' => array(
        'actionCache' => array(
            // czy cache'owanie akcji ma być włączone, domyślnie tak (1); dla dev lepiej wyłączyć
            'enabled' => 1,
        ),
        // ścika bazowa www aplikacji
        'baseUrl' => '/',
    ),
    'db' => [
        'adapter' => 'Pdo_Mysql',
        'params' => [
            'host' => 'localhost',
            'dbname' => 'inbook',
            'username' => 'root',
            'password' => 'daro',
            'charset' => 'utf8',
        ]
    ],
    'view' => array(
    ),
    // TODO: przenieść components do osobnego pliku np. config/components.php lub components/*.php
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
        },
        'db' => function() {
            $config = $this->getConfig('db');
            var_dump($config);
            $db = Zend_Db::factory($config);
            Zend_Db_Table_Abstract::setDefaultAdapter($db);
            return $db;
        }
    ),
    // akcje obsługujące nieoczekiwane wyjątki
    'actions' => [
        'error' => '/error',
        'notFound' => '/notfound'
    ]
);