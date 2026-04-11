<?php

require_once __DIR__ . '/../Models/AlunoModel.php';
require_once __DIR__ . '/../Models/TurmaModel.php';

class AlunoController {

    private AlunoModel $model;
    private TurmaModel $turmaModel;

    public function __construct() {
        $this->model = new AlunoModel();
        $this->turmaModel = new TurmaModel();
    }

    public function index(): void {
        $alunos = $this->model->getAll();
        require __DIR__ . '/../Views/alunos/index.php';
    }

    public function criar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create(
                $_POST['nome'],
                $_POST['email'],
                (int) $_POST['turma_id']
            );
            header('Location: /aluno');
            exit;
        }
        $turmas = $this->turmaModel->getAll();
        require __DIR__ . '/../Views/alunos/form.php';
    }
}