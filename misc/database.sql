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

-- Listage de la structure de table musclemind. exercice
CREATE TABLE IF NOT EXISTS `exercice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercice_name` varchar(255) NOT NULL,
  `exercice_function` text NOT NULL,
  `target_id` int NOT NULL,
  `secondary_target_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_TARGET_ID` (`target_id`),
  KEY `FK_SECONDARY_TARGET_ID` (`secondary_target_id`),
  CONSTRAINT `FK_SECONDARY_TARGET_ID` FOREIGN KEY (`secondary_target_id`) REFERENCES `muscle` (`id`),
  CONSTRAINT `FK_TARGET_ID` FOREIGN KEY (`target_id`) REFERENCES `muscle` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.exercice : ~25 rows (environ)
INSERT INTO `exercice` (`id`, `exercice_name`, `exercice_function`, `target_id`, `secondary_target_id`) VALUES
	(111, 'Bench Press', 'Targets the pectoralis major', 1, NULL),
	(112, 'Push-Ups', 'Targets the pectoralis major and triceps brachii', 1, NULL),
	(113, 'Chest Fly', 'Targets the pectoralis major', 1, NULL),
	(114, 'Military Press', 'Targets the deltoid and triceps brachii', 2, NULL),
	(115, 'Lateral Raises', 'Targets the deltoid', 2, NULL),
	(116, 'Front Raises', 'Targets the deltoid and pectoralis major', 2, NULL),
	(117, 'Deadlifts', 'Targets the latissimus dorsi, erector spinae, and gluteus maximus', 3, NULL),
	(118, 'Pull-Ups', 'Targets the latissimus dorsi, biceps brachii, and brachialis', 3, NULL),
	(119, 'Bent Over Rows', 'Targets the latissimus dorsi and erector spinae', 3, NULL),
	(120, 'Crunches', 'Targets the rectus abdominis', 4, NULL),
	(121, 'Planks', 'Targets the transversus abdominis and rectus abdominis', 4, NULL),
	(124, 'Lunges', 'Targets the quadriceps, gluteus maximus, and erector spinae', 5, NULL),
	(125, 'Leg Press', 'Targets the quadriceps and gluteus maximus', 5, NULL),
	(127, 'Shrugs', 'Targets the trapezius and levator scapulae', 6, NULL),
	(129, 'Glute Bridge', 'Targets the gluteus maximus', 7, NULL),
	(130, 'Romanian Deadlifts', 'Targets the hamstrings and erector spinae', 7, NULL),
	(131, 'Calf Raises', 'Targets the gastrocnemius and soleus', 7, NULL),
	(132, 'Russian Twists', 'Targets the obliques', 7, NULL),
	(133, 'Bicep Curl', 'Targets the biceps', 1, NULL),
	(134, 'Hammer Curl', 'Targets the biceps and brachialis', 1, NULL),
	(135, 'Preacher Curl', 'Targets the biceps', 1, NULL),
	(136, 'Tricep Pushdown', 'Targets the triceps', 2, NULL),
	(137, 'Skull Crushers', 'Targets the triceps', 2, NULL),
	(138, 'Overhead Tricep Extension', 'Targets the triceps', 2, NULL),
	(140, 'Squats', 'Targets the quadriceps, hamstrings, and glutes', 3, NULL);

