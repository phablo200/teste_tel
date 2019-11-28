DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(30) DEFAULT NULL,
  `rg` varchar(30) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT NULL,
  `id_usuarios_cadastrou` int(11) DEFAULT NULL,
  `id_usuarios_atualizou` int(11) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `local_nascimento` varchar(2) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `cliente_telefone`;
CREATE TABLE `cliente_telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) NOT NULL DEFAULT '',
  `remember_token` text,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);


