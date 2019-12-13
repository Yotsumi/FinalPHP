<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class RegexHelper {

    public static function setUrl(string $url) :string
    {
        return '/^(\/'.$url.')\/([\w|\W]*)$/';
    }

}