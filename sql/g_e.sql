-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Dez-2017 às 20:58
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g_e`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `logadouro` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `data_nasc` varchar(45) DEFAULT NULL,
  `arquivo` varchar(45) DEFAULT NULL,
  `turma_idturma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `nome`, `cpf`, `rg`, `email`, `logadouro`, `bairro`, `cep`, `sexo`, `data_nasc`, `arquivo`, `turma_idturma`) VALUES
(2017018801, 'Alex Alexandre Silva Lima', '87486350300', '156280723', 'alexsilvaesilva@gmail.com', 'Rua Jabuticaba', 'Setor Jardim das Flores', '77800000', 'Masculino', '05/06/1996', NULL, 201701),
(2017018802, 'Adriana Silva Ribeiro', '87938685291', '130571076', 'adriasilvaribeiro@gmail.com', 'Rua das Palmeiras', 'Setor Araguaína Sul', '77800000', 'Feminino', '16/08/1995', NULL, 201701),
(2017018803, 'Alexandra Bolonhense de Sá', '73135252655', '370470746', 'alexandrabolonhense@gmail.com', 'Rua Afonso', 'Setor Eden', '77800000', 'Feminino', '19/12/1999', NULL, 201701),
(2017018804, 'Brenda Silva Carvalho', '84268381112', '507682907', 'brandacarvalhoesilva@gmail.com', 'Rua Jaxis', 'Setor Vila Sesamo', '77800000', 'Feminino', '28/08/1998', NULL, 201701),
(2017018805, 'Romero Brito de Sá', '83454519187', '486493969', 'romerobrito@gmail.com', 'Rua das Maracas', 'Setor Bocavilhe', '77800000', 'Masculino', '15/09/2000', NULL, 201701),
(2017018806, 'Rogério Cardoso Silva', '82768681008', '141651763', 'rogeriocardoso2@gmail.com', 'Rua Jeová', 'Setor Igrejas', '77800000', 'Masculino', '13/10/1999', NULL, 201701),
(2017018807, 'Gilvana Feitosa Lima', '65107506607', '260362311', 'gilfl@gmail.com', 'Rua A', 'Setor das Letras', '77800000', 'Feminino', '05/01/1994', NULL, 201702),
(2017018808, 'Joana Ribeiro da Cruz', '15131363136', '18.199.479-3', 'joanadark32@gmail.com', 'Rua B', 'Setor JK', '77800000', 'Feminino', '02/02/2000', NULL, 201702),
(2017018809, 'Fernando Pereira da Silva', '33431790356', '225431956', 'fernandops4@gmail.com', 'Rua das Gaivotas', 'Céu Azul', '77800000', 'Masculino', '04/05/1999', NULL, 201702),
(2017018810, 'James Ryan Bolonhense', '66372749920', '467210536', 'jamesryan@gmail.com', 'Rua C', 'JK', '77800000', 'Masculino', '16/01/2000', NULL, 201702),
(2017018811, 'Walisson Pereira de Sá', '81729624529', '12.821.107-6', 'walissondesa@gmail.com', 'Rua F', 'JK', '77800000', 'Masculino', '06/09/2000', NULL, 201702),
(2017018812, 'Hellen Cristina Rosário', '78500519800', '254183669', 'hellencristina1717@gmail.com', 'Rua G', 'JK', '77800000', 'Feminino', '09/08/1999', NULL, 201702),
(2017018813, 'Guilherme Nascimento da Silva', '26162494306', '41.876.180-2', 'ggnassilva@gmail.com', 'Rua das Gaivotas', 'Céu Azul', '77800000', 'Masculino', '21/05/1998', NULL, 201702),
(2017018814, 'Barbara da Silva Braga', '84020854580', '47.078.315-1', 'babsilva@gmail.com', 'Rua dos Girassois', 'Jardim das Flores', '77800000', 'Feminino', '30/07/1998', NULL, 201702),
(2017018815, 'Joãozinho de Bá', '02542252173', '367066166', 'joaozinho123@gmail.com', 'Rua G', 'JK', '77800000', 'Masculino', '10/03/1994', NULL, 201702),
(2017018816, 'Karla do Nascimento Brito', '72359633600', '39.752.705-6', 'karlinhabrito@gmail.com', 'Rua das Oliveiras', 'Jardim das Flores', '77800000', 'Feminino', '11/04/1996', NULL, 201702),
(2017018850, 'Maria de Jesus Carvalho', '04211335689', '741741', 'mdejesus@gmail.com', 'Rua Jasmin, numero 203', 'Floresta', '77522322', 'Feminino', '22/12/1998', NULL, 201701),
(2017018851, 'Francisco Ribeiro Dias', '04577896478', '12345678', 'zonax-12@hotmail.com', 'Rua 12, num 223', 'Ana Maria', '77828388', 'Masculino', '16/07/1999', NULL, 201701),
(2017018852, 'João Freitas de Melo', '85117875770', '222144154', 'jfmelo@gmail.com', 'Rua 1, num 102', 'JK', '77800000', 'Masculino', '01/02/1993', NULL, 201701),
(2017018853, 'Roberto Silva Rosário', '58402538800', '243550522', 'robertosilvarosario@gmail.com', 'Rua 1, num 101', 'JK', '77800000', 'Masculino', '08/06/1990', NULL, 201701);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `iddisciplina` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `docente_iddocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`iddisciplina`, `titulo`, `docente_iddocente`) VALUES
(1, 'Português', 20170001),
(2, 'Português', 20170002),
(3, 'Português', 20170003),
(4, 'Matemática', 20170004),
(5, 'Matemática', 20170005),
(6, 'Biologia', 20170006),
(7, 'Biologia', 20170007),
(8, 'Física', 20170008),
(9, 'Física', 20170009),
(10, 'Filosofia', 20170010),
(11, 'Geografia', 20170011),
(12, 'Geografia', 20170012),
(13, 'História', 20170013),
(14, 'História', 20170014),
(15, 'Sociologia', 20170015),
(16, 'Educação Física', 20170016),
(17, 'Arte', 20170017),
(18, 'Educação Religiosa', 20170018),
(19, 'Inglês', 20170019),
(20, 'Literatura', 20170020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `docente`
--

CREATE TABLE `docente` (
  `iddocente` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `cpf_docente` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `logadouro` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `formacao` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `estado_civil` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `docente`
--

INSERT INTO `docente` (`iddocente`, `nome`, `cpf_docente`, `rg`, `email`, `logadouro`, `bairro`, `formacao`, `sexo`, `estado_civil`) VALUES
(20170001, 'José Roberto da Cruz Silva e Silva', '53480588239', '268315073', 'joseroberto@ifto.com.br', 'Rua Boa Esperança, Qd06 Lt08', 'Estruturado', 'Mestrado', 'm', 'Casado'),
(20170002, 'Maria de Jesus Carvalho', '48132731735', '185704347', 'mariajesus@gmail.com', 'Rua das Carmélias', 'Jardim das Flores', 'Mestrado', 'f', 'Casada'),
(20170003, 'Roberto Brito de Sá', '39766410143', '153853165', 'robertobritodesa@ifto.edu.br', 'Rua das Viuvas', 'JK', 'Bacharel em Geografia', 'm', 'Casado'),
(20170004, 'João Alves Batista', '82568573589', '472209644', 'joaoalves@ifto.edu.br', 'Rua das Viuvas', 'JK', 'Bacharel em Letras', 'm', 'Casado'),
(20170005, 'Camila de Sousa Bastos', '77515841494', '330140759', 'camilabastos@ifto.edu.br', 'Rua H', 'Setor Noroeste', 'Mestrado em Matemática', 'f', 'Casada'),
(20170006, 'Joana Dark de Sá', '54471173308', '31.445.394-5', 'joanadark@lipeidiomas.com.br', 'Rua das quebradas, num456', 'Estruturado', 'Doutorado em Direito', 'f', 'Casada'),
(20170007, 'Karl Jefferson da Silva Luz', '86117272235', '467500071', 'karljef@lipeidiomas.com.br', 'Rua das Carmélias', 'Jardim das Flores', 'Bacharel em Física', 'm', 'Solteiro'),
(20170008, 'Cristiane de Sousa Bastos', '42635711186', '326432103', 'cristianebastos@lipeidiomas.com.br', 'Rua Y', 'JK', 'Bacharel Historia', 'f', 'Casada'),
(20170009, 'Wedney Silva Luz', '48073581469', '207842978', 'wedneyluz@ifto.edu.br', 'Rua das Maças', 'Jardim do Eden', 'Mestrado Filosofia', 'm', 'Casado'),
(20170010, 'Rogério Jean de Sá', '42344264906', '112104496', 'jeansa@gmail.com', 'Rua das Carmélias', 'Jardim das Flores', 'Bacharel Ciência da Computação', 'm', 'Casado'),
(20170011, 'Pedro Luiz da Silva', '46582531352', '259415686', 'pedroluiz@gmail.com', 'Rua G', 'JK', 'Bacharel', 'm', 'Casado'),
(20170012, 'Antônio Batista de Sá', '87935307814', '341127632', 'batistadesa@gmail.com', 'Rua T', 'JK', 'Bacharel', 'm', 'Casado'),
(20170013, 'João Alves da Silva', '21372381287', '131055616', 'alvesjoao@gmail.com', 'Rua J', 'JK', 'Mestrado', 'm', 'Casado'),
(20170014, 'Keila Maria da Cruz', '50646448684', '280995842', 'mariadacruz@gmail.com', 'Rua I', 'JK', 'Bacharel', 'f', 'Casada'),
(20170015, 'Heimer de Sousa Castros', '31525471295', '313275348', 'heimersousa@gmail.com', 'Rua O', 'JK', 'Mestrado', 'm', 'Casado'),
(20170016, 'José da Silva Castros', '84217628692', '312865818', 'josecastros@lipeidiomas.com.br', 'Rua Luz do Sol', 'Céu Azul', 'Bacharel', 'm', 'Casado'),
(20170017, 'James do Nascimento Rocha', '42423489757', '213024378', 'jamesrocha@ifto.edu.br', 'Rua Boa Esperança, Qd06 Lt08', 'Morada do Sol', 'Mestrado', 'm', 'Casado'),
(20170018, 'Juan do Nascimento de Sá', '47211144270', '297213519', 'joannascimento@lipeidiomas.com.br', 'Rua das Almas', 'Céu Azul', 'Bacharel', 'm', 'Solteiro'),
(20170019, 'Antônio da Silva Lima', '51296428133', '208249928', 'antsili@gmail.com', 'Rua da Lua Sangrenta', 'Liga das Lendas', 'Mestrado', 'm', 'Casado'),
(20170020, 'Heidi Bonerfácio de Sá', '57027344670', '184639761', 'heidibonerfacio@ifto.edu.br', 'Rua dos Artigos', 'Se Vira', 'Tecnico ', 'f', 'Casada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `idsala` int(11) NOT NULL,
  `numero` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`idsala`, `numero`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(4, '04'),
(5, '05'),
(6, '06'),
(7, '07'),
(8, '08'),
(9, '09'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(14, '14'),
(15, '15'),
(16, '16'),
(17, '17'),
(18, '18'),
(19, '19'),
(20, '20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone_aluno`
--

