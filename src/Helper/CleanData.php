<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class CleanData {

    public static function clean(string $data) :string {
        return addslashes(strip_tags($data));
    }
}