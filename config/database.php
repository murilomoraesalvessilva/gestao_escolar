<?php

define('DB_HOST', 'db');
define('DB_NAME', 'escola');
define('DB_USER', 'escola_user');
define('DB_PASS','escola_pass');

function getConnection(): PDO {
    static $pdo = null;

    if($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname" . DB_NAME . ";charset=utf8",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    return $pdo;
}