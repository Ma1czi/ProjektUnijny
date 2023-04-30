<?php
function cleanString($text) {
    $utf8 = array(
        '/[áàâãªäą]/u'   =>   'a',
        '/[ÁÀÂÃÄĄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[ł]/u'     =>   'l',
        '/[Ł]/u'     =>   'L',
        '/[éèêëę]/u'     =>   'e',
        '/[ÉÈÊËĘ]/u'     =>   'E',
        '/[óòôõºöó]/u'   =>   'o',
        '/[ÓÒÔÕÖÓ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/çć/'           =>   'c',
        '/ÇĆ/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/ś/'            =>   's',
        '/Ś/'            =>   'S',
        '/żź/u'           =>   'z',
        '/ŻŹ/u'           =>   'Z',
        '/[:-]/u'    =>   '',
        '/[\/]/'    =>   '',
        '/–/'           =>   '', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   '', // Literally a single quote
        '/[“”«»„]/u'    =>   '', // Double quote
        '/ /'           =>   '_', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}