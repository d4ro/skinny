<?php

include 'BB.php';
include 'B.php';
include 'I.php';
include 'U.php';
include 'Img.php';
include 'Url.php';
include 'Quote.php';
include 'Color.php';
include 'List.php';
include 'Text.php';

$code = '[quote=Dariusz Wojciechowski][b]Lorem Ipsum jest [color=#ff3300]tekstem[/b] stosowanym[/color] jako przykładowy wypełniacz w przemyśle poligraficznym. [u]Został po raz pierwszy[/u] użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. [color=#3366ff]Pięć wieków później zaczął być używany[/color] przemyśle elektronicznym, pozostając praktycznie niezmienionym. [color=#00ff00]Spopularyzował[/color] się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem [color=#ccffff]przeznaczonym do realizacji druków na komputerach[/color] osobistych, jak [u]Aldus PageMaker.[/u]

[quote=Voldemort]Na razie obsługuje tylko nie zagnieżdżone quote\'y[/quote]

Kłot kłota...

[url=http://www.wp.pl]Ta stronka jest super[/url]
[url]http://www.onet.pl[/url][/quote]';//[b=c]aaa[/b][i]ab[u]sdkhfbsdkj[/i]c[/u][img]http://i.wp.pl/a/f/jpeg/32201/kable-telewizor-flickr_660x440.jpeg[/img]';

echo $code . '<br><br>';
$parsed = Model_BB::parse($code);
$html = $parsed->toHtml();
echo $html;