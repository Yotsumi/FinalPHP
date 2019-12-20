<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class PostDataHelper {

    public static function checkPostData(array $post) :void {
        foreach($post AS $key => $val) {
            if ($val == '' || is_null($val)) {
                throw new \PDOException("Null value provided for " . $key);
            }
        }
    }


}