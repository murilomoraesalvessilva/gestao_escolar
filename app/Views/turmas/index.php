<?php
ob_start();
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Turmas</h2>
    <a href="/turma/criar" class="btn btn-primary">+ Nova Turma</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Nome</th><th>Ano</th></tr>
    </thead>
    <tbody>
        <?php foreach ($turmas as $turma): ?>
        <tr>
            <td><?= $turma['id'] ?></td>
            <td><?= htmlspecialchars($turma['nome']) ?></td>
            <td><?= $turma['ano'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';