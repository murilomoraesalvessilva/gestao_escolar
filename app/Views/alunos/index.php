<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Alunos</h2>
    <a href="/aluno/criar" class="btn btn-primary">+ Novo Aluno</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Nome</th><th>Email</th><th>Turma</th></tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?= $aluno['id'] ?></td>
            <td><?= htmlspecialchars($aluno['nome']) ?></td>
            <td><?= htmlspecialchars($aluno['email']) ?></td>
            <td><?= htmlspecialchars($aluno['turma_nome']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';