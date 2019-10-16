-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 11-Out-2019 às 13:46
-- Versão do servidor: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syscancela`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `condutor`
--

CREATE TABLE `condutor` (
  `condutor_id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setor_curso` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identificacao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cartaoRFID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem_condutor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'image.png',
  `telefone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prazo_final` datetime DEFAULT NULL,
  `data_de_criacao` timestamp NULL DEFAULT NULL,
  `ultima_atualizacao` timestamp NULL DEFAULT NULL,
  `data_de_exclusao` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `condutor`
--

INSERT INTO `condutor` (`condutor_id`, `nome`, `tipo`, `setor_curso`, `identificacao`, `cartaoRFID`, `imagem_condutor`, `telefone`, `email`, `motivo`, `prazo_final`, `data_de_criacao`, `ultima_atualizacao`, `data_de_exclusao`) VALUES
(21, 'Paulo Vitor', 'Aluno', 'Téc. em informática', '20171042310061', '11356672', 'pp.jpeg', '(85)989605773', 'paulovitor-100-@outlook.com', NULL, NULL, '2019-09-01 03:00:00', '2019-10-09 18:06:20', NULL),
(22, 'Beatriz Carlos da Silva', 'Aluno', 'Ciência da computação', '20182045050503', '04224372', 'image.png', '', '', NULL, NULL, NULL, '2019-10-10 12:20:33', NULL),
(23, 'Anderson Alves Bezerra', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20171045050303', '11353644', '20171045050303.jpg', '(85) 98101-4552', 'anderson.alves_ce@outlook.com', NULL, NULL, '2019-10-03 14:26:15', '2019-10-10 12:43:37', '2019-10-10 12:43:37'),
(26, 'Rafaela Da Mota Queiroz', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20171045050419', '05259165', '20171045050419.jpg', '(85) 98101-422', 'raffaelaqueiroz2012@gmail.com', NULL, NULL, '2019-10-07 18:11:00', '2019-10-09 18:31:30', '2019-10-09 18:31:30'),
(27, 'Daniel De Oliveira Macedo', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20182045050490', '4602829', '20182045050490.jpg', '(85) 98101-422', 'dan.oliveira461@gmail.com', NULL, NULL, '2019-10-08 12:08:36', '2019-10-10 12:37:28', '2019-10-10 12:37:28'),
(28, 'Matheus Moreira Da Silva', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20132045050221', '13511727', '20132045050221.jpg', '(85) 98759-7904', 'imatheusmoreira@gmail.com', NULL, NULL, '2019-10-08 12:22:20', '2019-10-10 12:37:52', '2019-10-10 12:37:52'),
(29, 'Webster Victor Alves Mendes', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20172045050409', '13462426', '20172045050409.jpg', '(85) 98101-422', 'webstervictor5@gmail.com', NULL, NULL, '2019-10-08 13:15:18', '2019-10-09 18:02:57', '2019-10-09 18:02:57'),
(31, 'Gabriel Augusto Gomes Da Silva', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20182045050260', '4653272', '20182045050260.jpg', '(85) 98101-422', 'gabrielaugusto753@gmail.com', NULL, NULL, '2019-10-09 17:03:17', '2019-10-09 17:03:17', '2019-10-24 03:00:00'),
(32, 'Joao Victor De Melo Barros', 'Aluno', 'Bacharelado Em Ciência Da Computação', '20182045050309', '5263250', '20182045050309.jpg', '(85) 92555-8745', 'joaovictor107543210@hotmail.com', NULL, NULL, '2019-10-09 17:03:46', '2019-10-09 17:03:46', '2019-10-17 03:00:00'),
(34, 'Emerson Henrique Oliveira De Araujo', 'Aluno', 'Bacharelado Em Ciência Da Computação', '2239943', '6701243', '2239943.jpg', '(85) 46564-5645', 'emerson.ndl@gmail.com', NULL, NULL, '2019-10-10 14:39:48', '2019-10-10 14:39:58', '2019-10-10 14:39:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_19_102433_criar_tabela_condutores', 1),
(4, '2019_02_19_103001_create_veiculos_table', 1),
(5, '2019_02_19_103020_create_transitos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `raspberry`
--

CREATE TABLE `raspberry` (
  `id_raspberry` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `data_de_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_atualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `raspberry`
