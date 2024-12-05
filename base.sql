-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/12/2024 às 02:33
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
(1, 0x505958b6f8f20bb3e5cabf6c0567e94c, 0x1666c19eab0cdab1aa2d6fb966ca660d, 0x4441125f1c1c69e9737f258fcf757b13, 1, 3, '2024-12-03 21:10:50', NULL);

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
(1, 'Ração de gato', 1, '1_Ração_de_gato.jpg', '2024-12-04 22:24:31', '2024-12-04 22:24:31'),
(2, 'Ração de cachorro', 1, '2_Ração_de_cachorro.jpg', '2024-12-04 22:25:09', '2024-12-04 22:25:09'),
(3, 'Brinquedo de gato', 1, '3_Brinquedo_de_gato.jpg', '2024-12-04 22:25:22', '2024-12-04 22:25:22'),
(4, 'Brinquedo de cachorro', 1, '4_Brinquedo_de_cachorro.jpg', '2024-12-04 22:25:34', '2024-12-04 22:25:34'),
(5, 'Medicamento', 1, '5_Medicamento.jpg', '2024-12-04 22:25:49', '2024-12-04 22:25:49');

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
-- Estrutura para tabela `tb_fornecedor`
--

CREATE TABLE `tb_fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varbinary(300) NOT NULL,
  `cnpj` varbinary(28) NOT NULL,
  `telefone` varbinary(28) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_fornecedor`
--

INSERT INTO `tb_fornecedor` (`id`, `nome`, `cnpj`, `telefone`, `ativo`, `dateCreate`, `dateModify`) VALUES
(1, 0x1cc40c739e136e8f39d3df32eef99c2f, 0xa150e20f0a18e3cb85e164c1adfd2103, 0xd00fbce7bea0d6afa68d882619f56563, 1, '2024-12-04 22:22:24', NULL),
(2, 0xe9ff831b8e6d8d32161b3336c75cdc74, 0x42b0fd0066843b7bbb287ac869a87d18, 0x0d0769cc9abf2af348c385500cd2324d, 1, '2024-12-04 22:23:58', NULL);

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

--
-- Despejando dados para a tabela `tb_fornecedor_fornecimento`
--

