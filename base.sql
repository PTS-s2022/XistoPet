-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/12/2024 às 00:45
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
(1, 0x255e8295d53cff73056c16bf3a386b947f3d7bab2d8057b4471f84f87d72d16b, 0x1666c19eab0cdab1aa2d6fb966ca660d, 0x4441125f1c1c69e9737f258fcf757b13, 42, 3, '2024-12-01 09:40:02', '2024-12-01 09:40:06');

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
-- Estrutura para tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `capital` tinyint(1) NOT NULL,
  `estado` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estrutura para tabela `tb_cliente_favorito`
--

CREATE TABLE `tb_cliente_favorito` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Estrutura para tabela `tb_cliente_notificacao`
--

CREATE TABLE `tb_cliente_notificacao` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `itemVenda` int(11) DEFAULT NULL,
  `venda` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estrutura para tabela `tb_produto_cor`
--

CREATE TABLE `tb_produto_cor` (
  `id` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `produto` int(11) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModify` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
(1, 'xistopet@gmail.com', NULL, '109395935496376993579', NULL, NULL, '2024-09-02 19:49:31', NULL)
---------------------------------------------------

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


INSERT INTO `tb_venda_item` (`id`, `quantidade`, `subTotal`, `avaliar`, `venda`, `produto`, `dateCreate`, `dateModify`) VALUES


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
-- Índices de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
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
-- Índices de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_cliente_cartao`
--
ALTER TABLE `tb_cliente_cartao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tb_cliente_favorito`
--
ALTER TABLE `tb_cliente_favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `tb_cliente_notificacao`
--
ALTER TABLE `tb_cliente_notificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `tb_produto_tamanho`
--
ALTER TABLE `tb_produto_tamanho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `tb_venda_item`
--
ALTER TABLE `tb_venda_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