CREATE TABLE `telefone_aluno` (
  `idtelefone_aluno` int(11) NOT NULL,
  `telefone_alunocol` varchar(45) DEFAULT NULL,
  `Aluno_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone_docente`
--

CREATE TABLE `telefone_docente` (
  `idtelefone_docente` int(11) NOT NULL,
  `telefone_docentecol` varchar(45) DEFAULT NULL,
  `docente_iddocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idturma` int(11) NOT NULL,
  `turno` varchar(45) DEFAULT NULL,
  `sala_idsala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idturma`, `turno`, `sala_idsala`) VALUES
(201701, 'Matutino', 1),
(201702, 'Matutino', 2),
(201703, 'Matutino', 3),
(201704, 'Vespertino', 1),
(201705, 'Vespertino', 2),
(201706, 'Vespertino', 3),
(201707, 'Noturno', 1),
(201708, 'Noturno', 2),
(201709, 'Noturno', 3),
(201710, 'Matutino', 4),
(201711, 'Matutino', 5),
(201712, 'Matutino', 6),
(201713, 'Matutino', 7),
(201714, 'Matutino', 8),
(201715, 'Matutino', 9),
(201716, 'Matutino', 10),
(201717, 'Vespertino', 4),
(201718, 'Vespertino', 5),
(201719, 'Vespertino', 6),
(201720, 'Vespertino', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_has_disciplina`
--

CREATE TABLE `turma_has_disciplina` (
  `turma_idturma` int(11) NOT NULL,
  `disciplina_iddisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `fk_Aluno_turma1_idx` (`turma_idturma`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`iddisciplina`),
  ADD KEY `fk_disciplina_docente1_idx` (`docente_iddocente`);

--
-- Indexes for table `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`iddocente`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`idsala`);

--
-- Indexes for table `telefone_aluno`
--
ALTER TABLE `telefone_aluno`
  ADD PRIMARY KEY (`idtelefone_aluno`,`Aluno_matricula`),
  ADD KEY `fk_telefone_aluno_Aluno_idx` (`Aluno_matricula`);

--
-- Indexes for table `telefone_docente`
--
ALTER TABLE `telefone_docente`
  ADD PRIMARY KEY (`idtelefone_docente`),
  ADD KEY `fk_telefone_docente_docente1_idx` (`docente_iddocente`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idturma`),
  ADD KEY `fk_turma_sala1_idx` (`sala_idsala`);

--
-- Indexes for table `turma_has_disciplina`
--
ALTER TABLE `turma_has_disciplina`
  ADD PRIMARY KEY (`turma_idturma`,`disciplina_iddisciplina`),
  ADD KEY `fk_turma_has_disciplina_disciplina1_idx` (`disciplina_iddisciplina`),
  ADD KEY `fk_turma_has_disciplina_turma1_idx` (`turma_idturma`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_Aluno_turma1` FOREIGN KEY (`turma_idturma`) REFERENCES `turma` (`idturma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_docente1` FOREIGN KEY (`docente_iddocente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone_aluno`
--
ALTER TABLE `telefone_aluno`
  ADD CONSTRAINT `fk_telefone_aluno_Aluno` FOREIGN KEY (`Aluno_matricula`) REFERENCES `aluno` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone_docente`
--
ALTER TABLE `telefone_docente`
  ADD CONSTRAINT `fk_telefone_docente_docente1` FOREIGN KEY (`docente_iddocente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_sala1` FOREIGN KEY (`sala_idsala`) REFERENCES `sala` (`idsala`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turma_has_disciplina`
--
ALTER TABLE `turma_has_disciplina`
  ADD CONSTRAINT `fk_turma_has_disciplina_disciplina1` FOREIGN KEY (`disciplina_iddisciplina`) REFERENCES `disciplina` (`iddisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turma_has_disciplina_turma1` FOREIGN KEY (`turma_idturma`) REFERENCES `turma` (`idturma`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