INSERT INTO `tb_fornecedor_fornecimento` (`id`, `quantidade`, `fornecedor`, `estoque`, `dateCreate`, `dateModify`) VALUES
(1, 100, 1, 1, '2024-12-04 22:33:57', NULL),
(2, 100, 1, 2, '2024-12-04 22:33:57', NULL),
(3, 100, 1, 3, '2024-12-04 22:35:10', NULL),
(4, 100, 1, 4, '2024-12-04 22:38:29', NULL),
(5, 100, 1, 5, '2024-12-04 22:43:03', NULL),
(6, 100, 1, 6, '2024-12-04 22:44:19', NULL),
(7, 100, 1, 7, '2024-12-04 22:46:58', NULL),
(8, 100, 1, 8, '2024-12-04 22:48:07', NULL),
(9, 111, 1, 9, '2024-12-04 22:49:08', NULL),
(10, 100, 1, 10, '2024-12-04 22:57:03', NULL),
(11, 100, 1, 11, '2024-12-04 22:57:03', NULL),
(12, 111, 1, 12, '2024-12-04 23:00:42', NULL),
(13, 111, 1, 13, '2024-12-04 23:03:34', NULL),
(14, 111, 1, 14, '2024-12-04 23:03:34', NULL),
(15, 111, 1, 15, '2024-12-04 23:03:34', NULL),
(16, 111, 1, 16, '2024-12-04 23:08:32', NULL),
(17, 111, 1, 17, '2024-12-04 23:08:32', NULL),
(18, 111, 1, 18, '2024-12-04 23:08:32', NULL),
(19, 111, 1, 19, '2024-12-04 23:13:01', NULL),
(20, 111, 1, 20, '2024-12-04 23:13:01', NULL),
(21, 111, 1, 21, '2024-12-04 23:13:01', NULL),
(22, 111, 1, 22, '2024-12-04 23:15:09', NULL),
(23, 111, 1, 23, '2024-12-04 23:15:09', NULL),
(24, 111, 1, 24, '2024-12-04 23:15:09', NULL),
(25, 111, 1, 25, '2024-12-04 23:16:54', NULL),
(26, 233, 2, 26, '2024-12-04 23:19:25', NULL),
(27, 324, 2, 27, '2024-12-04 23:19:25', NULL),
(28, 432, 2, 28, '2024-12-04 23:19:25', NULL),
(29, 231, 1, 29, '2024-12-04 23:21:22', NULL),
(30, 21, 1, 30, '2024-12-04 23:21:22', NULL),
(31, 231, 1, 31, '2024-12-04 23:21:22', NULL),
(32, 321, 1, 32, '2024-12-04 23:23:05', NULL),
(33, 321, 1, 33, '2024-12-04 23:23:06', NULL),
(34, 231, 1, 34, '2024-12-04 23:23:06', NULL),
(35, 123, 1, 35, '2024-12-04 23:24:54', NULL),
(36, 321, 1, 36, '2024-12-04 23:24:54', NULL),
(37, 123, 1, 37, '2024-12-04 23:24:54', NULL),
(38, 123, 1, 38, '2024-12-04 23:26:40', NULL),
(39, 321, 1, 39, '2024-12-04 23:26:40', NULL),
(40, 123, 1, 40, '2024-12-04 23:26:40', NULL),
(41, 212, 1, 41, '2024-12-04 23:27:55', NULL),
(42, 212, 1, 42, '2024-12-04 23:27:55', NULL),
(43, 123, 1, 43, '2024-12-04 23:29:13', NULL),
(44, 123, 1, 44, '2024-12-04 23:29:13', NULL),
(45, 123, 1, 45, '2024-12-04 23:30:37', NULL),
(46, 123, 1, 46, '2024-12-04 23:30:37', NULL);

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
  `categoria` int(11) DEFAULT NULL,
  `dateCreate` datetime DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto`
--

INSERT INTO `tb_produto` (`id`, `nome`, `descricao`, `avaliacao`, `cor`, `tamanho`, `ativo`, `categoria`, `dateCreate`, `dateModify`) VALUES
(1, 'Ração Seca Nutrilus Pro+ Frango & Carne para Cães Adultos de Raças Médias e Grandes Tamanhos', 'Resumo\r\n- Sem corantes e aromas artificiais;\r\n- Contém taurina, que ajuda na circulação sanguínea;\r\n- Com Zinco e Ômega 6 para pele sadia e pelo brilhante;\r\n- Feito com frango e fibras naturais para digestão equilibrada;\r\n- Alimento High Premium com excelente absorção de nutrientes;\r\n- Com balanço de minerais que ajudam na saúde do trato urinário;\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nDetalhes\r\nA Ração Optimum Sachê Frango para Gatos Adultos Castrados é completa pois possui todos os nutrientes que o gato precisa. Funcional pois garante parte do consumo de água diário, essencial para a saúde do animal. O que o gato consome em cada etapa de vida tem resultado direto em seu crescimento, força e bem-estar. Por isso OPTIMUM™ sachê foi desenvolvido usando as melhores matérias-primas, proteínas cuidadosamente selecionadas e nutrientes essenciais. Experimente misturar sachê com alimento seco. Pesquisas indicam que misturar alimentos úmidos e secos traz inúmeros benefícios à saúde do felino.\r\n100% Satisfação Garantida ou seu dinheiro de volta. Os produtos OPTIMUM™ foram desenvolvidos seguindo as recomendações de WALTHAM – a maior autoridade mundial em nutrição, cuidado e bem-estar animal. Saiba mais em www.waltham.com\r\n\r\nSAC MARS BRASIL - Serviço de Atendimento ao Consumidor - DDG 0800-702-0090/ Caixa postal 61, CEP 08900-970 - Guararema - SP/ sac.brasil@mars.com.br - www.optimumpet.com.br', 0.0, 0, 1, 1, 2, '2024-12-04 22:33:46', '2024-12-04 22:57:48'),
(2, 'Ração Úmida Optimum Sachê para Gatos Adultos Castrados Frango Tamanhos', 'Resumo\r\n- Sem corantes e aromas artificiais;\r\n- Contém taurina, que ajuda na circulação sanguínea;\r\n- Com Zinco e Ômega 6 para pele sadia e pelo brilhante;\r\n- Feito com frango e fibras naturais para digestão equilibrada;\r\n- Alimento High Premium com excelente absorção de nutrientes;\r\n- Com balanço de minerais que ajudam na saúde do trato urinário;\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\n\r\nDetalhes\r\nA Ração Optimum Sachê Frango para Gatos Adultos Castrados é completa pois possui todos os nutrientes que o gato precisa. Funcional pois garante parte do consumo de água diário, essencial para a saúde do animal. O que o gato consome em cada etapa de vida tem resultado direto em seu crescimento, força e bem-estar. Por isso OPTIMUM™ sachê foi desenvolvido usando as melhores matérias-primas, proteínas cuidadosamente selecionadas e nutrientes essenciais. Experimente misturar sachê com alimento seco. Pesquisas indicam que misturar alimentos úmidos e secos traz inúmeros benefícios à saúde do felino.\r\n100% Satisfação Garantida ou seu dinheiro de volta. Os produtos OPTIMUM™ foram desenvolvidos seguindo as recomendações de WALTHAM – a maior autoridade mundial em nutrição, cuidado e bem-estar animal. Saiba mais em www.waltham.com\r\n\r\nSAC MARS BRASIL - Serviço de Atendimento ao Consumidor - DDG 0800-702-0090/ Caixa postal 61, CEP 08900-970 - Guararema - SP/ sac.brasil@mars.com.br - www.optimumpet.com.br', 0.0, 0, 1, 1, 1, '2024-12-04 22:34:59', '2024-12-04 22:58:18'),
(3, 'Ração Úmida Origens Frango e Carne para Gatos Castrados Tamanhos', 'Resumo\r\n- Sem corantes e aromatizantes artificiais;\r\n- Benefícios para pele e pelagem;\r\n- Equilíbrio do trato urinário;\r\n- Calorias moderadas.\r\n\r\nDetalhes\r\nA Ração Úmida Origens Frango e Carne para Gatos Castrados é a escolha ideal para tutores que buscam oferecer uma alimentação completa e balanceada. Desenvolvida com cuidado e expertise para atender às necessidades específicas após a castração, proporcionando uma dieta equilibrada e nutritiva. Elaborada com ingredientes criteriosamente selecionados, como carnes frescas e vegetais de alta qualidade, esta opção oferece um sabor irresistível que os bichanos adoram. Além disso, a presença de nutrientes essenciais garante um ótimo aproveitamento dos alimentos, contribuindo para a saúde e o bem-estar. Cada sachê é cuidadosamente preparado para garantir a frescura e a segurança alimentar, proporcionando uma experiência gastronômica de alto nível.', 0.0, 0, 1, 1, 1, '2024-12-04 22:38:11', '2024-12-04 22:58:26'),
(4, 'Ração Úmida Guabi Natural Grain Free Frango, Salmão e Vegetais para Gatos Tamanhos', 'Resumo\r\n- Indicada para gatos de todos os portes e de todas as idades, castrados ou não;\r\n- Livre de adição de cloreto de sódio (sal comum);\r\n- Possui baixa caloria e ingredientes naturais, além de conter odor agradável;\r\n- Sem transgênicos, grãos, corantes e aromatizantes artificiais.\r\n\r\n\r\nDetalhes\r\nA Ração Úmida Guabi Natural Grain Free Frango, Salmão e Vegetais para Gatos é um alimento natural e altamente palatável para agradar o paladar do seu amigão. Feita com brócolis, uma fonte de proteínas, fibras alimentares e minerais, como por exemplo: cálcio e ferro. Contém frango e salmão, responsáveis por fornecedor proteína de elevada absorção e sabor. Composta com abóbora que conta com vitaminas e carboidratos, como por exemplo: vitaminas do complexo B e betacaroteno. Uma ração deliciosa e elaborada com carinho, para saciar a fome do seu amiguinho.', 0.0, 0, 1, 1, 1, '2024-12-04 22:42:55', NULL),
(5, 'Ração Úmida Everest Gourmet Tilápia com Batata Doce e Quinoa para Gatos Tamanhos', 'Resumo\r\n- Tilápia de alta qualidade fornece proteínas leves e nutritivas para a saúde muscular;\r\n- Batata doce oferece carboidratos de liberação lenta para energia duradoura;\r\n- Quinoa rica em aminoácidos e vitaminas essenciais para uma dieta balanceada;\r\n- Sabor gourmet que agrada gatos e apoia a digestão saudável e pelagem brilhante.\r\n\r\n\r\nDetalhes\r\nA Ração Úmida Everest Gourmet Tilápia com Batata Doce e Quinoa para Gatos é uma escolha premium para gatos exigentes. Com tilápia de alta qualidade como ingrediente principal, oferece proteínas leves e nutritivas para apoiar a saúde muscular e o bem-estar geral. A batata doce fornece carboidratos de liberação lenta, ajudando a manter a energia constante, enquanto a quinoa é rica em aminoácidos e vitaminas essenciais para uma dieta equilibrada. Esta combinação saborosa e nutritiva é ideal para gatos que merecem uma refeição gourmet, promovendo uma digestão saudável e um pelagem brilhante.', 0.0, 0, 1, 1, 1, '2024-12-04 22:44:06', NULL),
(6, 'Ração Nestlé Purina Friskies Sachê Salmão ao Molho para Gatos Tamanhos', 'Resumo\r\n- Alimento úmido completo e balanceado;\r\n- Destinado a gatos adultos;\r\n- Pronto para consumo.\r\n- Pedaços macios\r\n\r\nDetalhes\r\nA Ração Nestlé Purina Friskies Sachê Salmão ao Molho para Gatos é um alimento úmido completo e balanceado destinado a gatos adultos. Produto pronto para o consumo.Conservar o produto em local seco e fresco. Depois de aberto, manter sob refrigeração e consumir em até 48h. Não congelar.\r\n', 0.0, 0, 1, 1, 1, '2024-12-04 22:46:50', NULL),
(7, 'Ração Úmida GranPlus Sachê Atum para Gatos Adultos Tamanhos', 'Resumo\r\n- Auxilia na saúde intestinal;\r\n- Não contém conservantes;\r\n- Alta absorção de nutrientes;\r\n- Não possui corantes e aromas artificiais.\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nDetalhes\r\nA Ração Úmida GranPlus Sachê Atum para Gatos Adultos é uma alimentação úmida e balanceada que fornece proteínas de alta qualidade e facilitam a digestibilidade do seu amiguinho, além de contribuir para a saúde intestinal.\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do telefone 0800 016 9090. Para mais informações acesse: https://granplus.com.br/100-satisfacao/', 0.0, 0, 1, 1, 1, '2024-12-04 22:47:59', NULL),
(8, 'Ração Úmida Special Cat Patê Carne para Gatos Castrados Tamanhos', 'Resumo\r\n- Sabor: Carne e batata-doce;\r\n- Não contém corantes artificiais;\r\n- Com batata-doce;\r\n- Com L-Carnitina para controle do ganho de peso.\r\n\r\nDetalhes\r\nA Ração Úmida Special Cat Patê Carne para Gatos Castrados é um alimento completo e balanceado, desenvolvido com ingredientes selecionados contribuindo para uma alimentação saudável e equilibrada. Contém L-carnitina que auxilia para o controle do peso ideal, além da combinação de minerais + água contribuindo para a saúde do trato urinário.', 0.0, 0, 1, 1, 1, '2024-12-04 22:49:04', NULL),
(9, 'Ração Seca PremieR Pet Golden Salmão para Gatos Adultos Castrados Tamanhos', 'Resumo\r\n- Sabor inigualável: promove máxima satisfação para paladares exigentes;\r\n- Trato urinário saudável: minerais balanceados e controle do pH urinário;\r\n- Intestino saudável: combinação de ingredientes de alta digestibilidade e prebióticos;\r\n- Redução do odor das fezes: seleção de ingredientes especiais que auxiliam na redução do odor das fezes.\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nDetalhes\r\nProcedimento cada vez mais recomendado pelos médicos veterinários, a castração promove inúmeros benefícios, mas também alterações fisiológicas que exigem alguns cuidados extras com a dieta do seu gato. Especialmente formulada para atender às necessidades dos gatos castrados, a Ração Seca PremieR Pet Golden Salmão para Gatos Adultos Castrados auxilia na prevenção da obesidade e no cuidado com o trato urinário, garantindo uma nutrição ótima e saudável.\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do PremieR Responde – Telefone 0800 055 66 66. Para mais informações acesse: https://www.premierpet.com.br/garantia-premierpet/', 0.0, 0, 1, 1, 1, '2024-12-04 22:56:55', NULL),
(10, 'Ração Royal Canin Sterilised para Gatos Adultos Castrados Tamanhos', 'Resumo\r\n- Ração super premium indicada para gatos adultos castrados de 1 a 10 anos;\r\n- Limita o ganho de peso do bichano: teores moderados de gordura e energia;\r\n- Ajuda no controle e manutenção da saúde do sistema urinário do gato castrado;\r\n- Contém elevado teor de proteínas de alta qualidade que auxiliam na manutenção da massa muscular do gato castrado;\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nCod: 2548708\r\nDetalhes\r\nA Ração Royal Canin Sterilised para Gatos Adultos Castrados é completa super premium indicada para gatos castrados, de 1 a 7 anos de idade. Contém um nível moderado de gordura quando servido em porções diárias adequadas – isto ajuda a manter um peso corporal ideal depois de ter sido castrado. Além disso, também contém um equilíbrio de sais minerais cuidadosamente pensado que ajuda a suportar e manter saudável o sistema urinário , ao mesmo tempo que o aumento do teor proteico deste alimento ajuda a manter a massa muscular saudável.\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do telefone 0800 703 5588. Para mais informações acesse: https://www.royalcanin.com/br/about-us/politica-de-satisfacao-garantida\r\n\r\n', 0.0, 0, 1, 1, 1, '2024-12-04 23:00:36', NULL),
(11, 'Ração Seca PremieR Pet Golden Gatos Adultos Carne Tamanhos', 'Resumo\r\n- Sabor inigualável: máxima satisfação para o paladar;\r\n- Trato urinário saudável: minerais balanceados e controle do pH urinário;\r\n- Intestino saudável: combinação de ingredientes de alta digestibilidade e prebióticos;\r\n- Redução do odor das fezes: seleção de ingredientes especiais que auxiliam na redução do odor das fezes.\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nCod: 310001-3\r\nDetalhes\r\nIndependentes, elegantes e exigentes, gatos são seres únicos que possuem particularidades fascinantes. Desde a forma como interagem com seu dono até seus hábitos durante a alimentação, todas as suas preferências devem ser percebidas e respeitadas. Entre suas peculiaridades nutricionais, está a maior exigência quanto ao sabor do alimento. Pensando nisso a Ração Seca PremieR Pet Golden Gatos Adultos Carne foi especialmente desenvolvido para agradar o paladar dos gatos, além de atender a todas as necessidades nutricionais para uma vida longa e saudável.\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do PremieR Responde – Telefone 0800 055 66 66. Para mais informações acesse: https://www.premierpet.com.br/garantia-premierpet/', 0.0, 0, 1, 1, 1, '2024-12-04 23:03:28', NULL),
(12, 'Ração Seca Origens Carne Gatos Adultos Tamanhos', 'Resumo\r\n- Sem corantes e aromatizantes artificiais, cuida do bem-estar do seu felino;\r\n- Composta por vitaminas e ômegas 3 e 6, com equilíbrio do pH urinário;\r\n- Probióticos e fibras oferece equilíbrio da flora intestinal e pelos mais brilhantes;\r\n- Textura, tamanho e formato dos grãos adequados para gatos adultos;\r\n- Embalagem com sistema de fechamento em velcro para facilitar no manuseio diário.\r\n\r\nCod: 2312008\r\nDetalhes\r\nApós a fase filhote, a alimentação do seu pet precisa mudar, com isso a Ração Seca Origens Premium Especial Carne Gatos Adultos é um alimento dedicado para esta etapa da vida, uma manutenção diária de alta qualidade e com ingredientes que atendem a necessidade do seu felino como carne e vitaminas, que ajudam a manter os pelos do seu gatinho mais brilhantes e sedoso.', 0.0, 0, 1, 1, 1, '2024-12-04 23:08:25', NULL),
(13, 'Ração Royal Canin Medium Adult para Cães Adultos de Raças Médias a partir de 12 Meses de Idade', 'Resumo\r\n- Defesas Naturais: Ajuda a reforçar as defesas naturais, combatendo o envelhecimento natural do cão graças a um complexo patenteado de antioxidantes.\r\n- Peso ótimo: Contribui para manter o peso ideal graças a um teor de energia adaptado.\r\n- Alta digestibilidade: Proporciona uma ótima digestão graças a sua formulação exclusiva com proteínas de altíssima qualidade e aporte equilibrado de fibras.\r\n- Palatabilidade reforçada: Satisfaz os apetites exigentes graças à sua formulação e uma seleção de aromas exclusivos.\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nCod: 3105503-2\r\nDetalhes\r\nA Ração Royal Canin Medium Adult para Cães Adultos de Raças Médias a partir de 12 Meses de Idade é completa super premium indicada para cães adultos de médio porte, a partir do 10 meses de idade. Formulada tendo em conta as necessidades nutricionais adulto de médio porte. Contribui para a saúde do sistema digestivo e ajuda a manter uma flora intestinal saudável e equilibrada. Graças a um complexo de antioxidantes específico e à adição de prebióticos, ajuda a reforçar e a manter as defesas naturais . Foi enriquecido com ácidos graxos ómega-3, para ajudar a manter a saúde da pele e da pelagem.\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do telefone 0800 703 5588. Para mais informações acesse: http://www.royalcanin.com.br/royal-canin/sobre-a-royal-canin/compromisso-publico-royal-canin', 0.0, 0, 1, 1, 2, '2024-12-04 23:12:54', NULL),
(14, 'Ração Seca Nestlé Purina Alpo Carne, Frango, Cereais e Vegetais para Cães Adultos', 'Resumo\r\n- Sem adição de corantes e sabores artificiais, com probiótico natural;\r\n- Possui 5 fontes de proteína: Soja, Milho, Carne, Frango e Leite;\r\n- 15 benefícios para a saúde, como músculos e ossos mais fortes;\r\n- Com 40% de proteína de fonte animal e 60% de proteína vegetal;\r\n- Possui ômega 3 e 6, que mantém uma pele e pelagem mais saudável;\r\n- Ajuda a manter a saúde oral em dia além de reduzir a ação de tártaros;\r\n- Alimento com ingredientes 100% completo e balanceado, indicado para cães adultos.\r\n\r\nCod: 31014615-4\r\nDetalhes\r\nA Ração Seca Nestlé Purina Alpo Carne, Frango, Cereais e Vegetais para Cães Adultos é formulada com nutrientes e ingredientes de alta qualidade que contribui para a saúde e vitalidade do seu cão. Ela ajuda a equilibrar a flora intestinal e manter uma alimentação mais balanceada e saudável, cuidando do bem-estar do seu melhor amigo a cada refeição.\r\n\r\n', 0.0, 0, 1, 1, 2, '2024-12-04 23:15:00', NULL),
(15, 'Ração Úmida Pet Delícia Natural Panelinha de Carne', 'Resumo\r\n- Sódio controlado;\r\n- Não contém carnes mecanicamente separada, altamente palatável e digestível;\r\n- Enriquecida com fibras, prebióticos e beta-glucanos;\r\n- Livre de conservantes, corantes, transgênicos, sabores artificiais, e subprodutos;\r\n- Rica em ômegas 3 e 6, proporcionando uma pele saudável e pelos com brilho;\r\n- Método de cozimento delicado para conservar os nutrientes naturais;\r\n- Desenvolvida por especialistas e atende as recomendações do NRC 2006 e AAFCO 2014\r\n\r\nCod: 1954008\r\nDetalhes\r\nA Ração Pet Delícia Panelinha de Carne é um alimento com receita balanceada para cães, feita com cortes nobres de carne bovina, arroz, legumes, vitaminas e minerais. Possui formulação rica em antioxidantes e anti-inflamatórios. Promove sensação de saciedade, além de auxiliar na saúde intestinal. Uma ração saborosa e cheirosa, com umidade ideal, sendo adequada para doguinhos que tem paladar exigente e gostam do sabor de carne bovina ou que tem uma digestão lenta e precisam de uma dieta fácil digestão e leve.', 0.0, 0, 1, 1, 2, '2024-12-04 23:16:49', NULL),
(16, 'Ração Seca True para Cães Adultos Raças Pequenas', 'Resumo\r\nInspirada no amor que sentimos por eles, a True foi desenvolvida para oferecer a melhor alimentação para os nossos pets.\r\n\r\n- Ração natural feita com ingredientes deliciosos: frango, batata-doce, brócolis, cenoura e arroz integral;\r\n- Feita com carne de verdade, sem farinha de vísceras;\r\n- Sem transgênicos, sem corantes e sem conservantes artificiais;\r\n- Saudável e nutritiva, enriquecida com Natural Complex: composto natural rico em extratos herbais, algas, fibras e prebióticos para reforçar as defesas do organismo;\r\n\r\n- Ingredientes funcionais:\r\n- Hexametamosfato de sódio para prevenção de tártaro;\r\n- Extrato de yucca para redução do odor das fezes;\r\n- Condroitina e glicosamina para saúde das articulações;\r\n- Com fibras e prebióticos para a saúde intestinal;\r\n\r\nTrue Amor de Verdade, Ingredientes de Verdade.\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição\r\n\r\nCod: 2638253\r\nDetalhes\r\nA Ração para cachorro True, feita para Cães Adultos Raças Pequenas 2,5kg é um alimento completo e super premium natural.\r\n\r\n- Feita com ingredientes naturais e deliciosos: frango, batata-doce, brócolis, cenoura e arroz integral;\r\n- Feita com carne de verdade, sem farinha de vísceras;\r\n- Sem transgênicos, corantes e conservantes artificiais;\r\n- Enriquecido com Natural Complex: composto natural exclusivo rico em antioxidantes para reforçar as defesas do organismo;\r\n\r\nTrue Amor de Verdade, Ingrediente de Verdade.\r\n\r\nPara mais informações acesse: www.truefoods.com.br\r\nDúvidas entre em contato com contato@truefoods.com.br\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente à True Foods por meio do telefone (11) 3135 6555.\r\n\r\n', 0.0, 0, 1, 1, 2, '2024-12-04 23:19:16', NULL),
(17, 'Ração GranPlus Choice Frango e Carne para Cães Adultos', 'Resumo\r\n- Manutenção da massa muscular, com fontes nobres de proteína;\r\n- Este produto possui satisfação garantida. Saiba mais abaixo na descrição;\r\n- Nutrição equilibrada, nível ideal de nutrientes para auxiliar na manutenção da saúde e na formação de fezes firmes;\r\n- Ossos e dentes saudáveis, com vitaminas e minerais que auxiliam na manutenção de ossos e dentes saudáveis.\r\n\r\n\r\nCod: 3109089-1\r\nDetalhes\r\nA Ração GranPlus Choice Frango e Carne para Cães Adultos é um alimento completo e equilibrado que proporciona aos cães adultos o nível ideal de todos os ingredientes para auxiliá-los a se manterem fortes e saudáveis. Além disso, é formulado com proteínas de origem animal de alta qualidade e é indicado para cães adultos de todos os portes.\r\n\r\nSolicitações referentes à Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do telefone 0800 016 9090. Para mais informações acesse: https://granplus.com.br/100-satisfacao/', 0.0, 0, 1, 1, 2, '2024-12-04 23:21:15', NULL),
(18, 'Ração Seca Origens Frango e Cereais Cães Adultos Raças Minis e Pequenas', 'Resumo\r\n- Sem corantes e aromatizantes artificiais, cuida do bem-estar do seu pet;\r\n- Ingredientes de alta qualidade e palatabilidade com sabor de frango e cereais;\r\n- Probióticos e fibras oferece equilíbrio da flora intestinal e pelos mais brilhantes;\r\n- Composta por extrato de Yucca, que reduz a quantidade e o cheiro das fezes;\r\n- Grãos com partículas menores de acordo com o porte do cão, e auxílio na mastigação;\r\n- Embalagem com sistema de fechamento em velcro para facilitar no manuseio diário.\r\n\r\nCod: 2312002\r\nDetalhes\r\nA Ração Seca Origens Premium Especial Frango e Cereais Cães Adultos Raças Pequenas oferece uma alimentação nutritiva e de alta qualidade ao seu melhor amigo. Composta por vitaminas, ômega 3 e 6, probióticos, fibras e extrato de yucca, ela mantém a saúde e o bem-estar do seu peludo em dia, além de manter uma pelagem mais brilhante e sedosa.\r\n\r\n', 0.0, 0, 1, 1, 2, '2024-12-04 23:22:59', NULL),
(19, 'Ração Special Dog Ultralife Light para Cães de Raças Pequenas', 'Resumo\r\n- Sabor: Frango com batata-doce, beterraba, ervilha e arroz;\r\n- Zero corantes e aromatizantes;\r\n- Manutenção do peso ideal;\r\n- Com prebióticos MOS: favorece a saúde intestinal;\r\n- Extrato de Yucca + Fibras: fezes mais firmes e com menos odor.\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nCod: 1780043\r\nDetalhes\r\nA Ração Special Dog Ultralife Light para Cães de Raças Pequenas é formulada com ingredientes selecionados como batata-doce, beterraba e ervilha, que melhoram a absorção dos nutrientes. Além disso, possui teor calórico reduzido e fibras especiais, auxiliando na manutenção do peso ideal.\r\n\r\nSolicitações referentes ao programa Garantia de Satisfação devem ser encaminhadas diretamente para o fabricante por meio do telefone 0800 707 5188. Para mais informações acesse: https://www.specialdog.com.br/satisfacao', 0.0, 0, 1, 1, 2, '2024-12-04 23:24:47', NULL),
(20, 'Ração Special Dog Ultralife Frango e Arroz para Cães Adultos Raças Pequenas', 'Resumo\r\n- Sem corantes e aromas artificiais;\r\n- Contém taurina, que ajuda na circulação sanguínea;\r\n- Com Zinco e Ômega 6 para pele sadia e pelo brilhante;\r\n- Feito com frango e fibras naturais para digestão equilibrada;\r\n- Alimento High Premium com excelente absorção de nutrientes;\r\n- Com balanço de minerais que ajudam na saúde do trato urinário;\r\n\r\n- Este produto possui Satisfação Garantida. Saiba mais abaixo na descrição.\r\n\r\nCod: 1542577\r\nDetalhes\r\nA Ração Optimum Sachê Frango para Gatos Adultos Castrados é completa pois possui todos os nutrientes que o gato precisa. Funcional pois garante parte do consumo de água diário, essencial para a saúde do animal. O que o gato consome em cada etapa de vida tem resultado direto em seu crescimento, força e bem-estar. Por isso OPTIMUM™ sachê foi desenvolvido usando as melhores matérias-primas, proteínas cuidadosamente selecionadas e nutrientes essenciais. Experimente misturar sachê com alimento seco. Pesquisas indicam que misturar alimentos úmidos e secos traz inúmeros benefícios à saúde do felino.\r\n100% Satisfação Garantida ou seu dinheiro de volta. Os produtos OPTIMUM™ foram desenvolvidos seguindo as recomendações de WALTHAM – a maior autoridade mundial em nutrição, cuidado e bem-estar animal. Saiba mais em www.waltham.com\r\n\r\nSAC MARS BRASIL - Serviço de Atendimento ao Consumidor - DDG 0800-702-0090/ Caixa postal 61, CEP 08900-970 - Guararema - SP/ sac.brasil@mars.com.br - www.optimumpet.com.br', 0.0, 0, 1, 1, 2, '2024-12-04 23:26:32', NULL),
(21, 'Ração Seca BR4 Dogs Arroz e Frango para Cães Raças Pequenas e Minis', 'Resumo\r\n- Ajuda na saúde bucal e reduz o mau hálito;\r\n- Colabora para a redução de odores e volume das fezes;\r\n- Fórmula que contribui para a beleza e saúde da pelagem;\r\n- Calorias na medida certa, auxilia na manutenção do peso ideal.\r\n\r\nCod: 3102750326\r\nDetalhes\r\nA Ração Seca BR4 Dogs Arroz e Frango para Cães Raças Pequenas e Minis é feita com o exclusivo ingrediente funcional Imunoglobulinas, comprovado pela ciência por sua ação na prevenção de doenças e saúde bucal, principalmente no combate ao mau hálito. Além disso, o alimento possui apenas as calorias necessárias para as refeições diárias e ajuda à manter o peso ideal. Conta ainda com componentes que deixam os pelos bonitos e a pele saudável, diminuem o mau cheiro e volume das fezes.', 0.0, 0, 1, 1, 2, '2024-12-04 23:27:48', NULL),
(22, 'Ração Seca Nutrilus Pro+ Frango & Carne para Cães Filhotes de Raças Médias e Grandes', 'Resumo\r\nNutrilus Pro+ Cães Filhotes é uma ração premium especial, desenvolvida por médicos veterinários, com ingredientes selecionados, sem corantes e sem aromatizantes artificiais, garantindo uma alimentação balanceada mais saborosa e nutritiva. Mais sabor, mais proteína e mais nutrição.\r\n\r\nGarantia de Satisfação: Nutrilus acredita que a satisfação é um comprometimento com a vida do pet, e garantimos você e seu pet satisfeitos ou seu dinheiro de volta.\r\n\r\n- Proteínas de alta qualidade: favorece o ótimo aproveitamento dos nutrientes para a manutenção da musculatura e condição corporal ideal;\r\n- Intestino saudável: com fibras que favorecem uma função intestinal regular;\r\n- Pelagem macia e brilhante: aporte equilibrado de ácidos graxos essenciais, ômega 3 e 6, vitaminas e minerais;\r\n- Redução do odor das fezes: com extrato de yucca, ideal para ambientes internos;\r\n- Crescimento saudável: enriquecido com DHA que atua no desenvolvimento cerebral, aprendizagem e visão dos filhotes.\r\n\r\n- Sabor: Frango & Carne\r\n- Embalagem: disponível na versão de 15kg\r\n- Tamanho médio do grão: 9mm\r\n- Indicado para: cães filhotes de raças médias e grandes\r\n\r\nCod: 2616890\r\nDetalhes\r\nA Nutrilus é uma marca de ração para cachorros e gatos desenvolvida por médicos veterinários e produzida com ingredientes selecionados, sem corantes e sem aromatizantes artificiais, que oferece uma alimentação balanceada, nutritiva e saborosa ao animal. É uma ração premium especial que proporciona nutrição de alta qualidade com um dos melhores custo-benefício do mercado pet. Perfeita para nutrir e alegrar o seu pet! Com venda exclusiva nos canais da Petlove, você encontra a ração Nutrilus para cachorros filhotes, adultos e idosos e para gatos adultos e castrados.\r\n\r\nNutrilus garante você e seu pet satisfeitos: a nutrição dos cães e gatos e satisfação dos tutores são nossos maiores objetivos. Por isso, oferecemos o programa garantia de satisfação. Para saber mais, entre em contato pelo telefone (11) 2853-0131 ou pelo e-mail contato@nutrilus.com.br, disponível de segunda a sexta das 9h às 17h. Para mais informações acesse: www.nutrilus.com.br. *seu dinheiro de volta em crédito do site Petlove', 0.0, 0, 1, 1, 2, '2024-12-04 23:29:06', NULL),
(23, 'Ração Seca Nutrilus Pro Carne para Cães Adultos', 'Resumo\r\nNutrilus Pro Cães Adultos é uma ração premium especial, desenvolvida por médicos veterinários, com ingredientes selecionados, sem corantes e sem aromatizantes artificiais, garantindo uma alimentação balanceada e completa. Além disso, possui ótimo custo-beneficio.\r\n\r\nGarantia de Satisfação: Nutrilus acredita que a satisfação é um comprometimento com a vida do pet, e garantimos você e seu pet satisfeitos ou seu dinheiro de volta..\r\n\r\n- Redução do odor das fezes;\r\n- Intestino saudável: com fibras que favorecem uma função intestinal regular;\r\n- Proteínas de alta qualidade: favorece o ótimo aproveitamento dos nutrientes para a manutenção da musculatura e condição corporal ideal;\r\n- Mantém a pelagem macia e brilhante, composto com antioxidantes (BHA, BHT).\r\n\r\n- Sabor: Carne\r\n- Embalagem: disponível na versão de 15kg e 20kg\r\n- Tamanho médio do grão: 9mm\r\n- Indicado para: cães adultos\r\n\r\nCod: 31027518114\r\nDetalhes\r\nA Nutrilus é uma marca de ração para cachorros e gatos desenvolvida por médicos veterinários e produzida com ingredientes selecionados, sem corantes e sem aromatizantes artificiais, que oferece uma alimentação balanceada, nutritiva e saborosa ao animal. É uma ração premium especial que proporciona nutrição de alta qualidade com um dos melhores custo-benefício do mercado pet. Perfeita para nutrir e alegrar o seu pet! Com venda exclusiva nos canais da Petlove, você encontra a ração Nutrilus para cachorros filhotes, adultos e idosos e para gatos adultos e castrados. Nutrilus garante você e seu pet satisfeitos: a nutrição dos cães e gatos e satisfação dos tutores são nossos maiores objetivos. Por isso, oferecemos o programa garantia de satisfação. Para saber mais, entre em contato pelo telefone (11) 2853-0131 ou pelo e-mail contato@nutrilus.com.br, disponível de segunda a sexta das 9h às 17h. Para mais informações acesse: www.nutrilus.com.br. *seu dinheiro de volta em crédito do site Petlove', 0.0, 0, 1, 1, 2, '2024-12-04 23:30:33', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_comentario`
--

