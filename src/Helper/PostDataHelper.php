<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class PostDataHelper {

    public static function checkPostData() :void {
        foreach($_POST AS $key => $post) {
            if ($post == '' || is_null($post)) {
                throw new \PDOException("Null value provided for " . $key);
            }
        }
    }


}