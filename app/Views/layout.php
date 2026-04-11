<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f1117;
            color: #e0e0e0;
            min-height: 100vh;
        }

        .navbar {
            background-color: #1a1d27 !important;
            border-bottom: 1px solid #2a2d3e;
            box-shadow: 0 2px 10px rgba(0,0,0,0.4);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
            color: #7c83fd !important;
        }

        .nav-link-custom {
            color: #a0a3b1 !important;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .nav-link-custom:hover {
            color: #ffffff !important;
            background-color: #2a2d3e;
        }

        .card-custom {
            background-color: #1a1d27;
            border: 1px solid #2a2d3e;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        h2, h4 {
            color: #ffffff;
            font-weight: 600;
        }

        .table {
            color: #c8cad4;
            border-color: #2a2d3e;
        }

        .table thead th {
            background-color: #12141e;
            color: #7c83fd;
            border-color: #2a2d3e;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.05em;
        }

        .table tbody tr {
            border-color: #2a2d3e;
            transition: background 0.15s;
        }

        .table tbody tr:hover {
            background-color: #1e2130;
        }

        .table td {
            border-color: #2a2d3e;
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #7c83fd;
            border-color: #7c83fd;
            color: #fff;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #6069fc;
            border-color: #6069fc;
        }

        .btn-success {
            background-color: #2d6a4f;
            border-color: #2d6a4f;
        }

        .btn-success:hover {
            background-color: #245a42;
            border-color: #245a42;
        }

        .btn-danger {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .btn-outline-secondary {
            color: #a0a3b1;
            border-color: #2a2d3e;
        }

        .btn-outline-secondary:hover {
            background-color: #2a2d3e;
            color: #fff;
            border-color: #2a2d3e;
        }

        .btn-outline-dark {
            color: #a0a3b1;
            border-color: #2a2d3e;
        }

        .btn-outline-dark:hover {
            background-color: #2a2d3e;
            color: #fff;
            border-color: #2a2d3e;
        }

        .form-control, .form-select {
            background-color: #12141e;
            border: 1px solid #2a2d3e;
            color: #e0e0e0;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background-color: #12141e;
            border-color: #7c83fd;
            color: #e0e0e0;
            box-shadow: 0 0 0 3px rgba(124, 131, 253, 0.15);
        }

        .form-select option {
            background-color: #1a1d27;
        }

        .form-label {
            color: #a0a3b1;
            font-size: 0.88rem;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .badge-media {
            background-color: #2d6a4f;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Sistema Escolar</a>
        <div class="d-flex gap-1">
            <a class="nav-link-custom" href="/turma">Turmas</a>
            <a class="nav-link-custom" href="/aluno">Alunos</a>
            <a class="nav-link-custom" href="/nota">Lançar Nota</a>
            <a class="nav-link-custom" href="/nota/listar">Listagem</a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card-custom">
        <?= $content ?>
    </div>
</div>
</body>
</html>