CREATE TABLE `tb_produto_comentario` (
  `id` int(11) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `nomeCliente` varchar(255) NOT NULL,
  `produtoTamanho` int(11) DEFAULT NULL,
  `itemvenda` int(11) NOT NULL,
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
(1, 100, 1, '2024-12-04 22:33:46', '2024-12-04 22:33:57'),
(2, 100, 2, '2024-12-04 22:33:46', '2024-12-04 22:33:57'),
(3, 100, 3, '2024-12-04 22:34:59', '2024-12-04 22:35:10'),
(4, 100, 4, '2024-12-04 22:38:11', '2024-12-04 22:38:29'),
(5, 100, 5, '2024-12-04 22:42:55', '2024-12-04 22:43:03'),
(6, 100, 6, '2024-12-04 22:44:06', '2024-12-04 22:44:19'),
(7, 100, 7, '2024-12-04 22:46:50', '2024-12-04 22:46:58'),
(8, 100, 8, '2024-12-04 22:47:59', '2024-12-04 22:48:07'),
(9, 111, 9, '2024-12-04 22:49:04', '2024-12-04 22:49:08'),
(10, 100, 10, '2024-12-04 22:56:55', '2024-12-04 22:57:03'),
(11, 100, 11, '2024-12-04 22:56:56', '2024-12-04 22:57:03'),
(12, 111, 12, '2024-12-04 23:00:36', '2024-12-04 23:00:42'),
(13, 111, 13, '2024-12-04 23:03:28', '2024-12-04 23:03:34'),
(14, 111, 14, '2024-12-04 23:03:28', '2024-12-04 23:03:34'),
(15, 111, 15, '2024-12-04 23:03:28', '2024-12-04 23:03:34'),
(16, 111, 16, '2024-12-04 23:08:25', '2024-12-04 23:08:32'),
(17, 111, 17, '2024-12-04 23:08:25', '2024-12-04 23:08:32'),
(18, 111, 18, '2024-12-04 23:08:25', '2024-12-04 23:08:32'),
(19, 111, 19, '2024-12-04 23:12:54', '2024-12-04 23:13:01'),
(20, 111, 20, '2024-12-04 23:12:55', '2024-12-04 23:13:01'),
(21, 111, 21, '2024-12-04 23:12:55', '2024-12-04 23:13:01'),
(22, 111, 22, '2024-12-04 23:15:00', '2024-12-04 23:15:09'),
(23, 111, 23, '2024-12-04 23:15:00', '2024-12-04 23:15:09'),
(24, 111, 24, '2024-12-04 23:15:00', '2024-12-04 23:15:09'),
(25, 111, 25, '2024-12-04 23:16:49', '2024-12-04 23:16:54'),
(26, 233, 26, '2024-12-04 23:19:16', '2024-12-04 23:19:25'),
(27, 324, 27, '2024-12-04 23:19:16', '2024-12-04 23:19:25'),
(28, 432, 28, '2024-12-04 23:19:16', '2024-12-04 23:19:25'),
(29, 231, 29, '2024-12-04 23:21:15', '2024-12-04 23:21:22'),
(30, 21, 30, '2024-12-04 23:21:15', '2024-12-04 23:21:22'),
(31, 231, 31, '2024-12-04 23:21:15', '2024-12-04 23:21:22'),
(32, 321, 32, '2024-12-04 23:22:59', '2024-12-04 23:23:05'),
(33, 321, 33, '2024-12-04 23:22:59', '2024-12-04 23:23:06'),
(34, 231, 34, '2024-12-04 23:22:59', '2024-12-04 23:23:06'),
(35, 123, 35, '2024-12-04 23:24:47', '2024-12-04 23:24:54'),
(36, 321, 36, '2024-12-04 23:24:47', '2024-12-04 23:24:54'),
(37, 123, 37, '2024-12-04 23:24:47', '2024-12-04 23:24:54'),
(38, 123, 38, '2024-12-04 23:26:33', '2024-12-04 23:26:40'),
(39, 321, 39, '2024-12-04 23:26:33', '2024-12-04 23:26:40'),
(40, 123, 40, '2024-12-04 23:26:33', '2024-12-04 23:26:40'),
(41, 212, 41, '2024-12-04 23:27:48', '2024-12-04 23:27:55'),
(42, 212, 42, '2024-12-04 23:27:48', '2024-12-04 23:27:55'),
(43, 123, 43, '2024-12-04 23:29:07', '2024-12-04 23:29:13'),
(44, 123, 44, '2024-12-04 23:29:07', '2024-12-04 23:29:13'),
(45, 123, 45, '2024-12-04 23:30:33', '2024-12-04 23:30:37'),
(46, 123, 46, '2024-12-04 23:30:33', '2024-12-04 23:30:37');

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
(1, '1_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_Tamanhos_1.jpg', 1, '2024-12-04 22:33:46', NULL),
(2, '1_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_Tamanhos_2.jpg', 1, '2024-12-04 22:33:46', NULL),
(3, '1_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_Tamanhos_3.jpg', 1, '2024-12-04 22:33:46', NULL),
(4, '1_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_Tamanhos_4.jpg', 1, '2024-12-04 22:33:46', NULL),
(5, '1_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_Tamanhos_5.jpg', 1, '2024-12-04 22:33:46', NULL),
(6, '1_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Adultos_de_Raças_Médias_e_Grandes_Tamanhos_6.webp', 1, '2024-12-04 22:33:46', NULL),
(7, '2_Ração_Úmida_Optimum_Sachê_para_Gatos_Adultos_Castrados_Frango_Tamanhos_1.jpg', 2, '2024-12-04 22:34:59', NULL),
(8, '2_Ração_Úmida_Optimum_Sachê_para_Gatos_Adultos_Castrados_Frango_Tamanhos_2.jpg', 2, '2024-12-04 22:34:59', NULL),
(9, '2_Ração_Úmida_Optimum_Sachê_para_Gatos_Adultos_Castrados_Frango_Tamanhos_3.jpg', 2, '2024-12-04 22:34:59', NULL),
(10, '2_Ração_Úmida_Optimum_Sachê_para_Gatos_Adultos_Castrados_Frango_Tamanhos_4.jpg', 2, '2024-12-04 22:34:59', NULL),
(11, '2_Ração_Úmida_Optimum_Sachê_para_Gatos_Adultos_Castrados_Frango_Tamanhos_5.jpg', 2, '2024-12-04 22:34:59', NULL),
(12, '3_Ração_Úmida_Origens_Frango_e_Carne_para_Gatos_Castrados_Tamanhos_1.jpg', 3, '2024-12-04 22:38:42', NULL),
(13, '3_Ração_Úmida_Origens_Frango_e_Carne_para_Gatos_Castrados_Tamanhos_2.webp', 3, '2024-12-04 22:38:43', NULL),
(14, '4_Ração_Úmida_Guabi_Natural_Grain_Free_Frango,_Salmão_e_Vegetais_para_Gatos_Tamanhos_1.jpg', 4, '2024-12-04 22:42:55', NULL),
(15, '4_Ração_Úmida_Guabi_Natural_Grain_Free_Frango,_Salmão_e_Vegetais_para_Gatos_Tamanhos_2.jpg', 4, '2024-12-04 22:42:55', NULL),
(16, '5_Ração_Úmida_Everest_Gourmet_Tilápia_com_Batata_Doce_e_Quinoa_para_Gatos_Tamanhos_1.jpg', 5, '2024-12-04 22:44:06', NULL),
(17, '5_Ração_Úmida_Everest_Gourmet_Tilápia_com_Batata_Doce_e_Quinoa_para_Gatos_Tamanhos_2.jpg', 5, '2024-12-04 22:44:06', NULL),
(18, '5_Ração_Úmida_Everest_Gourmet_Tilápia_com_Batata_Doce_e_Quinoa_para_Gatos_Tamanhos_3.jpg', 5, '2024-12-04 22:44:06', NULL),
(19, '5_Ração_Úmida_Everest_Gourmet_Tilápia_com_Batata_Doce_e_Quinoa_para_Gatos_Tamanhos_4.webp', 5, '2024-12-04 22:44:06', NULL),
(20, '5_Ração_Úmida_Everest_Gourmet_Tilápia_com_Batata_Doce_e_Quinoa_para_Gatos_Tamanhos_5.jpg', 5, '2024-12-04 22:44:06', NULL),
(21, '6_Ração_Nestlé_Purina_Friskies_Sachê_Salmão_ao_Molho_para_Gatos_Tamanhos_1.jpg', 6, '2024-12-04 22:46:50', NULL),
(22, '6_Ração_Nestlé_Purina_Friskies_Sachê_Salmão_ao_Molho_para_Gatos_Tamanhos_2.jpg', 6, '2024-12-04 22:46:50', NULL),
(23, '6_Ração_Nestlé_Purina_Friskies_Sachê_Salmão_ao_Molho_para_Gatos_Tamanhos_3.webp', 6, '2024-12-04 22:46:50', NULL),
(24, '7_Ração_Úmida_GranPlus_Sachê_Atum_para_Gatos_Adultos_Tamanhos_1.webp', 7, '2024-12-04 22:47:59', NULL),
(25, '7_Ração_Úmida_GranPlus_Sachê_Atum_para_Gatos_Adultos_Tamanhos_2.jpg', 7, '2024-12-04 22:47:59', NULL),
(26, '7_Ração_Úmida_GranPlus_Sachê_Atum_para_Gatos_Adultos_Tamanhos_3.jpg', 7, '2024-12-04 22:48:00', NULL),
(27, '7_Ração_Úmida_GranPlus_Sachê_Atum_para_Gatos_Adultos_Tamanhos_4.jpg', 7, '2024-12-04 22:48:00', NULL),
(28, '7_Ração_Úmida_GranPlus_Sachê_Atum_para_Gatos_Adultos_Tamanhos_5.jpg', 7, '2024-12-04 22:48:00', NULL),
(29, '7_Ração_Úmida_GranPlus_Sachê_Atum_para_Gatos_Adultos_Tamanhos_6.jpg', 7, '2024-12-04 22:48:00', NULL),
(30, '8_Ração_Úmida_Special_Cat_Patê_Carne_para_Gatos_Castrados_Tamanhos_1.webp', 8, '2024-12-04 22:49:04', NULL),
(31, '8_Ração_Úmida_Special_Cat_Patê_Carne_para_Gatos_Castrados_Tamanhos_2.jpg', 8, '2024-12-04 22:49:04', NULL),
(32, '8_Ração_Úmida_Special_Cat_Patê_Carne_para_Gatos_Castrados_Tamanhos_3.jpg', 8, '2024-12-04 22:49:04', NULL),
(33, '9_Ração_Seca_PremieR_Pet_Golden_Salmão_para_Gatos_Adultos_Castrados_Tamanhos_1.jpg', 9, '2024-12-04 22:57:37', NULL),
(34, '9_Ração_Seca_PremieR_Pet_Golden_Salmão_para_Gatos_Adultos_Castrados_Tamanhos_2.jpg', 9, '2024-12-04 22:57:37', NULL),
(35, '9_Ração_Seca_PremieR_Pet_Golden_Salmão_para_Gatos_Adultos_Castrados_Tamanhos_3.webp', 9, '2024-12-04 22:57:37', NULL),
(36, '10_Ração_Royal_Canin_Sterilised_para_Gatos_Adultos_Castrados_Tamanhos_1.jpg', 10, '2024-12-04 23:00:58', NULL),
(37, '10_Ração_Royal_Canin_Sterilised_para_Gatos_Adultos_Castrados_Tamanhos_2.webp', 10, '2024-12-04 23:00:58', NULL),
(38, '10_Ração_Royal_Canin_Sterilised_para_Gatos_Adultos_Castrados_Tamanhos_3.webp', 10, '2024-12-04 23:00:58', NULL),
(39, '11_Ração_Seca_PremieR_Pet_Golden_Gatos_Adultos_Carne_Tamanhos_1.jpg', 11, '2024-12-04 23:04:08', NULL),
(40, '11_Ração_Seca_PremieR_Pet_Golden_Gatos_Adultos_Carne_Tamanhos_2.jpg', 11, '2024-12-04 23:04:08', NULL),
(41, '11_Ração_Seca_PremieR_Pet_Golden_Gatos_Adultos_Carne_Tamanhos_3.jpg', 11, '2024-12-04 23:04:08', NULL),
(42, '11_Ração_Seca_PremieR_Pet_Golden_Gatos_Adultos_Carne_Tamanhos_4.webp', 11, '2024-12-04 23:04:08', NULL),
(43, '11_Ração_Seca_PremieR_Pet_Golden_Gatos_Adultos_Carne_Tamanhos_5.webp', 11, '2024-12-04 23:04:08', NULL),
(46, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_3.webp', 12, '2024-12-04 23:08:25', NULL),
(47, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_4.jpg', 12, '2024-12-04 23:08:25', NULL),
(48, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_5.webp', 12, '2024-12-04 23:08:25', NULL),
(49, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_6.webp', 12, '2024-12-04 23:08:25', NULL),
(50, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_7.jpg', 12, '2024-12-04 23:08:25', NULL),
(51, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_8.webp', 12, '2024-12-04 23:08:25', NULL),
(52, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_9.webp', 12, '2024-12-04 23:08:25', NULL),
(53, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_10.webp', 12, '2024-12-04 23:08:25', NULL),
(54, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_11.jpg', 12, '2024-12-04 23:08:56', NULL),
(55, '12_Ração_Seca_Origens_Carne_Gatos_Adultos_Tamanhos_12.jpg', 12, '2024-12-04 23:08:56', NULL),
(56, '13_Ração_Royal_Canin_Medium_Adult_para_Cães_Adultos_de_Raças_Médias_a_partir_de_12_Meses_de_Idade_1.jpg', 13, '2024-12-04 23:12:55', NULL),
(57, '13_Ração_Royal_Canin_Medium_Adult_para_Cães_Adultos_de_Raças_Médias_a_partir_de_12_Meses_de_Idade_2.webp', 13, '2024-12-04 23:12:55', NULL),
(58, '13_Ração_Royal_Canin_Medium_Adult_para_Cães_Adultos_de_Raças_Médias_a_partir_de_12_Meses_de_Idade_3.webp', 13, '2024-12-04 23:12:55', NULL),
(59, '13_Ração_Royal_Canin_Medium_Adult_para_Cães_Adultos_de_Raças_Médias_a_partir_de_12_Meses_de_Idade_4.jpg', 13, '2024-12-04 23:12:55', NULL),
(60, '14_Ração_Seca_Nestlé_Purina_Alpo_Carne,_Frango,_Cereais_e_Vegetais_para_Cães_Adultos_1.jpg', 14, '2024-12-04 23:15:38', NULL),
(61, '14_Ração_Seca_Nestlé_Purina_Alpo_Carne,_Frango,_Cereais_e_Vegetais_para_Cães_Adultos_2.webp', 14, '2024-12-04 23:15:38', NULL),
(62, '14_Ração_Seca_Nestlé_Purina_Alpo_Carne,_Frango,_Cereais_e_Vegetais_para_Cães_Adultos_3.jpg', 14, '2024-12-04 23:15:38', NULL),
(63, '14_Ração_Seca_Nestlé_Purina_Alpo_Carne,_Frango,_Cereais_e_Vegetais_para_Cães_Adultos_4.jpg', 14, '2024-12-04 23:15:38', NULL),
(64, '15_Ração_Úmida_Pet_Delícia_Natural_Panelinha_de_Carne_2.webp', 15, '2024-12-04 23:16:49', NULL),
(65, '15_Ração_Úmida_Pet_Delícia_Natural_Panelinha_de_Carne_3.jpg', 15, '2024-12-04 23:16:49', NULL),
(66, '15_Ração_Úmida_Pet_Delícia_Natural_Panelinha_de_Carne_4.jpg', 15, '2024-12-04 23:16:49', NULL),
(67, '15_Ração_Úmida_Pet_Delícia_Natural_Panelinha_de_Carne_5.jpg', 15, '2024-12-04 23:16:49', NULL),
(68, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_1.jpg', 16, '2024-12-04 23:19:16', NULL),
(69, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_2.jpg', 16, '2024-12-04 23:19:16', NULL),
(70, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_3.webp', 16, '2024-12-04 23:19:16', NULL),
(71, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_4.webp', 16, '2024-12-04 23:19:17', NULL),
(72, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_5.webp', 16, '2024-12-04 23:19:17', NULL),
(73, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_6.webp', 16, '2024-12-04 23:19:17', NULL),
(74, '16_Ração_Seca_True_para_Cães_Adultos_Raças_Pequenas_7.webp', 16, '2024-12-04 23:19:17', NULL),
(75, '17_Ração_GranPlus_Choice_Frango_e_Carne_para_Cães_Adultos_1.jpg', 17, '2024-12-04 23:21:16', NULL),
(76, '17_Ração_GranPlus_Choice_Frango_e_Carne_para_Cães_Adultos_2.jpg', 17, '2024-12-04 23:21:16', NULL),
(77, '17_Ração_GranPlus_Choice_Frango_e_Carne_para_Cães_Adultos_3.jpg', 17, '2024-12-04 23:21:16', NULL),
(78, '17_Ração_GranPlus_Choice_Frango_e_Carne_para_Cães_Adultos_4.webp', 17, '2024-12-04 23:21:16', NULL),
(79, '18_Ração_Seca_Origens_Frango_e_Cereais_Cães_Adultos_Raças_Minis_e_Pequenas_1.jpg', 18, '2024-12-04 23:23:00', NULL),
(80, '18_Ração_Seca_Origens_Frango_e_Cereais_Cães_Adultos_Raças_Minis_e_Pequenas_2.jpeg', 18, '2024-12-04 23:23:00', NULL),
(81, '18_Ração_Seca_Origens_Frango_e_Cereais_Cães_Adultos_Raças_Minis_e_Pequenas_3.webp', 18, '2024-12-04 23:23:00', NULL),
(82, '18_Ração_Seca_Origens_Frango_e_Cereais_Cães_Adultos_Raças_Minis_e_Pequenas_4.webp', 18, '2024-12-04 23:23:00', NULL),
(83, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_1.webp', 19, '2024-12-04 23:24:47', NULL),
(84, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_2.jpg', 19, '2024-12-04 23:24:47', NULL),
(85, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_3.jpg', 19, '2024-12-04 23:24:47', NULL),
(86, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_4.jpg', 19, '2024-12-04 23:24:47', NULL),
(87, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_5.jpg', 19, '2024-12-04 23:24:47', NULL),
(88, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_6.jpg', 19, '2024-12-04 23:24:47', NULL),
(89, '19_Ração_Special_Dog_Ultralife_Light_para_Cães_de_Raças_Pequenas_7.jpg', 19, '2024-12-04 23:24:47', NULL),
(90, '20_Ração_Special_Dog_Ultralife_Frango_e_Arroz_para_Cães_Adultos_Raças_Pequenas_1.webp', 20, '2024-12-04 23:26:33', NULL),
(91, '20_Ração_Special_Dog_Ultralife_Frango_e_Arroz_para_Cães_Adultos_Raças_Pequenas_2.jpg', 20, '2024-12-04 23:26:33', NULL),
(92, '20_Ração_Special_Dog_Ultralife_Frango_e_Arroz_para_Cães_Adultos_Raças_Pequenas_3.jpg', 20, '2024-12-04 23:26:33', NULL),
(93, '20_Ração_Special_Dog_Ultralife_Frango_e_Arroz_para_Cães_Adultos_Raças_Pequenas_4.jpg', 20, '2024-12-04 23:26:33', NULL),
(94, '20_Ração_Special_Dog_Ultralife_Frango_e_Arroz_para_Cães_Adultos_Raças_Pequenas_5.jpg', 20, '2024-12-04 23:26:33', NULL),
(95, '20_Ração_Special_Dog_Ultralife_Frango_e_Arroz_para_Cães_Adultos_Raças_Pequenas_6.jpg', 20, '2024-12-04 23:26:33', NULL),
(96, '21_Ração_Seca_BR4_Dogs_Arroz_e_Frango_para_Cães_Raças_Pequenas_e_Minis_1.webp', 21, '2024-12-04 23:27:48', NULL),
(97, '21_Ração_Seca_BR4_Dogs_Arroz_e_Frango_para_Cães_Raças_Pequenas_e_Minis_2.jpg', 21, '2024-12-04 23:27:48', NULL),
(98, '21_Ração_Seca_BR4_Dogs_Arroz_e_Frango_para_Cães_Raças_Pequenas_e_Minis_3.webp', 21, '2024-12-04 23:27:48', NULL),
(99, '21_Ração_Seca_BR4_Dogs_Arroz_e_Frango_para_Cães_Raças_Pequenas_e_Minis_4.webp', 21, '2024-12-04 23:27:48', NULL),
(100, '21_Ração_Seca_BR4_Dogs_Arroz_e_Frango_para_Cães_Raças_Pequenas_e_Minis_5.webp', 21, '2024-12-04 23:27:48', NULL),
(101, '21_Ração_Seca_BR4_Dogs_Arroz_e_Frango_para_Cães_Raças_Pequenas_e_Minis_6.webp', 21, '2024-12-04 23:27:48', NULL),
(102, '22_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Filhotes_de_Raças_Médias_e_Grandes_1.webp', 22, '2024-12-04 23:29:07', NULL),
(103, '22_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Filhotes_de_Raças_Médias_e_Grandes_2.jpg', 22, '2024-12-04 23:29:07', NULL),
(104, '22_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Filhotes_de_Raças_Médias_e_Grandes_3.webp', 22, '2024-12-04 23:29:07', NULL),
(105, '22_Ração_Seca_Nutrilus_Pro+_Frango_&_Carne_para_Cães_Filhotes_de_Raças_Médias_e_Grandes_4.jpg', 22, '2024-12-04 23:29:07', NULL),
(106, '23_Ração_Seca_Nutrilus_Pro_Carne_para_Cães_Adultos_1.jpg', 23, '2024-12-04 23:30:33', NULL),
(107, '23_Ração_Seca_Nutrilus_Pro_Carne_para_Cães_Adultos_2.jpg', 23, '2024-12-04 23:30:33', NULL),
(108, '23_Ração_Seca_Nutrilus_Pro_Carne_para_Cães_Adultos_3.jpg', 23, '2024-12-04 23:30:33', NULL),
(109, '23_Ração_Seca_Nutrilus_Pro_Carne_para_Cães_Adultos_4.jpg', 23, '2024-12-04 23:30:33', NULL),
(110, '23_Ração_Seca_Nutrilus_Pro_Carne_para_Cães_Adultos_5.webp', 23, '2024-12-04 23:30:33', NULL);

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
(1, '15 Kg', 129.45, 1, 1, '2024-12-04 22:33:46', NULL),
(2, '20 Kg', 165.40, 1, 1, '2024-12-04 22:33:46', NULL),
(3, '85 g', 3.39, 1, 2, '2024-12-04 22:34:59', NULL),
(4, '85 g', 3.19, 1, 3, '2024-12-04 22:38:11', NULL),
(5, '85 g', 5.99, 1, 4, '2024-12-04 22:42:55', NULL),
(6, '90 g', 11.49, 1, 5, '2024-12-04 22:44:06', NULL),
(7, '85 g', 3.14, 1, 6, '2024-12-04 22:46:50', NULL),
(8, '85 g', 3.09, 1, 7, '2024-12-04 22:47:59', NULL),
(9, '100 g', 8.39, 1, 8, '2024-12-04 22:49:04', NULL),
(10, '1 Kg', 30.49, 1, 9, '2024-12-04 22:56:55', NULL),
(11, '3 Kg', 69.87, 1, 9, '2024-12-04 22:56:55', NULL),
(12, '10,1 Kg', 48.37, 1, 10, '2024-12-04 23:00:36', NULL),
(13, '1 Kg', 25.45, 1, 11, '2024-12-04 23:03:28', NULL),
(14, '3 Kg', 62.24, 1, 11, '2024-12-04 23:03:28', NULL),
(15, '10,1 Kg', 211.69, 1, 11, '2024-12-04 23:03:28', NULL),
(16, '1 Kg', 27.90, 1, 12, '2024-12-04 23:08:25', NULL),
(17, '3 Kg', 21.63, 1, 12, '2024-12-04 23:08:25', NULL),
(18, '10,1 Kg', 150.83, 1, 12, '2024-12-04 23:08:25', NULL),
(19, '2,5 Kg', 92.54, 1, 13, '2024-12-04 23:12:54', NULL),
(20, '15 Kg', 428.98, 1, 13, '2024-12-04 23:12:54', NULL),
(21, '17,5 Kg', 521.40, 1, 13, '2024-12-04 23:12:55', NULL),
(22, '1 Kg', 16.09, 1, 14, '2024-12-04 23:15:00', NULL),
(23, '10,1 Kg', 120.37, 1, 14, '2024-12-04 23:15:00', NULL),
(24, '18 Kg', 85.33, 1, 14, '2024-12-04 23:15:00', NULL),
(25, '320 g', 19.49, 1, 15, '2024-12-04 23:16:49', NULL),
(26, '2,5 Kg', 53.96, 1, 16, '2024-12-04 23:19:16', NULL),
(27, '10,1 Kg', 290.19, 1, 16, '2024-12-04 23:19:16', NULL),
(28, '12,6 Kg', 366.08, 1, 16, '2024-12-04 23:19:16', NULL),
(29, '10,1 Kg', 100.88, 1, 17, '2024-12-04 23:21:15', NULL),
(30, '15 Kg', 149.39, 1, 17, '2024-12-04 23:21:15', NULL),
(31, '20 Kg', 190.74, 1, 17, '2024-12-04 23:21:15', NULL),
(32, '1 Kg', 22.90, 1, 18, '2024-12-04 23:22:59', NULL),
(33, '3 Kg', 58.96, 1, 18, '2024-12-04 23:22:59', NULL),
(34, '10,1 Kg', 120.76, 1, 18, '2024-12-04 23:22:59', NULL),
(35, '1 Kg', 27.90, 1, 19, '2024-12-04 23:24:47', NULL),
(36, '3 Kg', 59.79, 1, 19, '2024-12-04 23:24:47', NULL),
(37, '15 Kg', 160.66, 1, 19, '2024-12-04 23:24:47', NULL),
(38, '1 Kg', 20.90, 1, 20, '2024-12-04 23:26:32', NULL),
(39, '3 Kg', 68.96, 1, 20, '2024-12-04 23:26:33', NULL),
(40, '10,1 Kg', 110.87, 1, 20, '2024-12-04 23:26:33', NULL),
(41, '3 Kg', 15.08, 1, 21, '2024-12-04 23:27:48', NULL),
(42, '10,1 Kg', 140.08, 1, 21, '2024-12-04 23:27:48', NULL),
(43, '15 Kg', 140.11, 1, 22, '2024-12-04 23:29:07', NULL),
(44, '20 Kg', 160.75, 1, 22, '2024-12-04 23:29:07', NULL),
(45, '15 Kg', 104.78, 1, 23, '2024-12-04 23:30:33', NULL),
(46, '20 Kg', 7.59, 1, 23, '2024-12-04 23:30:33', NULL);

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
(1, 'xistopet@gmail.com', '$2y$10$HgXNb9Kor1q7bQjb5Ny25OGznud/HeHFxXjkmsWJe0OsfKm4I98C.', NULL, NULL, NULL, '2024-12-03 21:01:50', '2024-12-03 23:42:08');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `tb_cliente_cartao`
--
ALTER TABLE `tb_cliente_cartao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`);

--
-- Índices de tabela `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`);

--
-- Índices de tabela `tb_cliente_favorito`
--
ALTER TABLE `tb_cliente_favorito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`);

--
-- Índices de tabela `tb_cliente_notificacao`
--
ALTER TABLE `tb_cliente_notificacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `venda` (`venda`),
  ADD KEY `itemVenda` (`itemVenda`),
  ADD KEY `tipo` (`tipo`);

--
-- Índices de tabela `tb_cliente_notificacao_tipo`
--
ALTER TABLE `tb_cliente_notificacao_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_fornecedor_fornecimento`
--
ALTER TABLE `tb_fornecedor_fornecimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fornecedor` (`fornecedor`),
  ADD KEY `estoque` (`estoque`);

--
-- Índices de tabela `tb_metodo_pagamento`
--
ALTER TABLE `tb_metodo_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`);

--
-- Índices de tabela `tb_produto_comentario`
--
ALTER TABLE `tb_produto_comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtoTamanho` (`produtoTamanho`),
  ADD KEY `produto` (`produto`),
  ADD KEY `itemvenda` (`itemvenda`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto` (`produto`),
  ADD KEY `venda` (`venda`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_administrador_nivel`
--
ALTER TABLE `tb_administrador_nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_cliente_cartao`
--
ALTER TABLE `tb_cliente_cartao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente_favorito`
--
ALTER TABLE `tb_cliente_favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente_notificacao`
--
ALTER TABLE `tb_cliente_notificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente_notificacao_tipo`
--
ALTER TABLE `tb_cliente_notificacao_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_fornecedor_fornecimento`
--
ALTER TABLE `tb_fornecedor_fornecimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `tb_metodo_pagamento`
--
ALTER TABLE `tb_metodo_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tb_produto_comentario`
--
ALTER TABLE `tb_produto_comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_produto_estoque`
--
ALTER TABLE `tb_produto_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de tabela `tb_produto_tamanho`
--
ALTER TABLE `tb_produto_tamanho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_venda_item`
--
ALTER TABLE `tb_venda_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_venda_status`
--
ALTER TABLE `tb_venda_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Restrições para tabelas `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `tb_cliente_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_usuario` (`id`);

--
-- Restrições para tabelas `tb_cliente_cartao`
--
ALTER TABLE `tb_cliente_cartao`
  ADD CONSTRAINT `tb_cliente_cartao_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `tb_cliente` (`id`);

--
-- Restrições para tabelas `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  ADD CONSTRAINT `tb_cliente_endereco_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `tb_cliente` (`id`);

--
-- Restrições para tabelas `tb_cliente_favorito`
--
ALTER TABLE `tb_cliente_favorito`
  ADD CONSTRAINT `tb_cliente_favorito_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `tb_cliente` (`id`);

--
-- Restrições para tabelas `tb_cliente_notificacao`
--
ALTER TABLE `tb_cliente_notificacao`
  ADD CONSTRAINT `tb_cliente_notificacao_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `tb_cliente` (`id`),
  ADD CONSTRAINT `tb_cliente_notificacao_ibfk_3` FOREIGN KEY (`itemVenda`) REFERENCES `tb_venda_item` (`id`),
  ADD CONSTRAINT `tb_cliente_notificacao_ibfk_4` FOREIGN KEY (`itemVenda`) REFERENCES `tb_venda_item` (`id`),
  ADD CONSTRAINT `tb_cliente_notificacao_ibfk_5` FOREIGN KEY (`tipo`) REFERENCES `tb_cliente_notificacao_tipo` (`id`);

--
-- Restrições para tabelas `tb_fornecedor_fornecimento`
--
ALTER TABLE `tb_fornecedor_fornecimento`
  ADD CONSTRAINT `tb_fornecedor_fornecimento_ibfk_1` FOREIGN KEY (`fornecedor`) REFERENCES `tb_fornecedor` (`id`),
  ADD CONSTRAINT `tb_fornecedor_fornecimento_ibfk_2` FOREIGN KEY (`estoque`) REFERENCES `tb_produto_estoque` (`id`);

--
-- Restrições para tabelas `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `tb_produto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `tb_categoria` (`id`);

--
-- Restrições para tabelas `tb_produto_comentario`
--
ALTER TABLE `tb_produto_comentario`
  ADD CONSTRAINT `tb_produto_comentario_ibfk_1` FOREIGN KEY (`produtoTamanho`) REFERENCES `tb_produto_tamanho` (`id`),
  ADD CONSTRAINT `tb_produto_comentario_ibfk_3` FOREIGN KEY (`produto`) REFERENCES `tb_produto` (`id`),
  ADD CONSTRAINT `tb_produto_comentario_ibfk_4` FOREIGN KEY (`itemvenda`) REFERENCES `tb_venda_item` (`id`);

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

--
-- Restrições para tabelas `tb_venda_item`
--
ALTER TABLE `tb_venda_item`
  ADD CONSTRAINT `tb_venda_item_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `tb_produto_tamanho` (`id`),
  ADD CONSTRAINT `tb_venda_item_ibfk_2` FOREIGN KEY (`venda`) REFERENCES `tb_venda` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
