<?php ob_start(); ?>
<h2>Lançar Nota</h2>
<form method="POST" action="/nota/criar">
    <div class="mb-3">
        <label class="form-label">Aluno</label>
        <select name="aluno_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach ($alunos as $aluno): ?>
            <option value="<?= $aluno['id'] ?>">
                <?= htmlspecialchars($aluno['nome']) ?> — <?= htmlspecialchars($aluno['turma_nome']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Disciplina</label>
        <input type="text" name="disciplina" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nota (0 a 10)</label>
        <input type="number" name="nota" step="0.01" min="0" max="10" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Lançamento</label>
        <input type="date" name="data_lancamento" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="/nota/listar" class="btn btn-secondary">Cancelar</a>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';