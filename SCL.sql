-- --------------------------------------------------------
-- Servidor:                     10.5.90.139
-- Versão do servidor:           10.1.48-MariaDB-0ubuntu0.18.04.1 - Ubuntu 18.04
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              11.2.0.6251
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_zabbix
CREATE DATABASE IF NOT EXISTS `db_zabbix` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_zabbix`;

-- Copiando estrutura para tabela db_zabbix.disponibilidade_auto_ce
CREATE TABLE IF NOT EXISTS `disponibilidade_auto_ce` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `DATA` date DEFAULT NULL,
  `Equipamento` varchar(48) DEFAULT NULL,
  `Disponibilidade` float DEFAULT NULL,
  `IP` varchar(24) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `Operadora` varchar(12) DEFAULT NULL,
  `ativo_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=297726 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para view db_zabbix.FGT_Fora
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `FGT_Fora` (
	`HOST` VARCHAR(128) NOT NULL COLLATE 'utf8_bin',
	`UF` VARCHAR(128) NOT NULL COLLATE 'utf8_bin',
	`falha` DATE NULL,
	`eventid` BIGINT(20) UNSIGNED NOT NULL
) ENGINE=MyISAM;

-- Copiando estrutura para tabela db_zabbix.justificativa
CREATE TABLE IF NOT EXISTS `justificativa` (
  `eventid` bigint(20) unsigned NOT NULL,
  `justificativa1` varchar(50) NOT NULL DEFAULT '',
  `justificativa2` varchar(50) NOT NULL DEFAULT '',
  `Detalhamento` text NOT NULL,
  `edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ativo` int(11) DEFAULT '1',
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_zabbix.log_falhas
CREATE TABLE IF NOT EXISTS `log_falhas` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `HOST` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` varchar(2048) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `eventid` bigint(20) unsigned NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `objectid` bigint(20) unsigned NOT NULL,
  `fail` int(11) NOT NULL DEFAULT '0',
  `r_eventid` bigint(20) unsigned DEFAULT NULL,
  `clear` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `groupid` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=281289 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para procedure db_zabbix.update_less
DELIMITER //
CREATE PROCEDURE `update_less`()
BEGIN
update disponibilidade_auto_ce SET Disponibilidade = 1 WHERE Disponibilidade < 1 AND Disponibilidade >= 0.979166667 AND DATA >= '2021-06-01' AND ativo_in = 1;
END//
DELIMITER ;

-- Copiando estrutura para view db_zabbix.FGT_Fora
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `FGT_Fora`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `db_zabbix`.`FGT_Fora` AS select `db_zabbix`.`log_falhas`.`HOST` AS `HOST`,substring_index(substring_index(`db_zabbix`.`log_falhas`.`HOST`,'_',2),'_',-(1)) AS `UF`,cast(from_unixtime(`db_zabbix`.`log_falhas`.`fail`) as date) AS `falha`,`db_zabbix`.`log_falhas`.`eventid` AS `eventid` from `db_zabbix`.`log_falhas` where ((`db_zabbix`.`log_falhas`.`name` = 'ICMP Ping Indisponível') and (`db_zabbix`.`log_falhas`.`groupid` = 41) and (`db_zabbix`.`log_falhas`.`r_eventid` is not null) and (`db_zabbix`.`log_falhas`.`time` > 14400));


-- Copiando estrutura do banco de dados para inventario
CREATE DATABASE IF NOT EXISTS `inventario` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `inventario`;

-- Copiando estrutura para tabela inventario.comandos
CREATE TABLE IF NOT EXISTS `comandos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_command` varchar(50) DEFAULT NULL,
  `command` text,
  `edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.email_TB
CREATE TABLE IF NOT EXISTS `email_TB` (
  `ID_email` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT '0',
  PRIMARY KEY (`ID_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.horas_sobreaviso
CREATE TABLE IF NOT EXISTS `horas_sobreaviso` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `p1inicio` time DEFAULT NULL,
  `p1fim` time DEFAULT NULL,
  `p2inicio` time DEFAULT NULL,
  `p2fim` time DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.last_login
CREATE TABLE IF NOT EXISTS `last_login` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cod_user` varchar(50) NOT NULL DEFAULT '0',
  `parametro` int(11) NOT NULL DEFAULT '0',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `penultimo` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `cod_user` (`cod_user`),
  CONSTRAINT `FK_last_login_user` FOREIGN KEY (`cod_user`) REFERENCES `user` (`cod`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.linkzabbix_scl
CREATE TABLE IF NOT EXISTS `linkzabbix_scl` (
  `ID` int(11) NOT NULL,
  `hostid` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `hostid` (`hostid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.link_hapvida
CREATE TABLE IF NOT EXISTS `link_hapvida` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_unidade` int(11) DEFAULT NULL,
  `user_l` varchar(50) DEFAULT NULL,
  `edit_l` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `operadora` varchar(50) DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `velocidade` varchar(50) DEFAULT NULL,
  `circuito` varchar(50) DEFAULT NULL,
  `propria` varchar(50) DEFAULT NULL,
  `ativo` varchar(10) NOT NULL DEFAULT 'S',
  `SDWAN` varchar(10) NOT NULL DEFAULT 'N',
  `ip_link` varchar(50) DEFAULT NULL,
  `subnetwork` varchar(50) DEFAULT NULL,
  `firewall` varchar(50) DEFAULT NULL,
  `ip_firewall` varchar(50) DEFAULT NULL,
  `interface` varchar(50) DEFAULT NULL,
  `ip_operadora` varchar(50) DEFAULT NULL,
  `id_concentrador` varchar(50) DEFAULT NULL,
  `data_ativação` date DEFAULT NULL,
  `data_cancelamento` date DEFAULT NULL,
  `descricao_l` text,
  `visivel_l` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `ID_unidade` (`ID_unidade`),
  CONSTRAINT `unidadeschave` FOREIGN KEY (`ID_unidade`) REFERENCES `unidade_hapvida` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5473 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.link_hapvida_trash
CREATE TABLE IF NOT EXISTS `link_hapvida_trash` (
  `unitID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID` int(11) NOT NULL DEFAULT '0',
  `ID_unidade` int(11) DEFAULT NULL,
  `operadora` varchar(50) DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `velocidade` varchar(50) DEFAULT NULL,
  `circuito` varchar(50) DEFAULT NULL,
  `propria` varchar(50) DEFAULT NULL,
  `ativo` varchar(10) NOT NULL DEFAULT 'S',
  `SDWAN` varchar(10) NOT NULL DEFAULT 'N',
  `ip_link` varchar(50) DEFAULT NULL,
  `subnetwork` varchar(50) DEFAULT NULL,
  `firewall` varchar(50) DEFAULT NULL,
  `ip_firewall` varchar(50) DEFAULT NULL,
  `interface` varchar(50) DEFAULT NULL,
  `ip_operadora` varchar(50) DEFAULT NULL,
  `id_concentrador` varchar(50) DEFAULT NULL,
  `data_ativação` date DEFAULT NULL,
  `data_cancelamento` date DEFAULT NULL,
  `descricao_l` text,
  `visivel_l` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`unitID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.OS_TB
CREATE TABLE IF NOT EXISTS `OS_TB` (
  `IDOS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_unidade` int(11) DEFAULT NULL,
  `servico` varchar(50) DEFAULT NULL,
  `operadora` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `velocidade` int(11) DEFAULT NULL,
  `circuito` varchar(50) DEFAULT NULL,
  `redepropia` varchar(3) DEFAULT NULL,
  `dataativacao` date DEFAULT NULL,
  `acionamentoadm` date DEFAULT NULL,
  `requisicao` varchar(50) DEFAULT NULL,
  `retornoadm` date DEFAULT NULL,
  `acionamentosupply` date DEFAULT NULL,
  `retornosupply` date DEFAULT NULL,
  `pedido` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `previsaodaarea` date DEFAULT NULL,
  `datadaentrega` date DEFAULT NULL,
  `prazoinstalacao` date DEFAULT NULL,
  `iniciooperacao` date DEFAULT NULL,
  `chamadootrs` varchar(50) DEFAULT NULL,
  `aberturaotrs` date DEFAULT NULL,
  `encerramentootrs` date DEFAULT NULL,
  `solicitanteotrs` varchar(50) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `pendencia` varchar(255) DEFAULT NULL,
  `ID_email` int(11) DEFAULT NULL,
  `change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDOS`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.sobreaviso
CREATE TABLE IF NOT EXISTS `sobreaviso` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` varchar(50) DEFAULT NULL,
  `PONTO` timestamp NULL DEFAULT NULL,
  `INPUT` int(2) DEFAULT NULL,
  `OBS` text,
  `VALIDADO` varchar(2) NOT NULL DEFAULT 'N',
  `TIPO` int(2) DEFAULT '1',
  `PAI` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_sobreaviso_horas_sobreaviso` (`TIPO`),
  KEY `FK_sobreaviso_user` (`ID_USER`),
  CONSTRAINT `FK_sobreaviso_horas_sobreaviso` FOREIGN KEY (`TIPO`) REFERENCES `horas_sobreaviso` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sobreaviso_user` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.unidade_hapvida
CREATE TABLE IF NOT EXISTS `unidade_hapvida` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `unidade` varchar(50) DEFAULT NULL,
  `apelido_u` varchar(50) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `N` varchar(8) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `CEP` varchar(11) DEFAULT NULL,
  `endereco2` varchar(255) DEFAULT NULL,
  `N2` varchar(8) DEFAULT NULL,
  `bairro2` varchar(50) DEFAULT NULL,
  `complemento2` varchar(50) DEFAULT NULL,
  `CEP2` varchar(11) DEFAULT NULL,
  `ativo` varchar(10) DEFAULT 'S',
  `categoria` varchar(50) DEFAULT NULL,
  `visivel_u` int(2) NOT NULL DEFAULT '1',
  `descricao_u` text,
  `user_u` varchar(11) DEFAULT NULL,
  `edit_u` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.unidade_hapvida_trash
CREATE TABLE IF NOT EXISTS `unidade_hapvida_trash` (
  `unitID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID` int(11) NOT NULL DEFAULT '0',
  `unidade` varchar(50) DEFAULT NULL,
  `apelido_u` varchar(50) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `N` varchar(8) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `CEP` varchar(11) DEFAULT NULL,
  `endereco2` varchar(255) DEFAULT NULL,
  `N2` varchar(8) DEFAULT NULL,
  `bairro2` varchar(50) DEFAULT NULL,
  `complemento2` varchar(50) DEFAULT NULL,
  `CEP2` varchar(11) DEFAULT NULL,
  `ativo` varchar(10) DEFAULT 'S',
  `categoria` varchar(50) DEFAULT NULL,
  `visivel_u` int(2) NOT NULL DEFAULT '1',
  `descricao_u` text,
  PRIMARY KEY (`unitID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela inventario.user
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `senha` varchar(255) NOT NULL DEFAULT '0000',
  `cod` varchar(50) DEFAULT NULL,
  `ativo` binary(1) NOT NULL DEFAULT '0',
  `telefone` varchar(50) DEFAULT NULL,
  `edicao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `setor` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'user.jpg',
  `tipo` varchar(50) NOT NULL DEFAULT 'User',
  `hash` varchar(255) DEFAULT NULL,
  `estoque` int(1) NOT NULL DEFAULT '0',
  `telecom` int(1) NOT NULL DEFAULT '0',
  `changepass` int(1) NOT NULL DEFAULT '1',
  `admOS` int(1) NOT NULL DEFAULT '0',
  `admLink` int(1) NOT NULL DEFAULT '0',
  `admDisp` int(1) NOT NULL DEFAULT '0',
  `admEscala` int(1) NOT NULL DEFAULT '0',
  `grafAcess` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `cod` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