-- Listage de la structure de table musclemind. muscle
CREATE TABLE IF NOT EXISTS `muscle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_name` varchar(50) NOT NULL,
  `muscle_function` text NOT NULL,
  `muscle_group_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_MUSCLE_GROUP_ID` (`muscle_group_id`),
  CONSTRAINT `FK_MUSCLE_GROUP_ID` FOREIGN KEY (`muscle_group_id`) REFERENCES `muscle_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.muscle : ~35 rows (environ)
INSERT INTO `muscle` (`id`, `muscle_name`, `muscle_function`, `muscle_group_id`) VALUES
	(1, 'Pectoralis Major', 'Adducts and flexes the arm', 1),
	(2, 'Pectoralis Minor', 'Stabilizes the scapula and assists in respiration', 1),
	(3, 'Deltoid', 'Abducts, flexes, extends, and internally rotates the arm', 4),
	(4, 'Teres Major', 'Assists in extending, adducting, and rotating the arm', 4),
	(5, 'Supraspinatus', 'Initiates abduction of the arm', 4),
	(6, 'Infraspinatus', 'Laterally rotates the arm', 4),
	(7, 'Subscapularis', 'Medially rotates the arm', 4),
	(8, 'Rhomboids', 'Retracts the scapula and rotates it downward', 5),
	(9, 'Levator Scapulae', 'Elevates and rotates the scapula', 5),
	(10, 'Trapezius', 'Elevates, depresses, retracts, and rotates the scapula', 5),
	(11, 'Latissimus Dorsi', 'Adducts, extends, and internally rotates the arm', 5),
	(12, 'Serratus Anterior', 'Protracts the scapula and holds it against the rib cage', 5),
	(13, 'Rectus Abdominis', 'Flexes the spine', 6),
	(14, 'External Oblique', 'Flexes the spine, laterally flexes the spine, and rotates the trunk', 6),
	(15, 'Internal Oblique', 'Flexes the spine, laterally flexes the spine, and rotates the trunk', 6),
	(16, 'Transversus Abdominis', 'Compresses the abdominal contents', 6),
	(17, 'Erector Spinae', 'Extends and laterally flexes the vertebral column', 5),
	(18, 'Quadratus Lumborum', 'Laterally flexes the vertebral column and stabilizes the pelvis', 5),
	(19, 'Gluteus Maximus', 'Extends and laterally rotates the hip joint', 7),
	(20, 'Gluteus Medius', 'Abducts and medially rotates the thigh', 7),
	(21, 'Gluteus Minimus', 'Abducts and medially rotates the thigh', 7),
	(22, 'Psoas Major', 'Flexes the hip joint', 7),
	(23, 'Iliacus', 'Flexes the hip joint', 7),
	(24, 'Adductor Magnus', 'Adducts the thigh and assists in flexion and extension of the hip joint', 7),
	(25, 'Adductor Longus', 'Adducts the thigh and assists in flexion and extension of the hip joint', 7),
	(26, 'Adductor Brevis', 'Adducts the thigh and assists in flexion and extension of the hip joint', 7),
	(27, 'Gracilis', 'Adducts the thigh and assists in flexion and extension of the hip joint', 7),
	(28, 'Sartorius', 'Flexes, abducts, and laterally rotates the thigh and flexes the knee joint', 7),
	(29, 'Biceps Femoris', 'Flexes the knee joint and extends the hip joint', 7),
	(30, 'Semitendinosus', 'Flexes the knee joint and extends the hip joint', 7),
	(31, 'Semimembranosus', 'Flexes the knee joint and extends the hip joint', 7),
	(32, 'Gastrocnemius', 'Plantar flexes the foot and flexes the knee joint', 7),
	(33, 'Soleus', 'Plantar flexes the foot', 7),
	(34, 'Tibialis Anterior', 'Dorsiflexes and inverts the foot', 7),
	(35, 'Extensor Digitorum Longus', 'Dorsiflexes and extends the toes', 7);

-- Listage de la structure de table musclemind. muscle_group
CREATE TABLE IF NOT EXISTS `muscle_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_group` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `personnal_record` varchar(255) NOT NULL,
  `user_performing_id` int NOT NULL,
  `exercice_mesured_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USER_PERFORMING_ID` (`user_performing_id`),
  KEY `FK_EXERCICE_MESURED_ID` (`exercice_mesured_id`),
  CONSTRAINT `FK_EXERCICE_MESURED_ID` FOREIGN KEY (`exercice_mesured_id`) REFERENCES `exercice` (`id`),
  CONSTRAINT `FK_USER_PERFORMING_ID` FOREIGN KEY (`user_performing_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.performance : ~1 rows (environ)
INSERT INTO `performance` (`id`, `personnal_record`, `user_performing_id`, `exercice_mesured_id`) VALUES
	(1, '110', 1, 111);

-- Listage de la structure de table musclemind. program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `creator_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CREATOR_ID` (`creator_id`),
  CONSTRAINT `FK_CREATOR_ID` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.program : ~0 rows (environ)

-- Listage de la structure de table musclemind. ressources
CREATE TABLE IF NOT EXISTS `ressources` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.ressources : ~3 rows (environ)
INSERT INTO `ressources` (`id`, `content`, `link`) VALUES
	(1, 'Sample content for resource 1', 'https://example.com/resource1'),
	(2, 'Sample content for resource 2', 'https://example.com/resource2'),
	(3, 'Sample content for resource 3', 'https://example.com/resource3');

-- Listage de la structure de table musclemind. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_session` datetime NOT NULL,
  `program_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PROGRAM_ID_SESSION` (`program_id`),
  CONSTRAINT `FK_PROGRAM_ID_SESSION` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.session : ~0 rows (environ)

-- Listage de la structure de table musclemind. tracking
CREATE TABLE IF NOT EXISTS `tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `height` varchar(3) DEFAULT NULL,
  `weight` varchar(3) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `sex` smallint DEFAULT NULL,
  `user_tracked_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USER_TRACKED_ID` (`user_tracked_id`),
  CONSTRAINT `FK_USER_TRACKED_ID` FOREIGN KEY (`user_tracked_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.tracking : ~1 rows (environ)
INSERT INTO `tracking` (`id`, `height`, `weight`, `age`, `sex`, `user_tracked_id`) VALUES
	(1, '185', '85', '23', 1, 1);

-- Listage de la structure de table musclemind. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `score` int NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.user : ~1 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `score`, `username`) VALUES
	(1, 'aminebncd_pro@hotmail.com', '[]', '$2y$13$9w0wbfZqweUoXdaPcqRHqu4nDNyeSHbWHpL7OHS0yDaNTvdAW8an2', 0, 'aminebncd');

-- Listage de la structure de table musclemind. workout_plan
CREATE TABLE IF NOT EXISTS `workout_plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number_of_repetitions` int NOT NULL,
  `weights_used` int NOT NULL,
  `exercice_id` int NOT NULL,
  `program_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_EXERCICE_ID` (`exercice_id`),
  KEY `FK_PROGRAM_ID` (`program_id`),
  CONSTRAINT `FK_EXERCICE_ID` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`),
  CONSTRAINT `FK_PROGRAM_ID` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table musclemind.workout_plan : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
