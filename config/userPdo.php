<?php
// Insert here dates of databases
$dsn = 'mysql:dbname=test;host=127.0.0.1';

return [

    'public' => [
        'dsn' => $dsn, 
        'user' => 'user', 
        'password' => 'pass'
    ],

    'admin' => [
        'dsn' => $dsn, 
        'user' => 'user', 
        'password' => 'pass'
    ]

];