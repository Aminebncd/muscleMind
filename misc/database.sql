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

-- Listage des données de la table musclemind.doctrine_migration_versions : ~2 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240413214807', '2024-04-13 21:48:11', 510),
	('DoctrineMigrations\\Version20240413214908', '2024-04-13 21:49:13', 56);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.exercice : ~25 rows (environ)
INSERT INTO `exercice` (`id`, `target_id`, `secondary_target_id`, `exercice_name`, `exercice_function`) VALUES
	(1, 1, NULL, 'Bench Press', 'Targets the pectoralis major'),
	(2, 3, NULL, 'Bent Over Rows', 'Targets the latissimus dorsi and erector spinae'),
	(3, 1, NULL, 'Bicep Curl', 'Targets the biceps'),
	(4, 7, NULL, 'Calf Raises', 'Targets the gastrocnemius and soleus'),
	(5, 1, NULL, 'Chest Fly', 'Targets the pectoralis major'),
	(6, 4, NULL, 'Crunches', 'Targets the rectus abdominis'),
	(7, 3, NULL, 'Deadlifts', 'Targets the latissimus dorsi, erector spinae, and gluteus maximus'),
	(8, 2, NULL, 'Front Raises', 'Targets the deltoid and pectoralis major'),
	(9, 7, NULL, 'Glute Bridge', 'Targets the gluteus maximus'),
	(10, 1, NULL, 'Hammer Curl', 'Targets the biceps and brachialis'),
	(11, 2, NULL, 'Lateral Raises', 'Targets the deltoid'),
	(12, 5, NULL, 'Leg Press', 'Targets the quadriceps and gluteus maximus'),
	(13, 5, NULL, 'Lunges', 'Targets the quadriceps, gluteus maximus, and erector spinae'),
	(14, 2, NULL, 'Military Press', 'Targets the deltoid and triceps brachii'),
	(15, 2, NULL, 'Overhead Tricep Extension', 'Targets the triceps'),
	(16, 4, NULL, 'Planks', 'Targets the transversus abdominis and rectus abdominis'),
	(17, 1, NULL, 'Preacher Curl', 'Targets the biceps'),
	(18, 3, NULL, 'Pull-Ups', 'Targets the latissimus dorsi, biceps brachii, and brachialis'),
	(19, 1, NULL, 'Push-Ups', 'Targets the pectoralis major and triceps brachii'),
	(20, 7, NULL, 'Romanian Deadlifts', 'Targets the hamstrings and erector spinae'),
	(21, 7, NULL, 'Russian Twists', 'Targets the obliques'),
	(22, 6, NULL, 'Shrugs', 'Targets the trapezius and levator scapulae'),
	(23, 2, NULL, 'Skull Crushers', 'Targets the triceps'),
	(24, 3, NULL, 'Squats', 'Targets the quadriceps, hamstrings, and glutes'),
	(25, 2, NULL, 'Tricep Pushdown', 'Targets the triceps');

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

