<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">🏫 Sistema Escolar</a>
        <div class="d-flex gap-3">
            <a class="text-white" href="/turma">Turmas</a>
            <a class="text-white" href="/aluno">Alunos</a>
            <a class="text-white" href="/nota">Notas</a>
            <a class="text-white" href="/nota/listar">Listagem</a>
        </div>
    </div>
</nav>
<div class="container">
    <?= $content ?>
</div>
</body>
</html>