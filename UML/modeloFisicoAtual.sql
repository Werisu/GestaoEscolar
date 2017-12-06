-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE Aluno (
matricula int PRIMARY KEY,
nome varchar(45),
cpf varchar(45),
email varchar(45),
rg int(45),
data_nasc varchar(45),
sexo varchar(45),
logadouro varchar(250),
bairro varchar(45),
cep int(45),
id int,
arquivo varchar(250)
)

CREATE TABLE Turma (
id int PRIMARY KEY,
turno varchar(45),
-- Erro: nome do campo duplicado nesta tabela!
id int
)

CREATE TABLE sala (
id int PRIMARY KEY,
numero varchar(45)
)

CREATE TABLE Disciplina (
id int PRIMARY KEY,
titulo varchar(45),
cpf int
)

CREATE TABLE Docente (
cpf int PRIMARY KEY,
nome varchar(45),
email varchar(45),
estado_civil varchar(45),
sexo varchar(45),
logadouro varchar(250),
bairro varchar(45),
rg int,
formacao varchar(45)
)

CREATE TABLE Atividade (
id int(45) PRIMARY KEY,
titulo varchar(45),
descricao varchar(250),
situacao varchar(45),
data_inicio varchar(45),
data_final varchar(45),
matricula int,
FOREIGN KEY(matricula) REFERENCES Aluno (matricula)
)

CREATE TABLE telefone (
telefone varchar(45)
)

-- Erro: Nome de tabela duplicado (este erro compromete a integridade referencial)!
CREATE TABLE telefone (
telefone varchar(45)
)

CREATE TABLE Tem (
id int,
-- Erro: nome do campo duplicado nesta tabela!
id int,
FOREIGN KEY(id) REFERENCES Disciplina (id),
FOREIGN KEY(id) REFERENCES Turma (id)
)

CREATE TABLE cadastrado (
id int(45),
cpf int,
FOREIGN KEY(id) REFERENCES Atividade (id),
FOREIGN KEY(cpf) REFERENCES Docente (cpf)
)

ALTER TABLE Aluno ADD FOREIGN KEY(id) REFERENCES Turma (id)
ALTER TABLE Turma ADD FOREIGN KEY(id) REFERENCES sala (id)
ALTER TABLE Disciplina ADD FOREIGN KEY(cpf) REFERENCES Docente (cpf)
