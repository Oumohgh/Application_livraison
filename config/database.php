<?php


return [
    'dsn' => 'mysql:host=localhost;dbname=delivry_db;charset=utf8mb4',
    'user' => 'root',
    'password' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
];