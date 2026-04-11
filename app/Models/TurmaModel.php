<?php

class TurmaModel {

    private PDO $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM turmas ORDER BY ano DESC");
        return $stmt->fetchAll();
    }

    public function create(string $nome, int $ano): void {
        $stmt = $this->db->prepare("INSERT INTO turmas (nome, ano) VALUES (?, ?)");
        $stmt->execute([$nome, $ano]);
    }
}