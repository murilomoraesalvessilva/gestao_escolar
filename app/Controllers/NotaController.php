<?php

require_once __DIR__ . '/../Models/NotaModel.php';
require_once __DIR__ . '/../Models/AlunoModel.php';
require_once __DIR__ . '/../Models/TurmaModel.php';

class NotaController {

    private NotaModel $model;
    private AlunoModel $alunoModel;
    private TurmaModel $turmaModel;

    public function __construct() {
        $this->model      = new NotaModel();
        $this->alunoModel = new AlunoModel();
        $this->turmaModel = new TurmaModel();
    }

    public function index(): void {
        $alunos = $this->alunoModel->getAll();
        require __DIR__ . '/../Views/notas/form.php';
    }

    public function criar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create(
                (int) $_POST['aluno_id'],
                $_POST['disciplina'],
                (float) $_POST['nota'],
                $_POST['data_lancamento']
            );
            header('Location: /nota/listar');
            exit;
        }
        $alunos = $this->alunoModel->getAll();
        require __DIR__ . '/../Views/notas/form.php';
    }

    public function listar(): void {
        $turma_id    = (int) ($_GET['turma_id'] ?? 0);
        $data_inicio = $_GET['data_inicio'] ?? '';
        $data_fim    = $_GET['data_fim'] ?? '';
        $export      = $_GET['export'] ?? '';

        $notas  = $this->model->getAll($turma_id, $data_inicio, $data_fim);
        $medias = $this->model->getMediasPorAluno($turma_id, $data_inicio, $data_fim);
        $turmas = $this->turmaModel->getAll();

        if ($export === 'pdf') {
            $this->exportarPDF($notas, $medias);
            return;
        }

        if ($export === 'docx') {
            $this->exportarDOCX($notas, $medias);
            return;
        }

        if ($export === 'excel') {
            $this->exportarExcel($notas, $medias);
            return;
        }

        require __DIR__ . '/../Views/notas/listagem.php';
    }

    private function exportarPDF(array $notas, array $medias): void {
        require_once __DIR__ . '/../../vendor/autoload.php';

        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new \Dompdf\Dompdf($options);

        ob_start();
        require __DIR__ . '/../Views/notas/relatorio_pdf.php';
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('relatorio_notas.pdf', ['Attachment' => true]);
        exit;
    }

    private function exportarDOCX(array $notas, array $medias): void {
        require_once __DIR__ . '/../../vendor/autoload.php';

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(11);

        $section = $phpWord->addSection();

        // Título
        $section->addTitle('Escola Municipal - Relatório de Notas', 1);
        $section->addTextBreak(1);

        // Tabela de notas
        $section->addText('Lista de Notas', ['bold' => true, 'size' => 13]);
        $section->addTextBreak(1);

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        // Cabeçalho
        $headerStyle = ['bold' => true, 'color' => 'FFFFFF'];
        $headerBg    = ['bgColor' => '2d6a4f'];
        $table->addRow();
        foreach (['Aluno', 'Turma', 'Disciplina', 'Nota', 'Data'] as $col) {
            $cell = $table->addCell(2000, $headerBg);
            $cell->addText($col, $headerStyle);
        }

        // Linhas
        foreach ($notas as $nota) {
            $table->addRow();
            $table->addCell(2000)->addText($nota['aluno_nome']);
            $table->addCell(2000)->addText($nota['turma_nome']);
            $table->addCell(2000)->addText($nota['disciplina']);
            $table->addCell(2000)->addText(number_format($nota['nota'], 2));
            $table->addCell(2000)->addText(date('d/m/Y', strtotime($nota['data_lancamento'])));
        }

        $section->addTextBreak(2);

        // Médias
        $section->addText('Média por Aluno', ['bold' => true, 'size' => 13]);
        $section->addTextBreak(1);

        $tabelaMedias = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        $tabelaMedias->addRow();
        foreach (['Aluno', 'Turma', 'Média'] as $col) {
            $cell = $tabelaMedias->addCell(3000, $headerBg);
            $cell->addText($col, $headerStyle);
        }

        foreach ($medias as $media) {
            $tabelaMedias->addRow();
            $tabelaMedias->addCell(3000)->addText($media['aluno_nome']);
            $tabelaMedias->addCell(3000)->addText($media['turma_nome']);
            $tabelaMedias->addCell(3000)->addText(number_format($media['media'], 2));
        }

        // Download
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="relatorio_notas.docx"');
        header('Cache-Control: max-age=0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
        exit;
    }

    private function exportarExcel(array $notas, array $medias): void {
        require_once __DIR__ . '/../../vendor/autoload.php';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Notas');

        // Cabeçalho
        $sheet->fromArray(['Aluno', 'Turma', 'Disciplina', 'Nota', 'Data'], null, 'A1');

        // Estilo do cabeçalho
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2d6a4f']],
        ];
        $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

        // Dados
        $row = 2;
        foreach ($notas as $nota) {
            $sheet->fromArray([
                $nota['aluno_nome'],
                $nota['turma_nome'],
                $nota['disciplina'],
                number_format($nota['nota'], 2),
                date('d/m/Y', strtotime($nota['data_lancamento'])),
            ], null, "A{$row}");
            $row++;
        }

        // Aba de médias
        $sheetMedias = $spreadsheet->createSheet();
        $sheetMedias->setTitle('Médias');
        $sheetMedias->fromArray(['Aluno', 'Turma', 'Média'], null, 'A1');
        $sheetMedias->getStyle('A1:C1')->applyFromArray($headerStyle);

        $row = 2;
        foreach ($medias as $media) {
            $sheetMedias->fromArray([
                $media['aluno_nome'],
                $media['turma_nome'],
                number_format($media['media'], 2),
            ], null, "A{$row}");
            $row++;
        }

        // Auto width
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $sheetMedias->getColumnDimension($col)->setAutoSize(true);
        }

        // Download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="relatorio_notas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}