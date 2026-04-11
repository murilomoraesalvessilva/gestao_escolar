# 🏫 Sistema de Gestão Escolar

Sistema desenvolvido como teste técnico para vaga de Desenvolvedor PHP Jr.

## 🛠️ Tecnologias

- PHP 8.2
- MySQL 8.0
- Apache
- Docker + Docker Compose
- Bootstrap 5
- Dompdf (relatório PDF)
- PHPWord (relatório DOCX)
- PhpSpreadsheet (relatório Excel)

## 📁 Estrutura do Projeto

/app
/Controllers   → Lógica de cada módulo
/Models        → Acesso ao banco de dados
/Views         → HTML das páginas
/config          → Conexão com o banco
/public          → Ponto de entrada (index.php)
/vendor          → Dependências (Composer)
docker-compose.yml
Dockerfile
database.sql

## 🚀 Como rodar

### Pré-requisitos
- [Docker Desktop](https://www.docker.com/products/docker-desktop) instalado

### Passo a passo

1. Clone o repositório ou extraia o .zip
2. Abra o terminal na pasta do projeto
3. Suba os containers:

```bash
docker-compose up --build
```

4. Acesse no navegador:
   - **Sistema:** http://localhost:8080
   - **phpMyAdmin:** http://localhost:8081

> O banco de dados é criado automaticamente com dados de exemplo.

## 📋 Funcionalidades

- ✅ Cadastro de Turmas
- ✅ Cadastro de Alunos (com vínculo à turma)
- ✅ Lançamento de Notas
- ✅ Listagem com filtros por turma e período
- ✅ Média por aluno (diferencial)
- ✅ Exportar relatório em PDF
- ✅ Exportar relatório em DOCX
- ✅ Exportar relatório em Excel (diferencial)
- ✅ Docker configurado (diferencial)
- ✅ MVC estruturado

## 🗄️ Banco de Dados

O script SQL está em `database.sql` e é executado automaticamente pelo Docker.

Para rodar manualmente:

```bash
docker exec -i escola_db mysql -uescola_user -pescola_pass escola < database.sql
```

## 👤 Autor

Seu Nome — [seu@email.com](mailto:seu@email.com)