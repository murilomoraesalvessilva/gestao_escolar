<?php

class NotaModel {

    private PDO $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function getAll(int $turma_id = 0, string $data_inicio = '', string $data_fim = ''): array {
        $sql = "
            SELECT n.*, a.nome as aluno_nome, t.nome as turma_nome
            FROM notas n
            JOIN alunos a ON n.aluno_id = a.id
            JOIN turmas t ON a.turma_id = t.id
            WHERE 1=1
        ";
        $params = [];

        if ($turma_id > 0) {
            $sql .= " AND a.turma_id = ?";
            $params[] = $turma_id;
        }
        if (!empty($data_inicio)) {
            $sql .= " AND n.data_lancamento >= ?";
            $params[] = $data_inicio;
        }
        if (!empty($data_fim)) {
            $sql .= " AND n.data_lancamento <= ?";
            $params[] = $data_fim;
        }

        $sql .= " ORDER BY a.nome, n.disciplina";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getMediasPorAluno(int $turma_id = 0, string $data_inicio = '', string $data_fim = ''): array {
        $sql = "
            SELECT a.nome as aluno_nome, t.nome as turma_nome, 
                   ROUND(AVG(n.nota), 2) as media
            FROM notas n
            JOIN alunos a ON n.aluno_id = a.id
            JOIN turmas t ON a.turma_id = t.id
            WHERE 1=1
        ";
        $params = [];

        if ($turma_id > 0) {
            $sql .= " AND a.turma_id = ?";
            $params[] = $turma_id;
        }
        if (!empty($data_inicio)) {
            $sql .= " AND n.data_lancamento >= ?";
            $params[] = $data_inicio;
        }
        if (!empty($data_fim)) {
            $sql .= " AND n.data_lancamento <= ?";
            $params[] = $data_fim;
        }

        $sql .= " GROUP BY a.id, a.nome, t.nome ORDER BY a.nome";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create(int $aluno_id, string $disciplina, float $nota, string $data): void {
        $stmt = $this->db->prepare("INSERT INTO notas (aluno_id, disciplina, nota, data_lancamento) VALUES (?, ?, ?, ?)");
        $stmt->execute([$aluno_id, $disciplina, $nota, $data]);
    }
}