-- Listage des données de la table musclemind.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table musclemind. muscle
CREATE TABLE IF NOT EXISTS `muscle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_group_id` int NOT NULL,
  `muscle_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `muscle_function` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F31119EF44004D0` (`muscle_group_id`),
  CONSTRAINT `FK_F31119EF44004D0` FOREIGN KEY (`muscle_group_id`) REFERENCES `muscle_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.muscle : ~35 rows (environ)
INSERT INTO `muscle` (`id`, `muscle_group_id`, `muscle_name`, `muscle_function`) VALUES
	(1, 1, 'Pectoralis Major', 'Adducts and flexes the arm'),
	(2, 1, 'Pectoralis Minor', 'Stabilizes the scapula and assists in respiration'),
	(3, 4, 'Deltoid', 'Abducts, flexes, extends, and internally rotates the arm'),
	(4, 4, 'Teres Major', 'Assists in extending, adducting, and rotating the arm'),
	(5, 4, 'Supraspinatus', 'Initiates abduction of the arm'),
	(6, 4, 'Infraspinatus', 'Laterally rotates the arm'),
	(7, 4, 'Subscapularis', 'Medially rotates the arm'),
	(8, 5, 'Rhomboids', 'Retracts the scapula and rotates it downward'),
	(9, 5, 'Levator Scapulae', 'Elevates and rotates the scapula'),
	(10, 5, 'Trapezius', 'Elevates, depresses, retracts, and rotates the scapula'),
	(11, 5, 'Latissimus Dorsi', 'Adducts, extends, and internally rotates the arm'),
	(12, 5, 'Serratus Anterior', 'Protracts the scapula and holds it against the rib cage'),
	(13, 6, 'Rectus Abdominis', 'Flexes the spine'),
	(14, 6, 'External Oblique', 'Flexes the spine, laterally flexes the spine, and rotates the trunk'),
	(15, 6, 'Internal Oblique', 'Flexes the spine, laterally flexes the spine, and rotates the trunk'),
	(16, 6, 'Transversus Abdominis', 'Compresses the abdominal contents'),
	(17, 5, 'Erector Spinae', 'Extends and laterally flexes the vertebral column'),
	(18, 5, 'Quadratus Lumborum', 'Laterally flexes the vertebral column and stabilizes the pelvis'),
	(19, 7, 'Gluteus Maximus', 'Extends and laterally rotates the hip joint'),
	(20, 7, 'Gluteus Medius', 'Abducts and medially rotates the thigh'),
	(21, 7, 'Gluteus Minimus', 'Abducts and medially rotates the thigh'),
	(22, 7, 'Psoas Major', 'Flexes the hip joint'),
	(23, 7, 'Iliacus', 'Flexes the hip joint'),
	(24, 7, 'Adductor Magnus', 'Adducts the thigh and assists in flexion and extension of the hip joint'),
	(25, 7, 'Adductor Longus', 'Adducts the thigh and assists in flexion and extension of the hip joint'),
	(26, 7, 'Adductor Brevis', 'Adducts the thigh and assists in flexion and extension of the hip joint'),
	(27, 7, 'Gracilis', 'Adducts the thigh and assists in flexion and extension of the hip joint'),
	(28, 7, 'Sartorius', 'Flexes, abducts, and laterally rotates the thigh and flexes the knee joint'),
	(29, 7, 'Biceps Femoris', 'Flexes the knee joint and extends the hip joint'),
	(30, 7, 'Semitendinosus', 'Flexes the knee joint and extends the hip joint'),
	(31, 7, 'Semimembranosus', 'Flexes the knee joint and extends the hip joint'),
	(32, 7, 'Gastrocnemius', 'Plantar flexes the foot and flexes the knee joint'),
	(33, 7, 'Soleus', 'Plantar flexes the foot'),
	(34, 7, 'Tibialis Anterior', 'Dorsiflexes and inverts the foot'),
	(35, 7, 'Extensor Digitorum Longus', 'Dorsiflexes and extends the toes');

-- Listage de la structure de table musclemind. muscle_group
CREATE TABLE IF NOT EXISTS `muscle_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.muscle_group : ~7 rows (environ)
INSERT INTO `muscle_group` (`id`, `muscle_group`) VALUES
	(1, 'CHEST'),
	(2, 'TRICEPS'),
	(3, 'BICEPS'),
	(4, 'SHOULDERS'),
	(5, 'BACK'),
	(6, 'ABS'),
	(7, 'LEGS');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.performance : ~1 rows (environ)
INSERT INTO `performance` (`id`, `user_performing_id`, `exercice_mesured_id`, `personnal_record`) VALUES
	(1, 1, 1, '110');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.program : ~0 rows (environ)

-- Listage de la structure de table musclemind. ressources
CREATE TABLE IF NOT EXISTS `ressources` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.ressources : ~3 rows (environ)
INSERT INTO `ressources` (`id`, `content`, `link`) VALUES
	(1, 'Sample content for resource 1', 'https://example.com/resource1'),
	(2, 'Sample content for resource 2', 'https://example.com/resource2'),
	(3, 'Sample content for resource 3', 'https://example.com/resource3');

-- Listage de la structure de table musclemind. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program_id` int NOT NULL,
  `date_session` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D43EB8070A` (`program_id`),
  CONSTRAINT `FK_D044D5D43EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.session : ~0 rows (environ)

-- Listage de la structure de table musclemind. tracking
CREATE TABLE IF NOT EXISTS `tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_tracked_id` int NOT NULL,
  `height` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` smallint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A87C621CDDA0EDA4` (`user_tracked_id`),
  CONSTRAINT `FK_A87C621CDDA0EDA4` FOREIGN KEY (`user_tracked_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.tracking : ~1 rows (environ)
INSERT INTO `tracking` (`id`, `user_tracked_id`, `height`, `weight`, `age`, `sex`) VALUES
	(1, 1, '185', '85', '23', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.user : ~1 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `score`, `username`) VALUES
	(1, 'aminebncd_pro@hotmail.com', '[]', '$2y$13$9w0wbfZqweUoXdaPcqRHqu4nDNyeSHbWHpL7OHS0yDaNTvdAW8an2', 0, 'aminebncd');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.workout_plan : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
