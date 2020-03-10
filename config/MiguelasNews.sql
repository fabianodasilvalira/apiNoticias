-- BD: renzoramos_desif_manager
-- USER: renzoramos_desif_super (#desif!super8663)
-- renzoramos_desif_user (DESIF$User#8663)

SET GLOBAL lc_time_names=pt_BR;
SET GLOBAL lc_messages=pt_BR;

-- DROP DATABASE desif_manager;
CREATE DATABASE IF NOT EXISTS `miguelas_news`
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE `miguelas_news`;

CREATE TABLE IF NOT EXISTS `user`(
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
    `username` VARCHAR(255) NOT NULL COMMENT 'User Name' ,
    `email` VARCHAR(255) NOT NULL COMMENT 'e-mail' ,
    `name` varchar(255) COMMENT 'Nome',
    `phone` varchar(20) COMMENT 'Telefone',
    `perfil` enum ('Super Sayajin', 'Administrador', 'Moderador', 'Noticiarista', 'Usuário') DEFAULT 'Usuário',
    `auth_key` VARCHAR(32) NOT NULL ,
    `password_hash` VARCHAR(255) NOT NULL ,
    `password_reset_token` VARCHAR(255) NULL DEFAULT NULL ,
    `status` SMALLINT NOT NULL DEFAULT '5' , #(0 - Inativo; 5 - Adicionado; 10 - Homologado)
    `created_at` int(11) NOT NULL,
    `updated_at` int(11) NOT NULL,
    `dt_in` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `dt_up` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `permissions` MEDIUMTEXT NULL DEFAULT NULL , #[user=>[add, del, edit, list]]
    `logs` MEDIUMTEXT NULL DEFAULT NULL , #{"log" [{ "inserted" : "dd/mm/yyyy h:m:s", "user" : id_user}, {"updated" : "..." }]}

    PRIMARY KEY (`id`), 
    INDEX `password_reset_token` (`password_reset_token`),
    INDEX `email` (`email`),
    UNIQUE `username` (`username`)
);

-- Copiando estrutura para tabela miguelas_news.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nome` varchar(100) NOT NULL,
    `descricao` TEXT NULL DEFAULT NULL,

    `id_user` int NOT NULL,
    `status` SMALLINT NOT NULL DEFAULT '5' , #(0 - Inativo; 5 - Adicionado; 10 - Homologado)
    `dt_in` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `dt_up` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `logs` MEDIUMTEXT NULL DEFAULT NULL , #{"log" [{ "inserted" : "dd/mm/yyyy h:m:s", "user" : id_user}, {"updated" : "..." }]}

    PRIMARY KEY (`id`),
    #FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    INDEX `nome` (`nome`)
);

-- Copiando estrutura para tabela miguelas_news.noticias
CREATE TABLE IF NOT EXISTS `noticia` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_categoria` int(11) NOT NULL,
    `titulo` varchar(255) NOT NULL,
    `corpo` text NOT NULL,
    `fonte_nm` varchar(100) COMMENT 'Nome da fonte da notícia, se não for própria',
    `fonte_url` varchar(255) COMMENT 'URL da fonte da notícia, se não for própria',
    `dt_publicacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    `id_user` int NOT NULL,
    `status` SMALLINT NOT NULL DEFAULT '5' , #(0 - Inativo; 5 - Adicionado; 10 - Homologado)
    `dt_in` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `dt_up` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `logs` MEDIUMTEXT NULL DEFAULT NULL , #{"log" [{ "inserted" : "dd/mm/yyyy h:m:s", "user" : id_user}, {"updated" : "..." }]}

    PRIMARY KEY (`id`),
    #FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (`id_categoria`) REFERENCES `categoria`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS `comentario`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_user` int(11) NOT NULL,
    `mensagem` MEDIUMTEXT NOT NULL, #smille, sad, like, deslike...
    `objeto` varchar(20) NOT NULL COMMENT 'Nome da Class ao qual pertence', #(Comentario; Noticia)
    `id_objeto` int(11) NOT NULL COMMENT 'Referenciar o id de Comentário ou de Notícia',

    `status` SMALLINT NOT NULL DEFAULT '5' , #(0 - Inativo; 5 - Adicionado; 10 - Homologado)
    `dt_in` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `dt_up` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `logs` MEDIUMTEXT NULL DEFAULT NULL , #{"log" [{ "inserted" : "dd/mm/yyyy h:m:s", "user" : id_user}, {"updated" : "..." }]}

    PRIMARY KEY (`id`)
    #FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS `imagem`(
    `nome` varchar(150) NOT NULL,
    `path` varchar(255) NOT NULL,
    `titulo` varchar(255),
    `descricao` varchar(255),
    `fonte_nm` varchar(100) COMMENT 'Nome da fonte da imagem, se não for própria',
    `fonte_url` varchar(255) COMMENT 'URL da fonte da imagem, se não for própria',

    `objeto` SMALLINT NOT NULL COMMENT 'Nome da Class ao qual pertence', #(Categoria; Noticia)
    `id_objeto` int(11) NOT NULL COMMENT 'Referenciar o id de Categoria ou de Notícia',

    `id_user` int NOT NULL,
    `status` SMALLINT NOT NULL DEFAULT '5' , #(0 - Inativo; 5 - Adicionado; 10 - Homologado)
    `dt_in` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `dt_up` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `logs` MEDIUMTEXT NULL DEFAULT NULL , #{"log" [{ "inserted" : "dd/mm/yyyy h:m:s", "user" : id_user}, {"updated" : "..." }]}

    PRIMARY KEY (`nome`)
    #FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS `reacao`(
    `id_user` int(11) NOT NULL,
    `reacao` varchar(50) NOT NULL, #smille, sad, like, deslike...
    `objeto` SMALLINT NOT NULL COMMENT 'Nome da Class ao qual pertence', #(Comentario; Noticia)
    `id_objeto` int(11) NOT NULL COMMENT 'Referenciar o id de Comentário ou de Notícia'

    #FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);