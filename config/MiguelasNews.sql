-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.11-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para miguelas_news
CREATE DATABASE IF NOT EXISTS `miguelas_news` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `miguelas_news`;

-- Copiando estrutura para tabela miguelas_news.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_categoria` varchar(50) NOT NULL,
  `url_categoria` varchar(150) NOT NULL,
  `imagem_categoria` varchar(150) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela miguelas_news.categoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id_categoria`, `descricao_categoria`, `url_categoria`, `imagem_categoria`) VALUES
	(1, 'POLITICA', 'www.politica.com.br', 'imagens/politica'),
	(2, 'EDUCACAO', 'www.educacao.com.br', 'imagens/educacao'),
	(3, 'ESPORTE', 'www.esporte.com.br', 'imagens/esporte'),
	(4, 'LAZER', 'www.lazer.com.br', 'imagens/lazer');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela miguelas_news.noticias
CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticias` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `titulo_noticia` varchar(150) NOT NULL,
  `descricao_noticia` text NOT NULL,
  `autor_noticia` varchar(150) DEFAULT 'Desconhecido',
  `data_noticia` date NOT NULL,
  `image_noticia` varchar(150) DEFAULT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_noticias`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela miguelas_news.noticias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` (`id_noticias`, `id_categoria`, `titulo_noticia`, `descricao_noticia`, `autor_noticia`, `data_noticia`, `image_noticia`, `ativo`) VALUES
	(1, 4, 'Prefeitura divulga a programação oficial do carnaval de Miguel Alves', 'A Prefeitura Municipal de Miguel Alves, divulgou a programação oficial do carnaval, nos dias 22, 23, 24 e 25 de fevereiro, na Praça Enéas Torres. Confira as bandas:Gil Mendes, Pé de Ouro, Chikaê, Minamora, Júnior Mourão, Léo Cachorrão, Donna Fulô, Junior Masca e a Japa', 'SECOM', '2020-02-19', 'img/noticias/1582137020_carnaval miguel alves.jpeg', 0),
	(2, 2, 'Escola Família Agrícola será reformada e ampliada', 'O prefeito de Miguel Alves, Oliveira Junior, assinou a Ordem de Serviço para a reforma e ampliação da Escola Família Agrícola da localidade Conrado.  ', 'SECOM', '2020-02-19', 'img/noticias/1582137191_prefeito.jpg', 0),
	(3, 1, 'Miguel Alves está entre as cidades com FPM bloqueado no PI', 'A Secretaria do Tesouro Nacional (STN) divulgou nessa segunda-feira (18) a relação das cidades que estão com o Fundo de Participação dos Municípios (F', 'Desconhecido', '2020-02-19', 'img/noticias/1582137318_Oliveira jr.jpg', 0),
	(4, 2, 'Miguel Alves | Jornada Pedagógica 2020', ' A Secretaria de Educação de Miguel Alves deu início na manhã desta terça-feira (11/02), a sua Jornada Pedagógica como parte dos preparativos para a a', 'SECOM', '2020-02-19', 'img/noticias/1582137768_encontroPedagogico.jpg', 0);
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
