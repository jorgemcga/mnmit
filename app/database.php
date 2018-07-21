<?php

return [
    /* Options DataBase: MySQL, SQLite */

    'driver' => DBDRIVER,
    'sqlite' => [
        'database' => SQLITE_DB,
    ],
    'mysql' => [
        'host' => MYSQL_HOST,
        'database' => MYSQL_DB,
        'user' => MYSQL_USER,
        'password' => MYSQL_PASSWORD,
        'charset' => MYSQL_CHARSET,
        'collation' => MYSQL_COLLATION,
        'port' => MYSQL_PORT
    ]
];
