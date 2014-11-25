create database bdphp default character set utf8 collate utf8_unicode_ci;
grant all on bdphp.* to userphp@localhost identified by 'clavephp';
flush privileges;

use bdphp;

CREATE TABLE IF NOT EXISTS `producto` (
	`id` int(11) NOT NULL primary key auto_increment,
  `nombre` varchar(30) DEFAULT NULL,
  `precio` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB;


INSERT INTO `producto` (`id`, `nombre`, `precio`) VALUES
(1, 'cpu', '64.3500'),
(2, 'dd 500gb', '54.3500'),
(3, 'ram 4gb', '34.3500');


CREATE TABLE IF NOT EXISTS `persona` (
    `id` int NOT NULL primary key auto_increment,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
    unique(nombre,apellidos)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `usuario` (
    `login` varchar(30) NOT NULL primary key,
    `clave` varchar(40) NOT NULL,  
    `nombre` varchar(30) NOT NULL,  
    `apellidos` varchar(60) NOT NULL,  
    `email` varchar(40) NOT NULL,
    `fechaalta` date NOT NULL,
    `isactivo` tinyint(1) NOT NULL,
    `isroot` tinyint(1) NOT NULL DEFAULT 0,
    `rol` enum('administrador', 'usuario') NOT NULL DEFAULT 'usuario',
    `fechalogin` datetime    
) ENGINE=InnoDB;