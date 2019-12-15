<?php
declare(strict_types=1);

namespace SimpleMVC\Model;

use Psr\Http\Message\ServerRequestInterface;

interface DbInterface {
    // 1: use type casting if needed inside function body to convert strings to other types 
    // 2: ...$var is a variadic, which is basically like using an array, but arguments 
    //    can be passed as usual, for example: funcName($a, $b, $c);

    public function selectAll() :?array;
    public function selectByKey(string ...$key) :?array;

    // add return types if any
    public function createRecord(string ...$data); 
    public function updateRecord(string ...$data);
    public function deleteRecord(string ...$key);  
}