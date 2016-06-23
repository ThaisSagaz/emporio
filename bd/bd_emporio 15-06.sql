-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jun-2016 às 23:56
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bd_emporio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriafichatecnica`
--

CREATE TABLE IF NOT EXISTS `categoriafichatecnica` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(65) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `categoriafichatecnica`
--

INSERT INTO `categoriafichatecnica` (`codigo`, `nome`) VALUES
(2, 'Recheio'),
(3, 'Cobertura'),
(6, 'DecoraÃ§Ã£o'),
(7, 'Bolo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(400) DEFAULT NULL,
  `cnpj` varchar(19) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `whats` enum('f','t') NOT NULL DEFAULT 'f',
  `ponto_referencia` varchar(100) NOT NULL,
  `categoria_cliente` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_cliente`),
  UNIQUE KEY `cpf_2` (`cpf`),
  UNIQUE KEY `cpf` (`cpf`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nome`, `cpf`, `email`, `telefone`, `endereco`, `cnpj`, `celular`, `whats`, `ponto_referencia`, `categoria_cliente`) VALUES
(1, 'JÃ©ssica Rocha Cardoso', '861.584.455-09', 'Jessica.cardosor@gmail.com', '', 'Rua sÃ£o joÃ£o n15e', '', '071 8309-8938', 'f', 'prox a bar de valdomiro', 'vip'),
(5, 'Batman1', '765765', 'batman@gmail.com', '32340000', 'Batcaverna', '', NULL, 'f', '', ''),
(16, 'Paula', '053.438.945-77', 'askdajsl@hotmail.com', '71 33976-874', 'skldfjsasdflskf', '', NULL, 'f', '', ''),
(19, 'ingrid pinheiro', '038.414.885-95', 'rrodrigo@hotmail.com', '71 9160-4517', 'um lugar do mundo, salvador', '', '71 88693-374', 'f', 'teste', 'intermediario'),
(20, 'Xyztemas', '068.797.935-84', 'xyztemas@xyztemas.com', '55 55555-555', 'Rio vermelho, Lucaia', '', '44 44444-4444', 'f', 'Rua do Canal', 'intermediario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `composicao`
--

CREATE TABLE IF NOT EXISTS `composicao` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_receita` int(11) DEFAULT NULL,
  `valortotal` double NOT NULL,
  `modopreparo` text,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `cod_receita` (`cod_receita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE IF NOT EXISTS `encomendas` (
  `cod_Encomenda` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) DEFAULT NULL,
  `dtpedido` date NOT NULL,
  `dtentrega` date NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `Valor` float NOT NULL,
  `totalPago` decimal(5,2) NOT NULL DEFAULT '0.00',
  `situacao` varchar(50) NOT NULL DEFAULT 'A fazer',
  PRIMARY KEY (`cod_Encomenda`),
  KEY `cod_cliente` (`cod_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`cod_Encomenda`, `descricao`, `dtpedido`, `dtentrega`, `cod_cliente`, `Valor`, `totalPago`, `situacao`) VALUES
(1, NULL, '2016-03-10', '2016-03-20', 19, 111, '111.00', 'Entregue');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoquevenda`
--

CREATE TABLE IF NOT EXISTS `estoquevenda` (
  `cod_EstoqueVenda` int(11) NOT NULL AUTO_INCREMENT,
  `cod_Produto` int(11) NOT NULL,
  `quantidade` int(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `validade` date NOT NULL,
  `origem` varchar(10) NOT NULL,
  `observacao` varchar(150) DEFAULT NULL,
  `dt_perda` date DEFAULT NULL,
  PRIMARY KEY (`cod_EstoqueVenda`),
  UNIQUE KEY `cod_Produto_2` (`cod_Produto`),
  KEY `cod_Produto` (`cod_Produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `estoquevenda`
--

INSERT INTO `estoquevenda` (`cod_EstoqueVenda`, `cod_Produto`, `quantidade`, `status`, `validade`, `origem`, `observacao`, `dt_perda`) VALUES
(1, 1, 1, 'Disponivel', '2016-06-08', 'Interno', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exemplo`
--

CREATE TABLE IF NOT EXISTS `exemplo` (
  `cod_exe` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `tamanho` char(1) DEFAULT NULL,
  `cod_exe_fat` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_exe`),
  KEY `fk_teste` (`cod_exe_fat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fichastecnicas`
--

CREATE TABLE IF NOT EXISTS `fichastecnicas` (
  `cod_fichaTecnica` int(11) NOT NULL AUTO_INCREMENT,
  `categoriafichatecnica_codigo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `Tamanho` varchar(1) DEFAULT NULL,
  `valortotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_fichaTecnica`),
  KEY `categoriafichatecnica_codigo` (`categoriafichatecnica_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `fichastecnicas`
--

INSERT INTO `fichastecnicas` (`cod_fichaTecnica`, `categoriafichatecnica_codigo`, `nome`, `Tamanho`, `valortotal`) VALUES
(1, 6, 'mm', 'P', '0.32'),
(3, 2, 'll', 'M', '2.13'),
(6, 2, 'raÃ§Ã£o humana teste de quantidade', 'P', '0.20'),
(8, 2, 'teste 3', 'P', '0.06'),
(9, 3, 'bombom', 'P', '4.30'),
(10, 3, 'ganache', 'P', '1.56'),
(11, 7, 'Massa Belga', 'M', '4.09'),
(12, 2, 'Recheio Belga', 'M', '16.74'),
(13, 6, 'Dose', 'M', '0.73'),
(14, 3, 'teste4', 'P', '0.10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fichastecnicas_has_produtofinal`
--

CREATE TABLE IF NOT EXISTS `fichastecnicas_has_produtofinal` (
  `produtofinal_cod_produtofinal` int(11) NOT NULL AUTO_INCREMENT,
  `fichaTecnica_cod_fichaTecnica` int(11) NOT NULL,
  `quantidade` decimal(6,3) NOT NULL,
  `precounitario` decimal(10,2) NOT NULL,
  `custo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`produtofinal_cod_produtofinal`,`fichaTecnica_cod_fichaTecnica`),
  KEY `fichaTecnica_cod_fichaTecnica` (`fichaTecnica_cod_fichaTecnica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `fichastecnicas_has_produtofinal`
--

INSERT INTO `fichastecnicas_has_produtofinal` (`produtofinal_cod_produtofinal`, `fichaTecnica_cod_fichaTecnica`, `quantidade`, `precounitario`, `custo`) VALUES
(14, 10, '8.000', '1.56', '12.48'),
(15, 9, '1.000', '4.30', '4.30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE IF NOT EXISTS `ingrediente` (
  `cod_ingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `cod_unidademedida` int(11) NOT NULL,
  `valorunitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_ingrediente`),
  KEY `cod_unidademedida` (`cod_unidademedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Extraindo dados da tabela `ingrediente`
--

INSERT INTO `ingrediente` (`cod_ingrediente`, `nome`, `cod_unidademedida`, `valorunitario`) VALUES
(2, 'creme de leite', 1, '6.36'),
(6, 'Farinha de trigo fina', 1, '2.30'),
(8, 'AÃ§ucar Refinado', 1, '3.65'),
(11, 'limÃ£o', 2, '0.15'),
(13, 'Leite', 3, '2.19'),
(16, 'Banana da terra', 2, '9.70'),
(17, 'Azeitona verde s/ caroÃ§o', 2, '6.30'),
(18, 'Extrato de tomate ', 2, '2.81'),
(19, 'Damasco', 1, '28.00'),
(20, 'Nozes', 1, '37.00'),
(21, 'CÃ´co fresco ralado', 1, '21.60'),
(22, 'chocolate 50%', 1, '15.00'),
(23, 'Nescau', 1, '9.00'),
(24, 'Chantinly', 3, '8.90'),
(25, 'chocolate ao leite', 1, '10.99'),
(26, 'Chocolate meio amargo', 1, '16.51'),
(27, 'Margarina QUALY', 1, '12.50'),
(28, 'Ovo', 2, '0.28'),
(29, 'chocolate 32%', 1, '13.00'),
(30, 'Clara de ovo', 2, '0.16'),
(32, 'Ganache  Brilhoso', 1, '7.51'),
(33, 'leite Condensado 5kg', 1, '6.55'),
(34, 'Leite em PÃ³', 1, '11.95'),
(35, 'Gelatina', 1, '10.33'),
(36, 'leite de cÃ´co', 3, '5.25'),
(37, 'Creme para Chantily', 2, '14.00'),
(38, 'Wisky', 3, '25.90'),
(39, 'Fermento', 1, '15.90'),
(40, 'leite condensado 395g', 1, '7.08'),
(41, 'Mousse de chocolate', 1, '37.20'),
(42, 'Mousse de chocolate branco', 1, '39.24'),
(43, 'Raspa de limÃ£o', 2, '0.01'),
(44, 'Maisena', 1, '5.00'),
(45, 'queijo ralado', 1, '5.00'),
(46, 'Morango', 2, '0.24'),
(47, 'Biscoito negresco Granulado', 1, '18.79'),
(48, 'AÃ§ucar Cristal', 1, '2.49'),
(49, 'raÃ§Ã£o humana', 5, '2.00'),
(50, 'Gelatina de 40g', 1, '1.50'),
(51, 'MEUTESTE', 3, '120.99');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente_has_fichastecnicas`
--

CREATE TABLE IF NOT EXISTS `ingrediente_has_fichastecnicas` (
  `fichaTecnica_cod_fichaTecnica` int(11) NOT NULL,
  `ingrediente_cod_ingrediente` int(11) NOT NULL,
  `quantidade` decimal(6,3) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `custo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`fichaTecnica_cod_fichaTecnica`,`ingrediente_cod_ingrediente`),
  KEY `ingrediente_cod_ingrediente` (`ingrediente_cod_ingrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ingrediente_has_fichastecnicas`
--

INSERT INTO `ingrediente_has_fichastecnicas` (`fichaTecnica_cod_fichaTecnica`, `ingrediente_cod_ingrediente`, `quantidade`, `preco`, `custo`) VALUES
(1, 6, '0.150', '2.15', '0.32'),
(3, 6, '0.990', '0.01', '2.13'),
(8, 49, '0.029', '2.00', '0.01'),
(9, 6, '2.000', '2.15', '4.30'),
(10, 2, '0.177', '6.36', '1.13'),
(10, 6, '0.200', '2.16', '0.43'),
(11, 6, '1.000', '2.16', '2.16'),
(11, 8, '300.000', '3.65', '1.09'),
(11, 28, '3.000', '0.28', '0.84'),
(12, 2, '1.000', '6.36', '6.36'),
(12, 25, '300.000', '10.99', '3.30'),
(12, 40, '1.000', '7.08', '7.08'),
(13, 8, '0.200', '3.65', '0.73'),
(14, 25, '0.009', '10.99', '0.10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `novacompra`
--

CREATE TABLE IF NOT EXISTS `novacompra` (
  `cod_novacompra` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `quantidade` int(10) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_validade` date NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `cod_ingrediente` int(11) NOT NULL,
  `quantidade_total` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `cod_unidademedida` int(11) NOT NULL,
  `tipo_entrada` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_novacompra`),
  UNIQUE KEY `unq_cod_novacompra` (`cod_novacompra`),
  UNIQUE KEY `novacompra_ibfk_1` (`cod_novacompra`),
  UNIQUE KEY `cod_novacompra` (`cod_novacompra`),
  UNIQUE KEY `fk_cod_novacompra` (`cod_novacompra`),
  UNIQUE KEY `fk_cod_novacompraa` (`cod_novacompra`),
  UNIQUE KEY `fk_codnovacompraa` (`cod_novacompra`),
  UNIQUE KEY `fk_codigo_novacompra` (`cod_novacompra`),
  KEY `cod_tipoingrediente` (`cod_ingrediente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `novacompra`
--

INSERT INTO `novacompra` (`cod_novacompra`, `nome`, `quantidade`, `data_entrada`, `data_validade`, `preco`, `cod_ingrediente`, `quantidade_total`, `qtd`, `cod_unidademedida`, `tipo_entrada`) VALUES
(1, 'fardos', 1, '2016-05-06', '2016-08-04', '5.00', 11, 4, 0, 0, 0),
(2, 'caixas', 1, '2016-05-10', '2016-08-08', '12.60', 17, 2, 0, 0, 0),
(3, 'caixas', 1, '2016-05-10', '2016-08-08', '4.50', 11, 0, 0, 0, 0),
(4, 'caixas', 1, '2016-05-12', '2016-08-10', '25.90', 38, 1, 0, 0, 0),
(5, 'fardos', 1, '2016-05-09', '2016-08-10', '26.40', 8, 10, 0, 0, 0),
(6, 'fardos', 1, '2016-05-12', '2016-08-10', '159.00', 39, 10, 0, 0, 0),
(7, 'caixas', 30, '2016-05-12', '2016-08-11', '105.00', 28, 30, 0, 0, 0),
(8, 'sacos', 12, '2016-06-02', '2016-08-31', '1.00', 49, 10, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtofinal`
--

CREATE TABLE IF NOT EXISTS `produtofinal` (
  `cod_produtofinal` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) DEFAULT NULL,
  `tamanho` varchar(10) NOT NULL,
  `valortotal` decimal(10,2) NOT NULL,
  `valorvenda` decimal(10,2) DEFAULT NULL,
  `porcentagem` int(11) NOT NULL,
  PRIMARY KEY (`cod_produtofinal`),
  KEY `cod_produto` (`cod_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `produtofinal`
--

INSERT INTO `produtofinal` (`cod_produtofinal`, `cod_produto`, `tamanho`, `valortotal`, `valorvenda`, `porcentagem`) VALUES
(14, 1, 'P', '12.48', '20.00', 0),
(15, 1, 'P', '4.30', '20.00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `cod_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `tamanho` char(1) DEFAULT '-',
  `preco` decimal(5,2) NOT NULL,
  `cod_tipoproduto` int(100) NOT NULL,
  `cod_torta_fat` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_produto`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `nome_2` (`nome`),
  KEY `cod_tipoproduto` (`cod_tipoproduto`),
  KEY `fk_produtos_cod_produto` (`cod_torta_fat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`cod_produto`, `nome`, `tamanho`, `preco`, `cod_tipoproduto`, `cod_torta_fat`) VALUES
(1, 'Torta Doce', 'P', '222.22', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_has_encomedas`
--

CREATE TABLE IF NOT EXISTS `produtos_has_encomedas` (
  `Produtos_cod_Produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `Encomedas_cod_Encomenda` int(11) NOT NULL,
  PRIMARY KEY (`Produtos_cod_Produto`,`Encomedas_cod_Encomenda`),
  KEY `Produtos_has_Encomedas_FKIndex1` (`Produtos_cod_Produto`),
  KEY `Produtos_has_Encomedas_FKIndex2` (`Encomedas_cod_Encomenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE IF NOT EXISTS `receita` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `qntreceita` float NOT NULL,
  `cod_novacompra` int(11) NOT NULL,
  `valorunitario` double NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `cod_novacompra` (`cod_novacompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registrosaida`
--

CREATE TABLE IF NOT EXISTS `registrosaida` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_composicao` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_saida` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `cod_composicao` (`cod_composicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoproduto`
--

CREATE TABLE IF NOT EXISTS `tipoproduto` (
  `cod_tipoproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_tipoproduto`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tipoproduto`
--

INSERT INTO `tipoproduto` (`cod_tipoproduto`, `nome`) VALUES
(3, 'CupCake'),
(2, 'Doces'),
(1, 'Torta'),
(7, 'Torta doce tradicional');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidademedida`
--

CREATE TABLE IF NOT EXISTS `unidademedida` (
  `cod_unidademedida` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  PRIMARY KEY (`cod_unidademedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `unidademedida`
--

INSERT INTO `unidademedida` (`cod_unidademedida`, `nome`) VALUES
(1, 'kg'),
(2, 'u'),
(3, 'l'),
(4, 'xic'),
(5, 'g'),
(6, 'ml'),
(7, 'cx'),
(13, 'mg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `acesso` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  UNIQUE KEY `cpf` (`cpf`,`login`),
  UNIQUE KEY `cpf_2` (`cpf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `name`, `cpf`, `email`, `mobile`, `login`, `senha`, `acesso`) VALUES
(11, 'Rodrigo ConceiÃ§Ã£o dos Santos', '2147483647', 'rodrigoFN.CDV@gmail.com', '7133976874', 'rodrigo', 'e10adc3949ba59abbe56e057f20f883e', 'AdministraÃ§Ã£o'),
(20, 'Gabriel Lima', '504.887.939-20', 'Gabriel@emporio.com', '71 99999-9990', 'gabriel', '81dc9bdb52d04dc20036dbd8313ed055', 'AdministraÃ§Ã£o'),
(22, 'Caroline Pimentel', '928922', 'caroline_pimentel@yahoo.com.br', '71 99165-0169', 'cpimentel', '827ccb0eea8a706c4c34a16891f84e7b', 'AdministraÃ§Ã£o'),
(23, 'Jessica Rocha Cardoso', '861.584.455-09', 'jessica.cardosor@gmail.com', '71-8309-8938', 'jessica', '827ccb0eea8a706c4c34a16891f84e7b', 'administraçao'),
(24, 'Marluce Marques Santos', '071.264.955-79', 'marluceadm31@gmail.com', '7186889852', 'marlu', '81dc9bdb52d04dc20036dbd8313ed055', 'ProduÃ§Ã£o'),
(25, 'Cris', '127.037.831-75', 'outrocris@gmail.com', '7186889852', 'cris', '81dc9bdb52d04dc20036dbd8313ed055', 'Vendas'),
(26, 'Thais', '913.643.689-51', 'THAI@LINDA.COM', '7186889852', 'thay', '81dc9bdb52d04dc20036dbd8313ed055', 'ProduÃ§Ã£o');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE IF NOT EXISTS `vendas` (
  `cod_venda` int(11) NOT NULL AUTO_INCREMENT,
  `cod_Produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` double NOT NULL,
  `data` date DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_venda`),
  KEY `cod_Produto` (`cod_Produto`),
  KEY `fk_cod_usuario` (`cod_usuario`),
  KEY `cod_cliente` (`cod_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Acionadores `vendas`
--
DROP TRIGGER IF EXISTS `atualizar_estoquevenda`;
DELIMITER //
CREATE TRIGGER `atualizar_estoquevenda` AFTER INSERT ON `vendas`
 FOR EACH ROW BEGIN
UPDATE estoquevenda
SET quantidade = quantidade - NEW.quantidade
WHERE cod_produto = NEW.cod_produto;
END
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `composicao`
--
ALTER TABLE `composicao`
  ADD CONSTRAINT `composicao_ibfk_1` FOREIGN KEY (`cod_receita`) REFERENCES `receita` (`codigo`);

--
-- Limitadores para a tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`);

--
-- Limitadores para a tabela `estoquevenda`
--
ALTER TABLE `estoquevenda`
  ADD CONSTRAINT `estoquevenda_ibfk_2` FOREIGN KEY (`cod_Produto`) REFERENCES `produtos` (`cod_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `exemplo`
--
ALTER TABLE `exemplo`
  ADD CONSTRAINT `fk_teste` FOREIGN KEY (`cod_exe_fat`) REFERENCES `exemplo` (`cod_exe`);

--
-- Limitadores para a tabela `fichastecnicas`
--
ALTER TABLE `fichastecnicas`
  ADD CONSTRAINT `fichastecnicas_ibfk_1` FOREIGN KEY (`categoriafichatecnica_codigo`) REFERENCES `categoriafichatecnica` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fichastecnicas_has_produtofinal`
--
ALTER TABLE `fichastecnicas_has_produtofinal`
  ADD CONSTRAINT `fichastecnicas_has_produtofinal_ibfk_1` FOREIGN KEY (`fichaTecnica_cod_fichaTecnica`) REFERENCES `fichastecnicas` (`cod_fichaTecnica`);

--
-- Limitadores para a tabela `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`cod_unidademedida`) REFERENCES `unidademedida` (`cod_unidademedida`);

--
-- Limitadores para a tabela `ingrediente_has_fichastecnicas`
--
ALTER TABLE `ingrediente_has_fichastecnicas`
  ADD CONSTRAINT `ingrediente_has_fichastecnicas_ibfk_1` FOREIGN KEY (`ingrediente_cod_ingrediente`) REFERENCES `ingrediente` (`cod_ingrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ingrediente_has_fichastecnicas_ibfk_2` FOREIGN KEY (`fichaTecnica_cod_fichaTecnica`) REFERENCES `fichastecnicas` (`cod_fichaTecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `novacompra`
--
ALTER TABLE `novacompra`
  ADD CONSTRAINT `novacompra_ibfk_1` FOREIGN KEY (`cod_ingrediente`) REFERENCES `ingrediente` (`cod_ingrediente`);

--
-- Limitadores para a tabela `produtofinal`
--
ALTER TABLE `produtofinal`
  ADD CONSTRAINT `produtofinal_ibfk_1` FOREIGN KEY (`cod_produto`) REFERENCES `produtos` (`cod_produto`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_cod_tipoproduto` FOREIGN KEY (`cod_tipoproduto`) REFERENCES `tipoproduto` (`cod_tipoproduto`),
  ADD CONSTRAINT `fk_produtos_cod_produto` FOREIGN KEY (`cod_torta_fat`) REFERENCES `produtos` (`cod_produto`);

--
-- Limitadores para a tabela `produtos_has_encomedas`
--
ALTER TABLE `produtos_has_encomedas`
  ADD CONSTRAINT `fk_encomendas` FOREIGN KEY (`Encomedas_cod_Encomenda`) REFERENCES `encomendas` (`cod_Encomenda`),
  ADD CONSTRAINT `fk_produto` FOREIGN KEY (`Produtos_cod_Produto`) REFERENCES `produtos` (`cod_produto`);

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`cod_novacompra`) REFERENCES `novacompra` (`cod_novacompra`);

--
-- Limitadores para a tabela `registrosaida`
--
ALTER TABLE `registrosaida`
  ADD CONSTRAINT `registrosaida_ibfk_1` FOREIGN KEY (`cod_composicao`) REFERENCES `composicao` (`codigo`);

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`),
  ADD CONSTRAINT `fk_cod_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`),
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`cod_Produto`) REFERENCES `produtos` (`cod_produto`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
