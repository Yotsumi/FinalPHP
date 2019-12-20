<?php
declare(strict_types=1);

namespace SimpleMVC\Test\Helpers;

use PHPUnit\Framework\TestCase;
use SimpleMVC\Helper\PostDataHelper;

class PostDataHelperTest extends TestCase {

    /**
     * @dataProvider getDataInput
     */

    public function testcheckPostData($post, $expected) :void {   
        try {
            PostDataHelper::checkPostData($post);
            $res = true;
        } catch (\PDOException $e) {
            $res = false;
        }
        $this->assertEquals($expected, $res);
    }

    public function getDataInput() {
        return [
            [['test' => 'notNull', 'test3' => 'notNull'], true],
            [['test' => null], false],
            [[], true],
            [['test1' => 'notNull', 'test2' => null, 'test3' => 'notNull'], false]
        ];
    }
       
}