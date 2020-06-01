-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31-Maio-2020 às 18:48
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tidder`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `comment` text NOT NULL,
  `upvote` int(10) DEFAULT NULL,
  `downvote` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `upvote` int(10) DEFAULT NULL,
  `downvote` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `iduser`, `title`, `content`, `date`, `upvote`, `downvote`) VALUES
(1, 1, 'Teste1', 'wqreqweasdadasdasdadasdasdasdas', '2020-05-20 12:00:00', NULL, NULL),
(2, 1, 'Teste2', 'wqreqweasdadasdasdadasdasdasdas', '2020-05-20 13:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'nelson', 'nelson@mail.com', 123),
(2, 'nelson', 'nelson@mail.com', 123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `votecomments`
--

CREATE TABLE `votecomments` (
  `idvote` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcomment` int(11) NOT NULL,
  `vote` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `voteposts`
--

CREATE TABLE `voteposts` (
  `idvote` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `vote` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `voteposts`
--

INSERT INTO `voteposts` (`idvote`, `iduser`, `idpost`, `vote`) VALUES
(78, 1, 2, 1),
(79, 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_post_comment` (`idpost`),
  ADD KEY `FK_user_comment` (`iduser`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_post` (`iduser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votecomments`
--
ALTER TABLE `votecomments`
  ADD PRIMARY KEY (`idvote`),
  ADD KEY `FK_comments_votes` (`idcomment`),
  ADD KEY `FK_user_votes` (`iduser`);

--
-- Indexes for table `voteposts`
--
ALTER TABLE `voteposts`
  ADD PRIMARY KEY (`idvote`),
  ADD KEY `FK_users_voteposts` (`iduser`),
  ADD KEY `FK_posts_voteposts` (`idpost`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votecomments`
--
ALTER TABLE `votecomments`
  MODIFY `idvote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voteposts`
--
ALTER TABLE `voteposts`
  MODIFY `idvote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_post_comment` FOREIGN KEY (`idpost`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `FK_user_comment` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_user_post` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `votecomments`
--
ALTER TABLE `votecomments`
  ADD CONSTRAINT `FK_comments_votes` FOREIGN KEY (`idcomment`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `FK_user_votes` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
