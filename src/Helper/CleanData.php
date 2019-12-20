<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class CleanData {

    public static function cleanArray(array $data) :array {
        foreach ($data AS $k=>$v) {
            $data[$k] = addslashes(strip_tags($v));
        }
        return $data;
    }
}