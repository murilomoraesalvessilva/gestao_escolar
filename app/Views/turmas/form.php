<?php
ob_start();
?>
<h2>Nova Turma</h2>
<form method="POST" action="/turma/criar">
    <div class="mb-3">
        <label class="form-label">Nome da Turma</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Ano</label>
        <input type="number" name="ano" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="/turma" class="btn btn-secondary">Cancelar</a>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';