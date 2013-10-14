<?php

namespace Skinny\Action;

/**
 * Definiuje dozwolone sposoby wykorzystania akcji, co ma związek z uprawnieniami użytkownika do zasobów używanych przez akcję.
 * Implementacja jest niezależna od sposobu wykorzystania. Udostępnia hierarchiczną definicję sposobu wykorzystania (way) wraz z dziedziczeniem uprawnień.
 * 
 * Przykłady sposobu wykorzystania:
 * 1. Stwierdzenie (np. z bazy), że użytkownik ma dostęp do tej akcji.
 *    Ustalenie najogólniejszego sposobu wykorzystania - tak, może korzystać (ma dostęp).
 *    $this->allowUsage();
 *    Dodatkowe stwierdzenie szczegółowego sposobu wykorzystania akcji nie jest możliwe (dostęp jest nieograniczony).
 * 
 * 2. Stwierdzenie uprawnień do zasobu.
 *    Akcja jest częścią jakiegoś zasobu - analogicznie do przykładu 1. - stwierdzenie, że użytkownik ma dostęp do tego zasobu.
 *    $this->allowUsage($nazwa_zasobu);
 *    Możliwe stwierdzenie, do jakiego zasobu użytkownik ma dostęp (jeżeli akcja jest częścią więcej niż jednego zasobu).
 * 
 * 3. Stwierdzenie uprawnień do zasobu przy użyciu daną metodą.
 *    W akcji użytkownik może otrzymać dostęp do zasobów na różne sposoby.
 *    Ustalenie metod obsługi zasobu dla użytkownika.
 *    $this->allowUsage('plik', 'otwórz');
 *    Możliwe stwierdzenie, że użytkownik ma dostęp do danego zasobu daną metodą.
 *    $this->allowUsage('plik');
 *    Możliwe stwierdzenie, że użytkownik ma dostęp do danego zasobu niezależnie od korzystanej metody.
 *
 * 4. Praktycznie nieograniczone uszczegółowianie sposobów wykorzystania akcji.
 *    W akcji użytkownik może otrzymać dostęp do zasobu z bardzo wysokim poziomem uszczegółowienia jego wykorzystania.
 *    $this->allowUsage('drzwi', 'zamknij', 'szybko', 'nogą');
 *    Możliwe stwierdzenie konkretnego sposobu wykorzystania akcji przez użytkownika.
 *    $this->allowUsage('drzwi', 'zamknij', 'szybko', 'ręką', 'lewą');
 *    Możliwe stwierdzenie braku możliwości wykorzystania akcji przy braku dostępu do szybkiego zamknięcia drzwi *prawą* ręką
 *    (o ile takie użycie - lub bardziej ogólne - nie zostało nadane ponadto).
 * 
 * @author Daro
 */
class Usage {

    protected $_allowed;
    protected $_disallowed;

    public function __construct() {
        $this->_allowed = array();
        $this->_disallowed = array();
    }

    public function setUsage($allow, $way) {
        if ($allow)
            $this->allowUsage($way);
        else
            $this->disallowUsage($way);
    }

    public function setUsages(array $ways) {
        sort($ways);

        foreach ($ways as $way)
            $this->setUsage(array_shift($way), $way);
    }

    public function allowUsage($way) {
        if (!is_array($way))
            $way = func_get_args();

        // TODO: $way jest arrayem kolejnych uprawnień, np: {drzwi, otwórz, szybko, ręką}
        // dodajemy:
        // 
        // szukamy wszystkich w disallow, w których się zawieramy (są dłuższe lub takie same i zgadzają się co do istniejących elementów)
        // if true usuwamy znalezione z disallow
        // 
        // szukamy wszystkich w allow, które zawierają nas w sobie (są krótsze lub takie same i zgadzają się co do istniejących elementów)
        // if true nie rób nic
        // 
        // dodajemy nas
    }

    public function allowUsages($ways) {
        
    }

    public function disallowUsage($way) {
        // TODO
        // usuwamy:
        // 
        // szukamy wszystkich w allow, w których się zawieramy (są dłuższe lub takie same i zgadzają się co do istniejących elementów)
        // if true usuwamy znalezione z allow
        //
        // szukamy wszystkich w disallow, które zawierają nas w sobie (są krótsze lub takie same i zgadzają się co do istniejących elementów)
        // if true nie rób nic
        //
        // dodajemy nas
    }

    public function disallowUsages($ways) {
        
    }

    public function hasAny() {
        return count($this->_allowed) > 0;
    }

    public function isAllowed($way) {
        if (!is_array($way))
            $way = func_get_args();

        // TODO
        // wychodzimy z założenia, że nie mamy dostępu
    }

}