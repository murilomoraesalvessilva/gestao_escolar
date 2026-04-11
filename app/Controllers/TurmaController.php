<?php

require_once __DIR__ . '/../Models/TurmaModel.php';

class TurmaController {

    private TurmaModel $model;

    public function __construct() {
        $this->model = new TurmaModel();
    }

    public function index(): void {
        $turmas = $this->model->getAll();
        require __DIR__ . '/../Views/turmas/index.php';
    }

    public function criar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST['nome'], (int) $_POST['ano']);
            header('Location: /turma');
            exit;
        }
        require __DIR__ . '/../Views/turmas/form.php';
    }
}