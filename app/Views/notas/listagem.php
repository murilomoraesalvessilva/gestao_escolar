<?php ob_start(); ?>
<h2>Listagem de Notas</h2>

<!-- Filtros -->
<form method="GET" action="/nota/listar" class="row g-3 mb-4">
    <div class="col-md-4">
        <label class="form-label">Turma</label>
        <select name="turma_id" class="form-select">
            <option value="">Todas</option>
            <?php foreach ($turmas as $turma): ?>
            <option value="<?= $turma['id'] ?>" <?= ($turma_id == $turma['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($turma['nome']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Data Início</label>
        <input type="date" name="data_inicio" class="form-control" value="<?= $data_inicio ?>">
    </div>
    <div class="col-md-3">
        <label class="form-label">Data Fim</label>
        <input type="date" name="data_fim" class="form-control" value="<?= $data_fim ?>">
    </div>
    <div class="col-md-2 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        <a href="/nota/listar" class="btn btn-outline-secondary w-100">Limpar</a>
    </div>
</form>

<!-- Tabela de notas -->
<table class="table table-bordered table-hover mb-4">
    <thead class="table-dark">
        <tr><th>Aluno</th><th>Turma</th><th>Disciplina</th><th>Nota</th><th>Data</th></tr>
    </thead>
    <tbody>
        <?php foreach ($notas as $nota): ?>
        <tr>
            <td><?= htmlspecialchars($nota['aluno_nome']) ?></td>
            <td><?= htmlspecialchars($nota['turma_nome']) ?></td>
            <td><?= htmlspecialchars($nota['disciplina']) ?></td>
            <td><?= number_format($nota['nota'], 2) ?></td>
            <td><?= date('d/m/Y', strtotime($nota['data_lancamento'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Médias por aluno -->
<h4>Média por Aluno</h4>
<table class="table table-bordered table-striped">
    <thead class="table-success">
        <tr><th>Aluno</th><th>Turma</th><th>Média</th></tr>
    </thead>
    <tbody>
        <?php foreach ($medias as $media): ?>
        <tr>
            <td><?= htmlspecialchars($media['aluno_nome']) ?></td>
            <td><?= htmlspecialchars($media['turma_nome']) ?></td>
            <td><strong><?= number_format($media['media'], 2) ?></strong></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex gap-2">
    <a href="/nota/listar?<?= http_build_query($_GET) ?>&export=pdf" class="btn btn-danger">Exportar PDF</a>
    <a href="/nota/listar?<?= http_build_query($_GET) ?>&export=docx" class="btn btn-primary">Exportar DOCX</a>
    <a href="/nota/listar?<?= http_build_query($_GET) ?>&export=excel" class="btn btn-success">Exportar Excel</a>
    <a href="/nota/criar" class="btn btn-outline-dark ms-auto">+ Lançar Nota</a>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';