--

INSERT INTO `raspberry` (`id_raspberry`, `nome`, `ip`, `status`, `data_de_criacao`, `ultima_atualizacao`, `id_tipo`) VALUES
(27, 'Cancela Entrada', '10.50.12.103', 1, '2019-09-12 09:22:38', '2019-10-02 15:42:40', 2),
(28, 'Câmera saida', '10.50.12.101', 1, '2019-09-12 09:48:49', '2019-10-02 15:42:50', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_raspberry`
--

CREATE TABLE `tipo_raspberry` (
  `id_tipo_rasp` int(11) NOT NULL,
  `nome_tipo_rasp` varchar(45) COLLATE utf8_swedish_ci NOT NULL,
  `attr` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `tipo_raspberry`
--

INSERT INTO `tipo_raspberry` (`id_tipo_rasp`, `nome_tipo_rasp`, `attr`) VALUES
(1, 'Saída', 'saida'),
(2, 'Entrada', 'entrada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_transito`
--

CREATE TABLE `tipo_transito` (
  `id_tipo_transito` int(11) NOT NULL,
  `descricao_tipo_transito` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `tipo_transito`
--

INSERT INTO `tipo_transito` (`id_tipo_transito`, `descricao_tipo_transito`) VALUES
(1, 'Todos'),
(2, 'Entrada'),
(3, 'Saida');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transito`
--

CREATE TABLE `transito` (
  `transito_id` int(10) UNSIGNED NOT NULL,
  `veiculo_id` int(10) UNSIGNED DEFAULT NULL,
  `condutor_id` int(10) UNSIGNED NOT NULL,
  `id_tipo_transito_fk` int(10) NOT NULL,
  `data_de_criacao` timestamp NULL DEFAULT NULL,
  `ultima_atualizacao` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `transito`
--

INSERT INTO `transito` (`transito_id`, `veiculo_id`, `condutor_id`, `id_tipo_transito_fk`, `data_de_criacao`, `ultima_atualizacao`) VALUES
(309, 17, 22, 3, '2019-10-10 12:51:29', '2019-10-10 12:51:29'),
(310, 17, 22, 2, '2019-10-10 13:49:07', '2019-10-10 13:49:07'),
(311, 16, 22, 2, '2019-10-10 13:59:45', '2019-10-10 13:59:45'),
(312, 19, 21, 2, '2019-10-10 14:00:49', '2019-10-10 14:00:49'),
(313, NULL, 21, 2, '2019-10-11 14:29:33', '2019-10-11 14:29:33'),
(314, NULL, 21, 2, '2019-10-11 14:29:55', '2019-10-11 14:29:55'),
(315, NULL, 21, 2, '2019-10-11 14:30:10', '2019-10-11 14:30:10'),
(316, NULL, 21, 2, '2019-10-11 14:30:19', '2019-10-11 14:30:19'),
(317, NULL, 21, 2, '2019-10-11 14:34:35', '2019-10-11 14:34:35'),
(318, NULL, 21, 2, '2019-10-11 14:34:58', '2019-10-11 14:34:58'),
(319, NULL, 21, 2, '2019-10-11 14:35:01', '2019-10-11 14:35:01'),
(320, NULL, 21, 2, '2019-10-11 14:35:04', '2019-10-11 14:35:04'),
(321, NULL, 21, 2, '2019-10-11 14:35:14', '2019-10-11 14:35:14'),
(322, NULL, 21, 2, '2019-10-11 14:35:37', '2019-10-11 14:35:37'),
(323, NULL, 21, 2, '2019-10-11 14:35:58', '2019-10-11 14:35:58'),
(324, NULL, 21, 2, '2019-10-11 14:37:43', '2019-10-11 14:37:43'),
(325, NULL, 21, 3, '2019-10-11 14:38:02', '2019-10-11 14:38:02'),
(326, NULL, 21, 3, '2019-10-11 14:42:16', '2019-10-11 14:42:16'),
(327, NULL, 21, 3, '2019-10-11 14:42:43', '2019-10-11 14:42:43'),
(328, NULL, 21, 3, '2019-10-11 14:43:00', '2019-10-11 14:43:00'),
(329, NULL, 21, 3, '2019-10-11 14:43:33', '2019-10-11 14:43:33'),
(330, NULL, 21, 3, '2019-10-11 14:45:00', '2019-10-11 14:45:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `veiculo_id` int(10) UNSIGNED NOT NULL,
  `condutor_id` int(10) UNSIGNED NOT NULL,
  `tipo_veiculo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int(4) NOT NULL,
  `img_veiculo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'image.png',
  `data_de_criacao` timestamp NULL DEFAULT NULL,
  `ultima_atualizacao` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`veiculo_id`, `condutor_id`, `tipo_veiculo`, `placa`, `marca`, `modelo`, `ano`, `img_veiculo`, `data_de_criacao`, `ultima_atualizacao`) VALUES
(16, 21, 'Carro', 'KEL-5556', 'GOL', 'ALGUM AI', 2018, 'carro_tony.jpg', '2019-09-05 03:00:00', '2019-09-06 03:00:00'),
(17, 23, 'Carro', 'KEL-5556', 'GOL', 'ALGUM AI', 2018, 'image.png', '2019-10-05 03:00:00', '2019-10-05 03:00:00'),
(18, 28, 'Carro', 'ghfghg', 'hgfghghfgf', 'fgghgghf', 2018, 'image.png', NULL, NULL),
(19, 29, 'Carro', 'KEL-5556', 'GOL', 'ALGUM AI', 2018, 'image.png', '2019-09-05 03:00:00', '2019-09-26 03:00:00'),
(20, 26, 'Carro', 'KEL-5556', 'GOL', 'ALGUM AI', 2018, 'image.png', '2019-10-11 03:00:00', '2019-10-16 03:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `condutor`
--
ALTER TABLE `condutor`
  ADD PRIMARY KEY (`condutor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `raspberry`
--
ALTER TABLE `raspberry`
  ADD PRIMARY KEY (`id_raspberry`),
  ADD KEY `fk_raspberry_id_idx` (`id_tipo`);

--
-- Indexes for table `tipo_raspberry`
--
ALTER TABLE `tipo_raspberry`
  ADD PRIMARY KEY (`id_tipo_rasp`);

--
-- Indexes for table `tipo_transito`
--
ALTER TABLE `tipo_transito`
  ADD PRIMARY KEY (`id_tipo_transito`);

--
-- Indexes for table `transito`
--
ALTER TABLE `transito`
  ADD PRIMARY KEY (`transito_id`),
  ADD KEY `transitos_id_veiculo_foreign` (`veiculo_id`),
  ADD KEY `tipo_transito_fk_idx` (`id_tipo_transito_fk`),
  ADD KEY `condutor_id` (`condutor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`veiculo_id`),
  ADD KEY `veiculos_id_condutores_foreign` (`condutor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condutor`
--
ALTER TABLE `condutor`
  MODIFY `condutor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `raspberry`
--
ALTER TABLE `raspberry`
  MODIFY `id_raspberry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tipo_raspberry`
--
ALTER TABLE `tipo_raspberry`
  MODIFY `id_tipo_rasp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo_transito`
--
ALTER TABLE `tipo_transito`
  MODIFY `id_tipo_transito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transito`
--
ALTER TABLE `transito`
  MODIFY `transito_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `veiculo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `raspberry`
--
ALTER TABLE `raspberry`
  ADD CONSTRAINT `fk_id_raspberry_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_raspberry` (`id_tipo_rasp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `transito`
--
ALTER TABLE `transito`
  ADD CONSTRAINT `condutor_id_fk` FOREIGN KEY (`condutor_id`) REFERENCES `condutor` (`condutor_id`),
  ADD CONSTRAINT `tipo_transito_fk` FOREIGN KEY (`id_tipo_transito_fk`) REFERENCES `tipo_transito` (`id_tipo_transito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transito_ibfk_1` FOREIGN KEY (`condutor_id`) REFERENCES `condutor` (`condutor_id`),
  ADD CONSTRAINT `transitos_id_veiculo_foreign` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculo` (`veiculo_id`);

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `veiculos_id_condutores_foreign` FOREIGN KEY (`condutor_id`) REFERENCES `condutor` (`condutor_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
