<?php
declare(strict_types=1);

namespace SimpleMVC\Model;

use Psr\Http\Message\ServerRequestInterface;

interface DbInterface {
    // 1: use type casting if needed inside function body to convert strings to other types 
    // 2: ...$var is a variadic, which is basically like using an array, but arguments 
    //    can be passed as usual, for example: funcName($a, $b, $c);

    public function selectAll() :?array;
    public function selectByKey(array $key) :?array;

    // add return types if any
    public function createRecord(array $data); 
    public function updateRecordById(array $data);
    public function deleteRecordById(array $data);  
}