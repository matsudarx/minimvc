SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `permissions_folder`;
CREATE TABLE `permissions_folder` (
  `id_folder` int(11) NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(20) NOT NULL,
  `folder_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_folder`),
  UNIQUE KEY `id_folder` (`id_folder`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `permissions_type`;
CREATE TABLE `permissions_type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) NOT NULL,
  `type_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_type`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `permissions_group`;
CREATE TABLE `permissions_group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(200) NOT NULL,
  `group_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_group`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `permissions_user`;
CREATE TABLE `permissions_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_group_user_name` (`id_group`,`user_name`),
  CONSTRAINT `permissions_user_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `permissions_group` (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `permissions_app`;
CREATE TABLE `permissions_app` (
  `id_app` int(11) NOT NULL AUTO_INCREMENT,
  `id_folder` int(11) NOT NULL,
  `app_rack` varchar(200) NOT NULL,
  `app_folder` varchar(200) NOT NULL,
  `app_file` varchar(200) NOT NULL,
  `app_name` varchar(200) NOT NULL,
  `app_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_app`),
  UNIQUE KEY `id_folder_app_rack_app_folder_app_file_app_name` (`id_folder`,`app_rack`,`app_folder`,`app_file`,`app_name`),
  CONSTRAINT `permissions_app_ibfk_1` FOREIGN KEY (`id_folder`) REFERENCES `permissions_folder` (`id_folder`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `permissions_access`;
CREATE TABLE `permissions_access` (
  `id_access` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_app` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `access_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_access`),
  UNIQUE KEY `id_user_id_app_id_type` (`id_user`,`id_app`,`id_type`),
  KEY `id_user` (`id_user`),
  KEY `id_app` (`id_app`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `permissions_access_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `permissions_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permissions_access_ibfk_2` FOREIGN KEY (`id_app`) REFERENCES `permissions_app` (`id_app`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permissions_access_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `permissions_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
SET FOREIGN_KEY_CHECKS=1;
