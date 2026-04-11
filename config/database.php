<?php

define('DB_HOST', 'db');
define('DB_NAME', 'escola');
define('DB_USER', 'escola_user');
define('DB_PASS', 'escola_pass');

function getConnection(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $attempts = 0;
        while ($attempts < 5) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";port=3306;dbname=" . DB_NAME . ";charset=utf8";
                $pdo = new PDO(
                    $dsn,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
                break; // conexão ok, sai do loop
            } catch (PDOException $e) {
                $attempts++;
                if ($attempts >= 5) {
                    die("Erro na conexão após várias tentativas: " . $e->getMessage());
                }
                sleep(2); // espera 2 segundos antes de tentar de novo
            }
        }
    }

    return $pdo;
}