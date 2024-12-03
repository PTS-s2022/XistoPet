-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/12/2024 às 12:17
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `xistopet`
--
CREATE DATABASE IF NOT EXISTS `xistopet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `xistopet`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_administrador`
--

CREATE TABLE `tb_administrador` (
  `id` int(11) NOT NULL,
  `nome` varbinary(100) NOT NULL,
  `cpf` varbinary(22) NOT NULL,
  `telefone` varbinary(22) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `dateCreate` datetime DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_administrador`
--

INSERT INTO `tb_administrador` (`id`, `nome`, `cpf`, `telefone`, `usuario`, `nivel`, `dateCreate`, `dateModify`) VALUES
(1, 0xae20c15abe07b3952d9fcd489a48a47d27b6c998b7a89edd1fb0dce628ccc48f, 0x079fcce97adff021b71cad026897320e, 0x3693ffd1f2b3ca3c5251ff85be6dee25, 1, 3, '2024-12-02 22:34:07', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_administrador_nivel`
--

CREATE TABLE `tb_administrador_nivel` (
  `id` int(11) NOT NULL,
  `nivel` int(1) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_administrador_nivel`
--

INSERT INTO `tb_administrador_nivel` (`id`, `nivel`, `dateCreate`, `dateModify`) VALUES
(2, 2, '2024-07-30 20:57:28', '2024-11-27 12:34:46'),
(3, 3, '2024-11-27 12:35:05', '2024-11-27 12:35:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `imagem` varchar(255) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`id`, `categoria`, `ativo`, `imagem`, `dateCreate`, `dateModify`) VALUES
(1, 'Ração de gato', 1, '34_Ração_de_gato_1.jpg', '2024-12-02 22:36:39', '2024-12-02 23:08:06'),
(2, 'Brinquedo de gato', 1, '35_Brinquedo_de_gato_1.jpg', '2024-12-02 22:37:01', '2024-12-02 23:08:09'),
(3, 'Ração de cachorro', 1, '36_Ração_de_cachorro_1.jpg', '2024-12-02 22:37:53', '2024-12-02 23:08:13'),
(4, 'Brinquedo de cachorro', 1, '37_Brinquedo_de_cachorro_1.jpg', '2024-12-02 22:38:18', '2024-12-02 23:08:17'),
(5, 'Medicamento', 1, '38_Medicamento_1.jpg', '2024-12-02 22:38:37', '2024-12-02 23:08:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id` int(11) NOT NULL,
  `nome` varbinary(300) NOT NULL,
  `cpf` varbinary(40) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dataModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id`, `nome`, `cpf`, `usuario`, `dateCreate`, `dataModify`) VALUES
(21, 0x255e8295d53cff73056c16bf3a386b947f3d7bab2d8057b4471f84f87d72d16b, 0x1666c19eab0cdab1aa2d6fb966ca660d, 43, '2024-12-02 23:18:12', '2024-12-03 07:52:42'),
(22, 0x255e8295d53cff73056c16bf3a386b947f3d7bab2d8057b4471f84f87d72d16b, NULL, 44, '2024-12-03 08:55:12', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_cartao`
--

CREATE TABLE `tb_cliente_cartao` (
  `id` int(11) NOT NULL,
  `numero` varbinary(40) NOT NULL,
  `nomeTitular` varbinary(400) NOT NULL,
  `validade` varbinary(30) NOT NULL,
  `cvv` varbinary(30) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente_cartao`
--

INSERT INTO `tb_cliente_cartao` (`id`, `numero`, `nomeTitular`, `validade`, `cvv`, `ativo`, `cliente`, `dateCreate`, `dateModify`) VALUES
(7, 0x1e65830c7ef10e13aa3ee7409075762a69ee181bb0f0f7b27f869eef449404cd, 0xbecf4b23ed9e50395d8d6b89f292184c, 0x94c3c97e61fb0bb9e205d3fe437b1abd, 0xa6e7e86c2e08bb399a107994d53cfa50, 1, 21, '2024-12-03 07:51:16', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_endereco`
--

CREATE TABLE `tb_cliente_endereco` (
  `id` int(11) NOT NULL,
  `cep` varchar(16) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varbinary(255) NOT NULL,
  `logradouro` varbinary(255) NOT NULL,
  `numero` varbinary(20) NOT NULL,
  `complemento` varbinary(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente_endereco`
--

INSERT INTO `tb_cliente_endereco` (`id`, `cep`, `estado`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`, `ativo`, `cliente`, `dateCreate`, `dateModify`) VALUES
(17, '18745-000', 'SP', 'Coronel Macedo', 0x42cac38bd928781a469ce7f37b8b2d33, 0x07ef09430d3eab64d990e1979d48c934dddfd01c119b8e8b5186f16915d02ec6, 0x1f82595f05db20d58be75efbc3f6a6dc, NULL, 1, 21, '2024-12-03 07:52:19', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_favorito`
--

CREATE TABLE `tb_cliente_favorito` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_notificacao`
--

CREATE TABLE `tb_cliente_notificacao` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `itemVenda` int(11) DEFAULT NULL,
  `venda` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente_notificacao`
--

INSERT INTO `tb_cliente_notificacao` (`id`, `date`, `itemVenda`, `venda`, `tipo`, `cliente`, `dateCreate`, `dateModify`) VALUES
(7, '2024-12-03', NULL, 56, 2, 21, '2024-12-03 08:03:48', '2024-12-03 08:43:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_notificacao_tipo`
--

CREATE TABLE `tb_cliente_notificacao_tipo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente_notificacao_tipo`
--

INSERT INTO `tb_cliente_notificacao_tipo` (`id`, `tipo`, `dateCreate`, `dateModify`) VALUES
(1, 'avaliar', '2024-12-02 20:50:34', NULL),
(2, 'pagamentoConfirmado', '2024-12-02 20:50:34', NULL),
(3, 'pedidoACaminho', '2024-12-02 20:50:34', NULL),
(4, 'pedidoEntregue', '2024-12-02 20:50:34', NULL),
(5, 'pedidoCancelado', '2024-12-02 20:50:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_telefone`
--

CREATE TABLE `tb_cliente_telefone` (
  `id` int(11) NOT NULL,
  `telefone` varbinary(28) NOT NULL,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fornecedor`
--

CREATE TABLE `tb_fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varbinary(300) NOT NULL,
  `cnpj` varbinary(28) NOT NULL,
  `telefone` varbinary(28) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fornecedor_fornecimento`
--

CREATE TABLE `tb_fornecedor_fornecimento` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `estoque` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_metodo_pagamento`
--

CREATE TABLE `tb_metodo_pagamento` (
  `id` int(11) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_metodo_pagamento`
--

INSERT INTO `tb_metodo_pagamento` (`id`, `metodo`, `ativo`, `dateCreate`, `dateModify`) VALUES
(1, 'pix', 1, '2024-10-07 11:25:33', '2024-10-07 11:27:30'),
(2, 'boleto', 1, '2024-10-07 11:25:33', '2024-10-07 11:27:34'),
(3, 'cartao', 1, '2024-10-07 11:26:55', '2024-10-07 11:27:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `avaliacao` decimal(2,1) DEFAULT 0.0,
  `cor` tinyint(1) NOT NULL DEFAULT 0,
  `tamanho` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `categoria` int(11) NOT NULL,
  `dateCreate` datetime DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto`
--

INSERT INTO `tb_produto` (`id`, `nome`, `descricao`, `avaliacao`, `cor`, `tamanho`, `ativo`, `categoria`, `dateCreate`, `dateModify`) VALUES
(1, 'Ração Whiskas Carne para Gatos Adultos Castrados', '- Ração Premium 100% completa e balanceada, ideal para gatos castrados;<br>- Com minerais controlados para ajudar a manter um trato urinário saudável;<br>- Possui nível de gordura regulado para ajudar na manutenção do peso do gato;<br>- Anti-bolas de pelo', 5.0, 0, 1, 1, 1, '2024-09-02 20:05:01', '2024-09-16 18:23:42'),
(2, 'Ração Seca PremieR Pet Golden Gatos Filhotes Frango', '- Sabor inigualável: favorece máxima satisfação para paladares exigentes; \r\n- Trato urinário saudável: minerais balanceados e controle do pH urinário; \r\n- Crescimento saudável: através de ótimos níveis de proteínas, taurina e DHA\r\n- Redução do odor das fezes: seleção de ingredientes especiais que auxiliam na redução do odor das fezes.\r\n-Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nDetalhes\r\nA boa nutrição na infância é determinante para um adulto saudável, por isso foi desenvolvida a Ração Seca PremieR Pet Golden Gatos Filhotes Frango. Perfeitamente balanceada, atende por completo às necessidades de seu pequeno felino, oferecendo níveis ótimos de energia, proteínas, vitaminas e minerais, nutrientes indispensáveis para um desenvolvimento pleno e saudável.\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do PremieR Responde – Telefone 0800 055 66 66.\r\nPara mais informações acesse: https://www.premierpet.com.br/garantia-premierpet/', 4.3, 0, 1, 1, 1, '2024-09-12 21:13:16', '2024-12-03 08:57:04'),
(3, 'Shampoo Pet Society Hydra Groomers Pelos Escuros para Cães e Gatos', 'Resumo<br><br>\r\n- Conta com pH balanceado;<br>\r\n- Realça a cor escura dos pelos;<br>\r\n- Secagem rápida e fácil de enxaguar;<br>\r\n- Fórmula concentrada com extrato de nogueira;<br>\r\n- Indicado para cães e gatos com pelagem escura.<br>\r\n<br><br><br>\r\nDetalhes<br><br>\r\nO Shampoo Pet Society Hydra Groomers Pelos Escuros para Cães e Gatos é perfeito para deixar a pelagem sedosa e hidratada. Contém ativos que realçam a cor escura dos pelos, deixando seu pet deslumbrante e com a coloração perfeita. Sua fórmula com extrato de nogueira não agride os pelos e conta também com pH balanceado, sendo fácil de enxaguar e sem complicações na hora de dar banho.', 0.0, 0, 1, 1, 2, '2024-11-05 18:58:22', NULL),
(4, 'Brinquedo Chalesco Pelúcia Macaco', 'Resumo\r\n- Possui material macio e resistente, feito com poliéster e algodão;\r\n- Alivia o estresse e ociosidade, garantindo diversão e entreterimento;\r\n- Emite som ao ser apertado em um dos brações, em uma das pernas e no corpo;\r\n- Formato atrativo, estimula o raciocínio do pet, indicado para cães de todos os portes.\r\n\r\nÉ importante lembrar que nenhum brinquedo é 100% indestrutível e a brincadeira precisa ser monitorada. *Imagem meramente ilustrativa.\r\n\r\nDetalhes\r\nO Brinquedo Chalesco Pelúcia Macaco é uma ótima opção para satisfazer a vontade morder do seu pet. Os brinquedos incentivam seu cão a canalizar a energia, entretêm e garante diversão, além de estimular a prática das atividades físicas e ajudar seu filho de quatro patas a aliviar o estresse. Eles são confeccionados com toque macio que é agradável e possui textura diferenciada que desperta o interesse e anima a brincadeira. Uma ótima opção para livrar seu cão da ansiedade e do tédio.', 0.0, 0, 1, 1, 3, '2024-11-05 19:05:22', NULL),
(7, 'Matheus', 'muito bom', 0.0, 0, 1, 0, 1, '2024-11-28 16:51:05', '2024-11-28 19:09:43'),
(8, 'wiscas', 'muito bom', 0.0, 0, 1, 0, 1, '2024-11-28 16:53:51', '2024-11-28 19:10:06'),
(9, 'Ração Seca Nutrilus Pro+ Frango & Carne para Cães Adultos de Raças Médias e Grandes', 'Nutrilus Pro+ Cães Adultos é uma ração premium especial, desenvolvida por médicos veterinários, com ingredientes selecionados, sem corantes e sem aromatizantes artificiais, garantindo uma alimentação balanceada mais saborosa e nutritiva. Mais sabor, mais proteína e mais nutrição.\r\n\r\nGarantia de Satisfação: Nutrilus acredita que a satisfação é um comprometimento com a vida do pet, e garantimos você e seu pet satisfeitos ou seu dinheiro de volta..*\r\n\r\n- Proteínas de alta qualidade: favorece o ótimo aproveitamento dos nutrientes para a manutenção da musculatura e condição corporal ideal;\r\n- Intestino saudável: com fibras que favorecem uma função intestinal regular;\r\n- Redução do odor das fezes: com extrato de yucca, ideal para ambientes internos;\r\n- Pelagem macia e brilhante: aporte equilibrado de ácidos graxos essenciais, ômegas 3 e 6, vitaminas e minerais;\r\n- Defesa do organismo: enriquecido com DHA que contribui para a redução de inflamações e saúde do coração.\r\n\r\n- Sabor: Frango & Carne\r\n- Embalagem: disponível nas versões de 15kg e 20kg\r\n- Tamanho médio do grão: 13,5mm\r\n- Indicado para: cães adultos de raças médias e grandes', 0.0, 0, 1, 1, 2, '2024-11-28 17:11:06', NULL),
(10, 'Matheus', 'maheiius', 0.0, 0, 1, 0, 0, '2024-11-28 21:06:02', '2024-11-28 21:10:38'),
(11, 'Catnip Chalesco Erva de Gato', '- Atrativo funcional para o seu gato, cada frasco contém 5 g;\r\n- Auxilia na redução da ansiedade e estresse dos felinos;\r\n- Proporciona atividade física e entretenimento para seu pet;\r\n- Material de alta qualidade, seguro e não agride a saúde do pet.\r\n\r\nÉ importante lembrar que nenhum brinquedo é 100% indestrutível e a brincadeira precisa ser monitorada.', 0.0, 0, 1, 1, 4, '2024-11-29 22:56:56', NULL),
(12, 'Matheus Vieira Rodrigues', 'asdfasdf', 0.0, 0, 1, 0, 6, '2024-12-01 10:28:33', '2024-12-03 08:56:20'),
(13, 'Ração Seca Nutrilus Pro+ Carne para Gatos Adultos Castrados', 'Nutrilus Pro Gatos Adultos Castrados é uma ração premium especial, desenvolvida por médicos veterinários com ingredientes selecionados, sem corantes e sem aromatizantes artificiais, garantindo uma alimentação balanceada e um sabor irresistível, com o melhor custo-benefício.\r\n\r\n- Trato urinário saudável: formulado com quantidades equilibradas de minerais para auxiliar no controle do pH urinário;\r\n- Proteínas de alta qualidade: favorece o ótimo aproveitamento dos nutrientes para a manutenção da musculatura e condição corporal ideal;\r\n- Intestino saudável: com fibras que favorecem uma função intestinal regular;\r\n- Pelagem macia e brilhante: aporte equilibrado de ácidos graxos essenciais, ômega 3 e 6, vitaminas e minerais;\r\n- Redução do odor das fezes: com extrato de yucca, ideal para ambientes internos;\r\n- Controle de peso: com nível reduzido de calorias e gorduras, e enriquecido com L-carnitina.\r\n\r\n- Sabor: Carne\r\n- Embalagem: disponível na versão de 10,1kg\r\n- Tamanho do grão: 9mm\r\n- Indicado para: gatos adultos castrados\r\n\r\n- Garantia de Satisfação: Nutrilus garante você e seu pet satisfeitos - saiba mais abaixo nos detalhes.\r\n\r\nDetalhes\r\nA Ração Seca Nutrilus Pro+ Sabor Carne para Gatos Castrados traz nutrição de alta qualidade pelo melhor custo beneficio. Desenvolvido por veterinários a partir de ingredientes selecionados, sem corantes e aromatizantes artificiais, garante uma alimentação balanceada e sabor irresistível. Perfeita para nutrir e alegrar o seu gato! Benefícios: - Intestino saudável; - Reduz o odor das fezes; - Proteínas de alta qualidade; - Pelagem mais macia e brilhante. Nutrilus garante você e seu pet satisfeitos: a nutrição dos cães e gatos e satisfação dos tutores são nossos maiores objetivos. Por isso, oferecemos o programa garantia de satisfação. Para saber mais, entre em contato pelo telefone 3003-5052 ou pelo e-mail contato@nutrilus.com.br, disponível de segunda a sexta das 9h às 17h. Para mais informações acesse: www.nutrilus.com.br.', 0.0, 0, 1, 0, 34, '2024-12-02 22:46:02', '2024-12-03 09:13:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_comentario`
--

CREATE TABLE `tb_produto_comentario` (
  `id` int(11) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `produtoTamanho` int(11) DEFAULT NULL,
  `produtoCor` int(11) DEFAULT NULL,
  `itemvenda` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto_comentario`
--

INSERT INTO `tb_produto_comentario` (`id`, `avaliacao`, `comentario`, `produtoTamanho`, `produtoCor`, `itemvenda`, `produto`, `dateCreate`, `dateModify`) VALUES
(1, 5, '123123', 2, NULL, 23, 2, '2024-11-18 12:30:09', NULL),
(4, 4, 'Produto Bom', 2, NULL, 23, 2, '2024-11-18 15:25:48', NULL),
(5, 5, 'Produto Bom', 2, NULL, 24, 2, '2024-11-18 15:27:35', NULL),
(6, 4, 'Produto Bom', 2, NULL, 23, 2, '2024-11-18 15:36:49', NULL),
(7, 4, 'Produto Bom', 2, NULL, 23, 2, '2024-11-18 15:37:41', NULL),
(8, 4, 'Produto Bom', 2, NULL, 23, 2, '2024-11-18 15:38:04', NULL),
(9, 4, 'Produto Bosta', 2, NULL, 23, 2, '2024-11-18 15:39:49', NULL),
(10, 2, 'Produto Bom', 2, NULL, 23, 2, '2024-11-18 15:40:57', NULL),
(11, 4, 'qweqwe', 2, NULL, 26, 2, '2024-11-25 20:00:42', NULL),
(12, 4, 'poderia ser melhor, chegou 100g a menos que o informado', 2, NULL, 26, 2, '2024-11-25 20:01:52', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_cor`
--

CREATE TABLE `tb_produto_cor` (
  `id` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_estoque`
--

CREATE TABLE `tb_produto_estoque` (
  `id` int(11) NOT NULL,
  `qtdtotal` int(11) NOT NULL DEFAULT 0,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto_estoque`
--

INSERT INTO `tb_produto_estoque` (`id`, `qtdtotal`, `produto`, `dateCreate`, `dateModify`) VALUES
(1, 80, 1, '2024-09-09 19:52:19', '2024-12-01 10:24:01'),
(2, 0, 2, '2024-09-16 11:47:57', '2024-10-02 15:12:33'),
(3, 9962, 5, '2024-09-16 11:47:57', '2024-11-27 20:28:03'),
(4, 9950, 6, '2024-09-16 11:47:57', '2024-12-03 08:03:48'),
(5, 0, 7, '2024-09-16 11:47:57', '2024-09-18 11:29:32'),
(6, 100, 8, '2024-11-14 10:57:53', NULL),
(7, 100, 9, '2024-11-14 10:57:53', '2024-11-27 20:28:03'),
(8, 97, 10, '2024-11-14 10:57:53', '2024-11-27 15:29:34'),
(9, 0, 12, '2024-11-28 16:51:05', '2024-11-28 16:54:59'),
(10, 0, 13, '2024-11-28 16:53:51', '2024-11-28 16:55:03'),
(11, 0, 14, '2024-11-28 16:53:51', '2024-11-28 16:55:08'),
(12, 0, 15, '2024-11-28 17:11:06', NULL),
(13, 0, 16, '2024-11-28 17:11:06', NULL),
(14, 0, 17, '2024-11-28 21:06:02', NULL),
(44, 0, 57, '2024-11-29 22:42:41', NULL),
(45, 0, 58, '2024-11-29 22:56:56', NULL),
(46, 0, 59, '2024-12-01 10:28:33', NULL),
(47, 0, 60, '2024-12-01 10:28:33', NULL),
(48, 0, 61, '2024-12-02 22:46:02', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_imagem`
--

CREATE TABLE `tb_produto_imagem` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto_imagem`
--

INSERT INTO `tb_produto_imagem` (`id`, `imagem`, `produto`, `dateCreate`, `dateModify`) VALUES
(1, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_1.jpg', 1, '2024-09-02 20:06:35', '2024-09-10 14:00:23'),
(2, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_2.jpg', 1, '2024-09-02 20:06:35', '2024-09-10 14:00:28'),
(3, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_3.jpg', 1, '2024-09-02 20:07:43', '2024-09-10 14:00:31'),
(4, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_4.jpg', 1, '2024-09-02 20:07:43', '2024-09-10 14:00:33'),
(5, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_5.jpg', 1, '2024-09-02 20:07:43', '2024-09-10 14:00:37'),
(6, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_6.jpg', 1, '2024-09-02 20:07:43', '2024-09-10 14:00:40'),
(7, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_7.jpg', 1, '2024-09-02 20:07:43', '2024-09-10 14:00:43'),
(8, '1_Ração_Whiskas_Carne_para_Gatos_Adultos_Castrados_8.jpg', 1, '2024-09-02 20:07:43', '2024-09-10 14:01:08'),
(10, '2_Ração_Seca_PremieR_Pet_Golden_Gatos_Filhotes_Frango_2.jpg', 2, '2024-09-16 11:08:22', NULL),
(11, '2_Ração_Seca_PremieR_Pet_Golden_Gatos_Filhotes_Frango_3.webp', 2, '2024-09-16 11:08:22', '2024-12-03 00:54:46'),
(12, '2_Ração_Seca_PremieR_Pet_Golden_Gatos_Filhotes_Frango_4.jpg', 2, '2024-09-16 11:08:22', NULL),
(13, '2_Ração_Seca_PremieR_Pet_Golden_Gatos_Filhotes_Frango_5.webp', 2, '2024-09-16 11:08:22', '2024-12-03 00:54:54'),
(14, '3_Shampoo_Pet_Society_Hydra_Groomers_Pelos_Escuros_para_Cães_e_Gatos_1.webp', 3, '2024-11-05 18:59:23', '2024-12-03 00:54:58'),
(15, '4_Brinquedo_Chalesco_Pelúcia_Macaco_1.jpg', 4, '2024-11-05 19:25:50', '2024-11-05 19:27:44'),
(16, '4_Brinquedo_Chalesco_Pelúcia_Macaco_2.jpg', 4, '2024-11-05 19:25:50', '2024-11-05 19:28:04'),
(17, '4_Brinquedo_Chalesco_Pelúcia_Macaco_3.jpg', 4, '2024-11-05 19:26:52', '2024-11-05 19:28:07'),
(18, '4_Brinquedo_Chalesco_Pelúcia_Macaco_4.webp', 4, '2024-11-05 19:26:52', '2024-11-05 19:28:31'),
(19, '4_Brinquedo_Chalesco_Pelúcia_Macaco_5.webp', 4, '2024-11-05 19:26:52', '2024-11-05 19:28:42'),
(20, '4_Brinquedo_Chalesco_Pelúcia_Macaco_6.webp', 4, '2024-11-05 19:26:52', '2024-11-05 19:28:44'),
(21, '9_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_1.jpg', 9, '2024-11-28 17:17:25', NULL),
(22, '9_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_1.jpg', 9, '2024-11-28 17:18:55', NULL),
(23, '9_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_1.jpg', 9, '2024-11-28 17:19:09', NULL),
(37, '11_Catnip_Chalesco_Erva_de_Gato_1.jpg', 11, '2024-11-29 22:56:56', NULL),
(38, '12_Matheus_Vieira_Rodrigues_1.jpg', 12, '2024-12-01 10:28:33', NULL),
(39, '12_Matheus_Vieira_Rodrigues_2.jpg', 12, '2024-12-01 10:28:33', NULL),
(40, '12_Matheus_Vieira_Rodrigues_3.jpg', 12, '2024-12-01 10:28:33', NULL),
(41, '13_Ração_Seca_Nutrilus_Pro+_Carne_para_Gatos_Adultos_Castrados_1.jpg', 13, '2024-12-02 22:46:02', NULL),
(42, '13_Ração_Seca_Nutrilus_Pro+_Carne_para_Gatos_Adultos_Castrados_2.jpg', 13, '2024-12-02 22:46:02', NULL),
(43, '13_Ração_Seca_Nutrilus_Pro+_Carne_para_Gatos_Adultos_Castrados_3.webp', 13, '2024-12-02 22:46:02', NULL),
(44, '13_Ração_Seca_Nutrilus_Pro+_Carne_para_Gatos_Adultos_Castrados_4.webp', 13, '2024-12-02 22:46:02', NULL),
(45, '13_Ração_Seca_Nutrilus_Pro+_Carne_para_Gatos_Adultos_Castrados_5.jpg', 13, '2024-12-02 22:46:02', NULL),
(46, '13_Ração_Seca_Nutrilus_Pro+_Carne_para_Gatos_Adultos_Castrados_6.webp', 13, '2024-12-02 22:46:02', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_tamanho`
--

CREATE TABLE `tb_produto_tamanho` (
  `id` int(11) NOT NULL,
  `tamanho` varchar(50) NOT NULL DEFAULT 'único',
  `preco` decimal(9,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto_tamanho`
--

INSERT INTO `tb_produto_tamanho` (`id`, `tamanho`, `preco`, `ativo`, `produto`, `dateCreate`, `dateModify`) VALUES
(1, '10kg', 179.90, 1, 1, '2024-09-10 19:11:25', '2024-09-13 08:18:12'),
(2, '2,7kg', 49.00, 1, 1, '2024-09-10 19:11:25', '2024-09-17 10:38:51'),
(5, '1kg', 25.00, 1, 2, '2024-09-16 10:58:39', NULL),
(6, '3kg', 59.00, 1, 2, '2024-09-16 10:58:39', NULL),
(7, '10kg', 152.00, 1, 2, '2024-09-16 10:58:39', NULL),
(8, '1L', 105.90, 1, 3, '2024-11-05 19:01:52', NULL),
(9, '200ml', 28.89, 1, 3, '2024-11-05 19:01:52', NULL),
(10, 'único', 20.79, 1, 4, '2024-11-05 19:06:34', '2024-11-05 19:07:07'),
(12, '1kg', 27.00, 0, 7, '2024-11-28 16:51:05', '2024-11-28 19:09:43'),
(13, '1kg', 27.75, 0, 8, '2024-11-28 16:53:51', '2024-11-28 19:10:06'),
(14, '300g', 10.00, 0, 8, '2024-11-28 16:53:51', '2024-11-28 19:10:06'),
(15, '20kg', 155.18, 1, 9, '2024-11-28 17:11:06', NULL),
(16, '15kg', 137.00, 1, 9, '2024-11-28 17:11:06', NULL),
(17, '1kg', 27.75, 0, 10, '2024-11-28 21:06:02', '2024-11-28 21:09:24'),
(57, '15kg', 202.00, 1, 2, '2024-11-29 22:42:41', NULL),
(58, '10g', 19.90, 1, 11, '2024-11-29 22:56:56', NULL),
(59, '10ml', 52.60, 0, 12, '2024-12-01 10:28:33', '2024-12-03 08:56:20'),
(60, '25ml', 101.30, 0, 12, '2024-12-01 10:28:33', '2024-12-03 08:56:20'),
(61, '10kg', 133.51, 0, 13, '2024-12-02 22:46:02', '2024-12-03 09:13:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `sub` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `email`, `senha`, `sub`, `token`, `expiry`, `dateCreate`, `dateModify`) VALUES
(1, 'xistopet@gmail.com', NULL, '109395935496376993579', NULL, NULL, '2024-09-02 19:49:31', NULL),
(43, 'matheusvieiramv07@gmail.com', '$2y$10$WmE8RLY.Sa2GZ1oH7ofjOeLRHV.dpevGbZWnjoytVH2qV8ky9ecZe', NULL, NULL, NULL, '2024-12-02 23:18:12', NULL),
(44, 'matheus.v.rodrigues276@gmail.com', NULL, '105998796673909099881', NULL, NULL, '2024-12-03 08:55:12', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_venda`
--

CREATE TABLE `tb_venda` (
  `id` int(11) NOT NULL,
  `valorTotal` decimal(9,2) DEFAULT NULL,
  `cliente` int(11) NOT NULL,
  `metodo` int(11) DEFAULT NULL,
  `cartao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `endereco` int(11) DEFAULT NULL,
  `dateVenda` date DEFAULT NULL,
  `dateEntrega` date DEFAULT NULL,
  `dateModify` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_venda`
--

INSERT INTO `tb_venda` (`id`, `valorTotal`, `cliente`, `metodo`, `cartao`, `status`, `endereco`, `dateVenda`, `dateEntrega`, `dateModify`) VALUES
(56, 177.00, 21, 3, 7, 3, 17, '2024-12-03', NULL, NULL),
(57, NULL, 21, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(58, NULL, 22, NULL, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_venda_item`
--

CREATE TABLE `tb_venda_item` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `subTotal` decimal(9,2) NOT NULL,
  `avaliar` tinyint(1) NOT NULL DEFAULT 0,
  `venda` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_venda_item`
--

INSERT INTO `tb_venda_item` (`id`, `quantidade`, `subTotal`, `avaliar`, `venda`, `produto`, `dateCreate`, `dateModify`) VALUES
(52, 3, 177.00, 0, 56, 6, '2024-12-03 07:51:29', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_venda_status`
--

CREATE TABLE `tb_venda_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_venda_status`
--

INSERT INTO `tb_venda_status` (`id`, `status`, `dateCreate`, `dateModify`) VALUES
(1, 'Aberto', '2024-09-17 14:22:50', '2024-11-12 20:09:42'),
(2, 'Aguardando pagamento', '2024-11-27 15:23:14', '2024-11-27 19:36:39'),
(3, 'Em preparo', '2024-09-17 14:22:50', '2024-11-27 19:00:01'),
(4, 'A caminho', '2024-09-17 14:22:50', '2024-11-27 19:36:35'),
(5, 'Entregue', '2024-11-12 20:10:29', '2024-11-27 15:23:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_administrador`
--
ALTER TABLE `tb_administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `nivel` (`nivel`);

--
-- Índices de tabela `tb_administrador_nivel`
--
ALTER TABLE `tb_administrador_nivel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_cartao`
--
ALTER TABLE `tb_cliente_cartao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_favorito`
--
ALTER TABLE `tb_cliente_favorito`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_notificacao`
--
ALTER TABLE `tb_cliente_notificacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_notificacao_tipo`
--
ALTER TABLE `tb_cliente_notificacao_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_telefone`
--
ALTER TABLE `tb_cliente_telefone`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_metodo_pagamento`
--
ALTER TABLE `tb_metodo_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_produto_comentario`
--
ALTER TABLE `tb_produto_comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtoTamanho` (`produtoTamanho`),
  ADD KEY `produtoCor` (`produtoCor`),
  ADD KEY `produto` (`produto`);

--
-- Índices de tabela `tb_produto_cor`
--
ALTER TABLE `tb_produto_cor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto` (`produto`);

--
-- Índices de tabela `tb_produto_estoque`
--
ALTER TABLE `tb_produto_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_produto_estoque_ibfk_1` (`produto`);

--
-- Índices de tabela `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto` (`produto`);

--
-- Índices de tabela `tb_produto_tamanho`
--
ALTER TABLE `tb_produto_tamanho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto` (`produto`);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `status` (`status`),
  ADD KEY `metodo` (`metodo`),
  ADD KEY `endereco` (`endereco`),
  ADD KEY `cartao` (`cartao`);

--
-- Índices de tabela `tb_venda_item`
--
ALTER TABLE `tb_venda_item`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_venda_status`
--
ALTER TABLE `tb_venda_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_administrador`
--
ALTER TABLE `tb_administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_administrador_nivel`
--
ALTER TABLE `tb_administrador_nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tb_cliente_cartao`
--
ALTER TABLE `tb_cliente_cartao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tb_cliente_favorito`
--
ALTER TABLE `tb_cliente_favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `tb_cliente_notificacao`
--
ALTER TABLE `tb_cliente_notificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_cliente_notificacao_tipo`
--
ALTER TABLE `tb_cliente_notificacao_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_cliente_telefone`
--
ALTER TABLE `tb_cliente_telefone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_metodo_pagamento`
--
ALTER TABLE `tb_metodo_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_produto_comentario`
--
ALTER TABLE `tb_produto_comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_produto_cor`
--
ALTER TABLE `tb_produto_cor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_produto_estoque`
--
ALTER TABLE `tb_produto_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `tb_produto_tamanho`
--
ALTER TABLE `tb_produto_tamanho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `tb_venda_item`
--
ALTER TABLE `tb_venda_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `tb_venda_status`
--
ALTER TABLE `tb_venda_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_administrador`
--
ALTER TABLE `tb_administrador`
  ADD CONSTRAINT `tb_administrador_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuario` (`id`),
  ADD CONSTRAINT `tb_administrador_ibfk_2` FOREIGN KEY (`nivel`) REFERENCES `tb_administrador_nivel` (`id`);

--
-- Restrições para tabelas `tb_produto_comentario`
--
ALTER TABLE `tb_produto_comentario`
  ADD CONSTRAINT `tb_produto_comentario_ibfk_1` FOREIGN KEY (`produtoTamanho`) REFERENCES `tb_produto_tamanho` (`id`),
  ADD CONSTRAINT `tb_produto_comentario_ibfk_2` FOREIGN KEY (`produtoCor`) REFERENCES `tb_produto_cor` (`id`),
  ADD CONSTRAINT `tb_produto_comentario_ibfk_3` FOREIGN KEY (`produto`) REFERENCES `tb_produto` (`id`);

--
-- Restrições para tabelas `tb_produto_cor`
--
ALTER TABLE `tb_produto_cor`
  ADD CONSTRAINT `tb_produto_cor_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `tb_produto` (`id`);

--
-- Restrições para tabelas `tb_produto_estoque`
--
ALTER TABLE `tb_produto_estoque`
  ADD CONSTRAINT `tb_produto_estoque_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `tb_produto_tamanho` (`id`);

--
-- Restrições para tabelas `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  ADD CONSTRAINT `tb_produto_imagem_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `tb_produto` (`id`);

--
-- Restrições para tabelas `tb_produto_tamanho`
--
ALTER TABLE `tb_produto_tamanho`
  ADD CONSTRAINT `tb_produto_tamanho_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `tb_produto` (`id`);

--
-- Restrições para tabelas `tb_venda`
--
ALTER TABLE `tb_venda`
  ADD CONSTRAINT `tb_venda_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `tb_cliente` (`id`),
  ADD CONSTRAINT `tb_venda_ibfk_2` FOREIGN KEY (`status`) REFERENCES `tb_venda_status` (`id`),
  ADD CONSTRAINT `tb_venda_ibfk_3` FOREIGN KEY (`metodo`) REFERENCES `tb_metodo_pagamento` (`id`),
  ADD CONSTRAINT `tb_venda_ibfk_4` FOREIGN KEY (`endereco`) REFERENCES `tb_cliente_endereco` (`id`),
  ADD CONSTRAINT `tb_venda_ibfk_5` FOREIGN KEY (`cartao`) REFERENCES `tb_cliente_cartao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
