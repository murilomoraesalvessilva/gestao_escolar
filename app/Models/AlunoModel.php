<?php

class AlunoModel {

    private PDO $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function getAll(): array {
        $stmt = $this->db->query("
            SELECT a.*, t.nome as turma_nome 
            FROM alunos a 
            JOIN turmas t ON a.turma_id = t.id 
            ORDER BY a.nome
        ");
        return $stmt->fetchAll();
    }

    public function create(string $nome, string $email, int $turma_id): void {
        $stmt = $this->db->prepare("INSERT INTO alunos (nome, email, turma_id) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $turma_id]);
    }
}