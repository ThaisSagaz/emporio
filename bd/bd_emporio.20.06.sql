-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jun-2016 às 04:49
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
(1, 1, -1, 'Disponivel', '2016-06-08', 'Interno', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `fichastecnicas`
--

INSERT INTO `fichastecnicas` (`cod_fichaTecnica`, `categoriafichatecnica_codigo`, `nome`, `Tamanho`, `valortotal`) VALUES
(9, 3, 'bombom', 'P', '4.30'),
(15, 3, 'arabesco', 'P', '10.16'),
(16, 7, 'Bolo preto', 'P', '4.70'),
(17, 7, 'Bolo Branco', 'P', '4.33'),
(18, 3, 'Mashmallow', 'P', '6.75'),
(19, 6, 'PÃ© de moleque', 'P', '0.15'),
(20, 2, 'Recheio Preto', 'P', '1.32'),
(21, 2, 'Recheio Branco', 'P', '1.41'),
(22, 3, 'Gel de brilho', 'P', '6.16');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `fichastecnicas_has_produtofinal`
--

INSERT INTO `fichastecnicas_has_produtofinal` (`produtofinal_cod_produtofinal`, `fichaTecnica_cod_fichaTecnica`, `quantidade`, `precounitario`, `custo`) VALUES
(8, 15, '0.000', '10.16', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE IF NOT EXISTS `ingrediente` (
  `cod_ingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cod_unidademedida` int(11) NOT NULL,
  `valorunitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_ingrediente`),
  KEY `cod_unidademedida` (`cod_unidademedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Extraindo dados da tabela `ingrediente`
--

INSERT INTO `ingrediente` (`cod_ingrediente`, `nome`, `cod_unidademedida`, `valorunitario`) VALUES
(2, 'creme de leite', 1, '6.36'),
(6, 'Farinha de trigo fina', 1, '2.16'),
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
(24, 'Chantinly', 1, '15.97'),
(25, 'chocolate ao leite', 1, '10.99'),
(26, 'Chocolate gotas meio amargo', 1, '10.16'),
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
(39, 'Fermento', 1, '12.15'),
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
(51, 'MEUTESTE', 3, '120.99'),
(52, 'chocolate gotas leite ', 1, '9.96'),
(53, 'Ganache Branco', 1, '10.49'),
(54, 'Chocolate barra meio amargo', 1, '9.80'),
(55, 'Tapioca', 1, '4.47'),
(56, 'Mashmallow', 1, '13.50'),
(57, 'Aipim', 1, '6.00'),
(58, 'CÃ´co ralado seco', 1, '7.00'),
(59, 'Coco seco ralado', 1, '7.00'),
(60, 'chocolate mousse Nestle', 1, '37.20'),
(61, 'Chocolate Branco mousse', 1, '39.24'),
(62, 'Agua', 3, '0.01'),
(63, 'PÃ© de moleque', 2, '0.15');

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
(15, 26, '1.000', '10.16', '10.16'),
(16, 6, '0.177', '2.16', '0.38'),
(16, 8, '0.166', '3.65', '0.61'),
(16, 13, '0.111', '2.19', '0.24'),
(16, 22, '0.029', '15.00', '0.43'),
(16, 27, '0.133', '12.50', '1.66'),
(16, 28, '2.770', '0.28', '0.78'),
(16, 29, '0.038', '13.00', '0.49'),
(16, 39, '0.009', '12.15', '0.11'),
(17, 6, '0.177', '2.16', '0.38'),
(17, 8, '0.177', '3.65', '0.65'),
(17, 27, '0.144', '12.50', '1.80'),
(17, 28, '2.770', '0.28', '0.78'),
(17, 36, '0.066', '5.25', '0.35'),
(17, 39, '0.010', '12.15', '0.12'),
(17, 43, '1.000', '0.01', '0.00'),
(17, 44, '0.044', '5.00', '0.22'),
(17, 45, '0.005', '5.00', '0.03'),
(18, 56, '0.500', '13.50', '6.75'),
(18, 62, '0.175', '0.01', '0.00'),
(19, 63, '1.000', '0.15', '0.15'),
(20, 2, '0.025', '6.36', '0.16'),
(20, 22, '0.005', '15.00', '0.07'),
(20, 23, '0.008', '9.00', '0.07'),
(20, 33, '0.156', '6.55', '1.02'),
(21, 2, '0.016', '6.36', '0.10'),
(21, 33, '0.200', '6.55', '1.31'),
(22, 2, '0.400', '6.36', '2.54'),
(22, 8, '0.300', '3.65', '1.09'),
(22, 22, '0.086', '15.00', '1.29'),
(22, 35, '0.120', '10.33', '1.24'),
(22, 62, '0.200', '0.01', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `novacompra`
--

CREATE TABLE IF NOT EXISTS `novacompra` (
  `cod_novacompra` int(11) NOT NULL AUTO_INCREMENT,
  `identificacao` varchar(30) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `cod_ingrediente` int(11) NOT NULL,
  `quantidade_total` decimal(6,3) NOT NULL,
  `quantidade` decimal(6,3) NOT NULL,
  PRIMARY KEY (`cod_novacompra`),
  UNIQUE KEY `unq_cod_novacompra` (`cod_novacompra`),
  UNIQUE KEY `novacompra_ibfk_1` (`cod_novacompra`),
  UNIQUE KEY `cod_novacompra` (`cod_novacompra`),
  UNIQUE KEY `fk_cod_novacompra` (`cod_novacompra`),
  UNIQUE KEY `fk_cod_novacompraa` (`cod_novacompra`),
  UNIQUE KEY `fk_codnovacompraa` (`cod_novacompra`),
  UNIQUE KEY `fk_codigo_novacompra` (`cod_novacompra`),
  KEY `cod_tipoingrediente` (`cod_ingrediente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `novacompra`
--

INSERT INTO `novacompra` (`cod_novacompra`, `identificacao`, `preco`, `cod_ingrediente`, `quantidade_total`, `quantidade`) VALUES
(13, 'Kg', '50.00', 11, '999.999', '0.000'),
(14, 'Kg', '50.00', 2, '999.999', '0.000'),
(15, 'Kg', '6.66', 2, '3.500', '0.500');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtofinal`
--

CREATE TABLE IF NOT EXISTS `produtofinal` (
  `cod_produtofinal` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `tamanho` varchar(10) NOT NULL,
  `valortotal` decimal(10,2) NOT NULL,
  `valorvenda` decimal(10,2) DEFAULT NULL,
  `porcentagem` int(11) NOT NULL,
  PRIMARY KEY (`cod_produtofinal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `produtofinal`
--

INSERT INTO `produtofinal` (`cod_produtofinal`, `nome`, `tamanho`, `valortotal`, `valorvenda`, `porcentagem`) VALUES
(8, 'torta crocante', 'P', '0.00', '0.00', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `name`, `cpf`, `email`, `mobile`, `login`, `senha`, `acesso`) VALUES
(11, 'Rodrigo ConceiÃ§Ã£o dos Santos', '2147483647', 'rodrigoFN.CDV@gmail.com', '7133976874', 'rodrigo', 'e10adc3949ba59abbe56e057f20f883e', 'AdministraÃ§Ã£o'),
(20, 'Gabriel Lima', '504.887.939-20', 'Gabriel@emporio.com', '71 99999-9990', 'gabriel', '81dc9bdb52d04dc20036dbd8313ed055', 'AdministraÃ§Ã£o'),
(22, 'Caroline Pimentel', '928922', 'caroline_pimentel@yahoo.com.br', '71 99165-0169', 'cpimentel', '827ccb0eea8a706c4c34a16891f84e7b', 'AdministraÃ§Ã£o'),
(23, 'Jessica Rocha Cardoso', '861.584.455-09', 'jessica.cardosor@gmail.com', '71-8309-8938', 'jessica', '827ccb0eea8a706c4c34a16891f84e7b', 'administraçao');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`cod_venda`, `cod_Produto`, `quantidade`, `valor`, `data`, `cod_usuario`, `cod_cliente`) VALUES
(1, 1, 1, 222.22, '2016-06-14', 23, 1),
(2, 1, 1, 222.22, '2016-06-14', 23, 1);

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
