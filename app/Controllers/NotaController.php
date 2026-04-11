<?php

require_once __DIR__ . '/../Models/NotaModel.php';
require_once __DIR__ . '/../Models/AlunoModel.php';
require_once __DIR__ . '/../Models/TurmaModel.php';

class NotaController {

    private NotaModel $model;
    private AlunoModel $alunoModel;
    private TurmaModel $turmaModel;

    public function __construct() {
        $this->model = new NotaModel();
        $this->alunoModel = new AlunoModel();
        $this->turmaModel = new TurmaModel();
    }

    public function index(): void {
        $alunos = $this->alunoModel->getAll();
        require __DIR__ . '/../Views/notas/form.php';
    }

    public function criar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create(
                (int) $_POST['aluno_id'],
                $_POST['disciplina'],
                (float) $_POST['nota'],
                $_POST['data_lancamento']
            );
            header('Location: /nota/listar');
            exit;
        }
        $alunos = $this->alunoModel->getAll();
        require __DIR__ . '/../Views/notas/form.php';
    }

    public function listar(): void {
        $turma_id   = (int) ($_GET['turma_id'] ?? 0);
        $data_inicio = $_GET['data_inicio'] ?? '';
        $data_fim    = $_GET['data_fim'] ?? '';

        $notas  = $this->model->getAll($turma_id, $data_inicio, $data_fim);
        $medias = $this->model->getMediasPorAluno($turma_id, $data_inicio, $data_fim);
        $turmas = $this->turmaModel->getAll();

        require __DIR__ . '/../Views/notas/listagem.php';
    }
}