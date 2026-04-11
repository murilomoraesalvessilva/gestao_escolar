USE escola;

CREATE TABLE IF NOT EXISTS turmas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  ano INT
);

CREATE TABLE IF NOT EXISTS alunos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100),
  turma_id INT,
  criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (turma_id) REFERENCES turmas(id)
);

CREATE TABLE IF NOT EXISTS notas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  disciplina VARCHAR(100),
  nota DECIMAL(5,2),
  data_lancamento DATE,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id)
);

-- Dados de exemplo
INSERT INTO turmas (nome, ano) VALUES 
  ('Turma A', 2025), 
  ('Turma B', 2025);

INSERT INTO alunos (nome, email, turma_id) VALUES
  ('João Silva', 'joao@email.com', 1),
  ('Maria Souza', 'maria@email.com', 1),
  ('Pedro Lima', 'pedro@email.com', 2);

INSERT INTO notas (aluno_id, disciplina, nota, data_lancamento) VALUES
  (1, 'Matemática', 8.5, '2026-04-11'),
  (1, 'Português', 7.0, '2026-04-11'),
  (2, 'Matemática', 9.0, '2026-04-11'),
  (3, 'Física', 6.5, '2026-04-11');