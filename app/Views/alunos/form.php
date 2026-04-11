<?php ob_start(); ?>
<h2>Novo Aluno</h2>
<form method="POST" action="/aluno/criar">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Turma</label>
        <select name="turma_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach ($turmas as $turma): ?>
            <option value="<?= $turma['id'] ?>">
                <?= htmlspecialchars($turma['nome']) ?> (<?= $turma['ano'] ?>)
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="/aluno" class="btn btn-secondary">Cancelar</a>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';