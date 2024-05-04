-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour musclemind
CREATE DATABASE IF NOT EXISTS `musclemind` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `musclemind`;

-- Listage de la structure de table musclemind. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. exercice
CREATE TABLE IF NOT EXISTS `exercice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `target_id` int NOT NULL,
  `secondary_target_id` int DEFAULT NULL,
  `exercice_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exercice_function` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E418C74D158E0B66` (`target_id`),
  KEY `IDX_E418C74D8AAA4E1F` (`secondary_target_id`),
  CONSTRAINT `FK_E418C74D158E0B66` FOREIGN KEY (`target_id`) REFERENCES `muscle` (`id`),
  CONSTRAINT `FK_E418C74D8AAA4E1F` FOREIGN KEY (`secondary_target_id`) REFERENCES `muscle` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. muscle
CREATE TABLE IF NOT EXISTS `muscle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_group_id` int NOT NULL,
  `muscle_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `muscle_function` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F31119EF44004D0` (`muscle_group_id`),
  CONSTRAINT `FK_F31119EF44004D0` FOREIGN KEY (`muscle_group_id`) REFERENCES `muscle_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. muscle_group
CREATE TABLE IF NOT EXISTS `muscle_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. performance
CREATE TABLE IF NOT EXISTS `performance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_performing_id` int NOT NULL,
  `exercice_mesured_id` int NOT NULL,
  `personnal_record` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_82D79681208EA2D0` (`user_performing_id`),
  KEY `IDX_82D7968183E21899` (`exercice_mesured_id`),
  CONSTRAINT `FK_82D79681208EA2D0` FOREIGN KEY (`user_performing_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_82D7968183E21899` FOREIGN KEY (`exercice_mesured_id`) REFERENCES `exercice` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `creator_id` int NOT NULL,
  `muscle_group_targeted_id` int NOT NULL,
  `secondary_muscle_group_targeted_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92ED778461220EA6` (`creator_id`),
  KEY `IDX_92ED77841B45C4A5` (`muscle_group_targeted_id`),
  KEY `IDX_92ED7784C3FDACF4` (`secondary_muscle_group_targeted_id`),
  CONSTRAINT `FK_92ED77841B45C4A5` FOREIGN KEY (`muscle_group_targeted_id`) REFERENCES `muscle_group` (`id`),
  CONSTRAINT `FK_92ED778461220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_92ED7784C3FDACF4` FOREIGN KEY (`secondary_muscle_group_targeted_id`) REFERENCES `muscle_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. ressources
CREATE TABLE IF NOT EXISTS `ressources` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program_id` int NOT NULL,
  `date_session` datetime NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D43EB8070A` (`program_id`),
  KEY `IDX_D044D5D4A76ED395` (`user_id`),
  CONSTRAINT `FK_D044D5D43EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  CONSTRAINT `FK_D044D5D4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. tracking
CREATE TABLE IF NOT EXISTS `tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_tracked_id` int NOT NULL,
  `height` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` smallint DEFAULT NULL,
  `date_of_tracking` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A87C621CDDA0EDA4` (`user_tracked_id`),
  CONSTRAINT `FK_A87C621CDDA0EDA4` FOREIGN KEY (`user_tracked_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table musclemind. workout_plan
CREATE TABLE IF NOT EXISTS `workout_plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercice_id` int NOT NULL,
  `program_id` int DEFAULT NULL,
  `number_of_repetitions` int NOT NULL,
  `weights_used` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A5D4580189D40298` (`exercice_id`),
  KEY `IDX_A5D458013EB8070A` (`program_id`),
  CONSTRAINT `FK_A5D458013EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  CONSTRAINT `FK_A5D4580189D40298` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
