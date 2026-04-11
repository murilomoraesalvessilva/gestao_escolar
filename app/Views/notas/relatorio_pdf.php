<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .cabecalho { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2d6a4f; padding-bottom: 10px; }
        .cabecalho h1 { color: #2d6a4f; margin: 0; font-size: 20px; }
        .cabecalho p { margin: 4px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #2d6a4f; color: white; padding: 8px; text-align: left; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        h3 { color: #2d6a4f; margin-top: 20px; }
        .rodape { text-align: center; font-size: 10px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="cabecalho">
        <h1>🏫 Escola Municipal</h1>
        <p>Relatório de Notas — Gerado em <?= date('d/m/Y H:i') ?></p>
    </div>

    <h3>Lista de Notas</h3>
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Disciplina</th>
                <th>Nota</th>
                <th>Data</th>
            </tr>
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

    <h3>Média por Aluno</h3>
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Média</th>
            </tr>
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

    <div class="rodape">Sistema de Gestão Escolar — <?= date('Y') ?></div>
</body>
</html>