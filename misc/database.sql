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

-- Listage des données de la table musclemind.doctrine_migration_versions : ~5 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240413214807', '2024-04-13 21:48:11', 510),
	('DoctrineMigrations\\Version20240413214908', '2024-04-13 21:49:13', 56),
	('DoctrineMigrations\\Version20240419161528', '2024-04-19 16:15:34', 70),
	('DoctrineMigrations\\Version20240428193542', '2024-04-28 19:35:48', 50),
	('DoctrineMigrations\\Version20240428194821', '2024-04-28 19:49:46', 33);

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
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.exercice : ~59 rows (environ)
INSERT INTO `exercice` (`id`, `target_id`, `secondary_target_id`, `exercice_name`, `exercice_function`) VALUES
	(142, 7, 18, 'Dumbbell Hammer Curls', 'Isolation exercise for the biceps, targeting both the biceps and the brachialis with dumbbells held in a neutral grip.'),
	(143, 6, 7, 'Barbell Spider Curls', 'Isolation exercise for the biceps, performed lying prone on an incline bench with arms hanging straight down, curling the barbell upwards.'),
	(144, 7, 18, 'Cable Rope Hammer Curls', 'Isolation exercise for the biceps, using a cable machine and a rope attachment for a different angle of resistance.'),
	(145, 7, 6, 'Incline Dumbbell Curls', 'Isolation exercise for the biceps, performed on an incline bench to target the biceps from a different angle.'),
	(146, 8, 9, 'Shoulder Press', 'Compound exercise targeting all three deltoid heads and other shoulder muscles.'),
	(147, 9, NULL, 'Lateral Raises', 'Isolation exercise for the lateral deltoids, involving lifting the arms laterally to the sides.'),
	(148, 8, NULL, 'Front Raises', 'Isolation exercise for the anterior deltoids, involving lifting the arms forward in front of the body.'),
	(149, 10, NULL, 'Rear Delt Flyes', 'Isolation exercise for the rear deltoids, targeting the posterior shoulder muscles.'),
	(150, 11, 7, 'Pull-Ups', 'Compound exercise engaging the lats, biceps, and other back muscles by pulling the body up to a bar.'),
	(151, 11, NULL, 'Lat Pulldowns', 'Compound exercise targeting the latissimus dorsi muscles by pulling a weighted bar down to the chest.'),
	(152, 11, 13, 'Bent-Over Rows', 'Compound exercise engaging the lats, rhomboids, and other back muscles by pulling a weighted barbell or dumbbells toward the waist.'),
	(153, 11, 17, 'Deadlifts', 'Compound exercise engaging the lower back, hamstrings, and other muscles by lifting a weighted barbell or dumbbells from the ground to a standing position.'),
	(154, 14, NULL, 'Crunches', 'Isolation exercise for the rectus abdominis, involving flexion of the spine to contract the abdominal muscles.'),
	(155, 15, NULL, 'Russian Twists', 'Isolation exercise for the obliques, involving twisting the torso from side to side while holding a weight.'),
	(156, 14, NULL, 'Leg Raises', 'Isolation exercise for the lower abs, involving lifting the legs while lying on the back.'),
	(157, 16, 17, 'Squats', 'Compound exercise targeting the quadriceps, hamstrings, and glutes by bending the knees and hips to lower the body into a seated position.'),
	(158, 16, 17, 'Lunges', 'Compound exercise engaging the quadriceps, hamstrings, and glutes by stepping forward or backward into a lunge position and then returning to standing.'),
	(159, 11, 17, 'Deadlifts', 'Compound exercise engaging the hamstrings, glutes, lower back, and other muscles by lifting a weighted barbell or dumbbells from the ground to a standing position.'),
	(160, 20, NULL, 'Wrist Curls', 'Isolation exercise for the forearm flexors, involving curling the wrist to lift a weight.'),
	(161, 19, NULL, 'Reverse Wrist Curls', 'Isolation exercise for the forearm extensors, involving extending the wrist against resistance.'),
	(162, 7, 18, 'Hammer Curls', 'Isolation exercise for the brachioradialis, involving curling the wrist in a neutral grip.'),
	(163, 6, NULL, 'Zottman Curls', 'Compound exercise involving both the biceps and forearms, performed by curling dumbbells with palms facing up on the concentric phase and facing down on the eccentric phase.'),
	(164, 6, NULL, 'Machine Preacher Curls', 'Isolation exercise for the biceps, performed on a machine with padded arms to isolate the biceps.'),
	(165, 7, 18, 'Cross-Body Hammer Curls', 'Isolation exercise for the biceps and brachialis, involving curling dumbbells across the body towards the opposite shoulder.'),
	(166, 7, 6, 'EZ-Bar Preacher Curls', 'Isolation exercise for the biceps, performed with an EZ-bar on a preacher bench to emphasize the peak contraction of the biceps.'),
	(167, 7, 6, 'Alternating Incline Dumbbell Curls', 'Isolation exercise for the biceps, performed on an incline bench with alternating arm curls to target each bicep individually.'),
	(168, 8, 9, 'Arnold Dumbbell Press', 'Compound exercise targeting all three deltoid heads, performed by rotating the arms as they are pressed overhead with dumbbells.'),
	(169, 8, NULL, 'Cable Face Pulls', 'Isolation exercise targeting the rear delts and upper back, performed by pulling a rope attachment towards the face at eye level.'),
	(170, 8, NULL, 'Machine Shoulder Press', 'Compound exercise targeting the deltoids and triceps, performed on a machine with guided movement for the shoulders.'),
	(171, 9, NULL, 'Single-Arm Cable Lateral Raises', 'Isolation exercise targeting the lateral deltoids, performed with a cable machine and one arm at a time for unilateral development.'),
	(172, 8, 9, 'Seated Dumbbell Shoulder Press', 'Compound exercise targeting the deltoids and triceps, performed seated with dumbbells pressed overhead.'),
	(173, 12, 13, 'Wide-Grip Pull-Ups', 'Compound exercise engaging the lats and upper back, performed with a wide grip to emphasize lat width and upper back development.'),
	(174, 11, NULL, 'Machine Lat Pulldowns', 'Compound exercise targeting the latissimus dorsi muscles, performed on a machine with a weighted bar attached to a cable pulley system.'),
	(175, 11, NULL, 'Chest-Supported Dumbbell Rows', 'Compound exercise targeting the upper back and lats, performed lying face down on an incline bench and rowing dumbbells towards the hips.'),
	(176, 12, NULL, 'Barbell Shrugs', 'Isolation exercise targeting the trapezius muscles, involving shrugging the shoulders upwards with a barbell held in front of the body.'),
	(177, 11, NULL, 'Straight-Arm Pulldowns', 'Isolation exercise targeting the lats and upper back, performed by pulling a straight bar down to the thighs with straight arms.'),
	(178, 15, 14, 'Hanging Windshield Wipers', 'Advanced core exercise targeting the obliques and rectus abdominis, performed hanging from a pull-up bar with legs extended and rotated from side to side.'),
	(179, 14, NULL, 'Plank with Leg Lifts', 'Core stabilization exercise targeting the entire core, performed in a plank position with alternating leg lifts for added difficulty.'),
	(180, 15, NULL, 'Cable Woodchoppers', 'Dynamic core exercise targeting the obliques and rotational strength, performed with a cable machine and a rope attachment to simulate chopping wood from high to low or low to high.'),
	(181, 14, NULL, 'Hanging Leg Circles', 'Core exercise targeting the lower abs and hip flexors, performed hanging from a pull-up bar with legs extended and tracing circular motions.'),
	(182, 14, NULL, 'Ab Rollouts from Feet', 'Advanced core exercise targeting the entire core, performed with an ab wheel from a kneeling position with feet lifted off the ground for increased difficulty.'),
	(183, 16, 17, 'Hack Squats', 'Compound exercise targeting the quadriceps, hamstrings, and glutes, performed on a hack squat machine with a sled.'),
	(184, 16, 17, 'Step-Ups', 'Compound exercise engaging the quadriceps, hamstrings, and glutes, performed by stepping onto a raised platform or bench with one foot at a time.'),
	(185, 21, NULL, 'Leg Press Machine Calf Raises', 'Isolation exercise targeting the calf muscles, performed on a leg press machine by pushing the platform with the balls of the feet.'),
	(186, 17, 11, 'Sumo Deadlifts', 'Compound exercise targeting the inner thighs, hamstrings, and glutes, performed with a wide stance and a barbell or dumbbells.'),
	(187, 16, 17, 'Box Squats', 'Compound exercise targeting the quadriceps, hamstrings, and glutes, performed by squatting onto a box or bench and then standing back up.'),
	(188, 20, 19, 'Zottman Forearm Curls', 'Compound exercise targeting the forearm flexors and extensors, performed by curling dumbbells with palms facing up on the concentric phase and facing down on the eccentric phase.'),
	(189, 20, 19, 'Wrist Roller Reverse Grip', 'Isolation exercise targeting the forearm flexors and extensors, performed by rolling up and down a weight attached to a rope with a reverse grip for forearm strength and endurance.'),
	(190, 20, 19, 'Plate Pinch Walks', 'Isometric exercise targeting grip strength and forearm endurance, performed by holding weight plates together between your fingers by the sides for a certain distance to work on grip strength and overall body stability.'),
	(191, 1, 4, 'Bench Press', 'Compound exercise targeting the chest, shoulders, and triceps, performed by pressing a barbell away from the chest while lying on a bench.'),
	(192, 1, NULL, 'Dumbbell Flyes', 'Isolation exercise targeting the chest, performed by lying on a bench and opening the arms wide, lowering dumbbells to the sides, and then bringing them back up.'),
	(193, 1, 8, 'Incline Bench Press', 'Compound exercise targeting the upper chest, shoulders, and triceps, performed on an inclined bench with a barbell or dumbbells.'),
	(194, 1, 2, 'Chest Dips', 'Compound exercise targeting the lower chest and triceps, performed by lowering and raising the body on parallel bars or dip bars.'),
	(195, 1, NULL, 'Cable Crossover', 'Isolation exercise targeting the chest, performed by crossing cables in front of the body at shoulder height to contract the chest muscles.'),
	(196, 5, 3, 'Tricep Dumbell kickbacks', 'Isolation exercise targeting the triceps, performed by extending the arm behind the body with a dumbbell while bent over.'),
	(197, 5, 7, 'Tricep Rope Pushdowns', 'Isolation exercise targeting the triceps, performed by pushing a rope attachment down towards the thighs with elbows stationary at the sides.'),
	(198, 4, 3, 'Overhead Tricep Extension', 'Isolation exercise targeting the triceps, performed by extending a dumbbell or barbell overhead with both hands.'),
	(199, 5, 7, 'Close-Grip Bench Press', 'Compound exercise targeting the triceps, performed with a narrow grip on the barbell to emphasize tricep engagement while bench pressing.'),
	(200, 4, 5, 'Skull Crushers', 'Isolation exercise targeting the triceps, performed by lowering a barbell or dumbbells towards the forehead while lying on a bench and then extending the arms back up.');

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
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.muscle : ~18 rows (environ)
INSERT INTO `muscle` (`id`, `muscle_group_id`, `muscle_name`, `muscle_function`) VALUES
	(1, 1, 'Pectoralis Major', 'Located in the chest area, attached to the sternum, clavicle, and ribs. Primary function is to bring the upper arm across the body, as in pressing movements like chest press and push-ups.'),
	(2, 1, 'Pectoralis Minor', 'Located beneath the pectoralis major, attached to the ribs. Assists in pulling the shoulder forward and down.'),
	(3, 2, 'Triceps Brachii (Lateral Head)', 'Located at the back of the upper arm, attached to the humerus. Involved in pushing movements like triceps pushdowns and dips.'),
	(4, 2, 'Triceps Brachii (Long Head)', 'Located at the back of the upper arm, attached to the scapula and humerus. Important for overhead movements like overhead triceps extensions and skull crushers.'),
	(5, 2, 'Triceps Brachii (Medial Head)', 'Located at the back of the upper arm, deep to the long and lateral heads, attached to the humerus. Plays a role in close-grip pressing movements like close-grip bench press and diamond push-ups.'),
	(6, 3, 'Biceps Brachii (Short Head)', 'Located at the front of the upper arm, attached to the scapula and radius. Mainly responsible for elbow flexion, as in bicep curls and hammer curls.'),
	(7, 3, 'Biceps Brachii (Long Head)', 'Located at the front of the upper arm, deep to the short head, attached to the scapula and radius. Involved in elbow flexion and forearm supination, as in preacher curls and concentration curls.'),
	(8, 4, 'Anterior Deltoid (Front Delts)', 'Located at the front of the shoulder, attached to the clavicle and scapula. Primary function is to lift the arm forward, as in front raise and shoulder press.'),
	(9, 4, 'Medial Deltoid (Side Delts)', 'Located at the side of the shoulder, attached to the scapula and clavicle. Responsible for lifting the arm sideways, as in lateral raise and upright row.'),
	(10, 4, 'Posterior Deltoid (Rear Delts)', 'Located at the back of the shoulder, attached to the scapula. Involved in pulling the arm backward, as in reverse fly and face pull.'),
	(11, 5, 'Latissimus Dorsi (Lats)', 'Located at the back, attached to the humerus. Responsible for movements like pull-ups, lat pulldowns, and rows.'),
	(12, 5, 'Trapezius (Traps)', 'Located at the upper back and neck, attached to the scapula. Involved in movements like shrugs, upright rows, and deadlifts.'),
	(13, 5, 'Rhomboids', 'Located between the shoulder blades, attached to the scapula. Involved in movements like rows and scapular retractions.'),
	(14, 6, 'Rectus Abdominis', 'Located in the abdominal area, attached to the pubic bone and ribs. Responsible for trunk flexion, as in crunches and sit-ups.'),
	(15, 6, 'Obliques', 'Located on the sides of the torso, attached to the ribs and pelvis. Involved in twisting movements.'),
	(16, 7, 'Quadriceps', 'Located in the front of the thigh, attached to the femur. Main function is knee extension, as in squats and leg extensions.'),
	(17, 7, 'Hamstrings', 'Located in the back of the thigh, attached to the pelvis and tibia. Responsible for knee flexion and hip extension, as in deadlifts and leg curls.'),
	(18, 8, 'Brachioradialis', 'Located in the forearm, attached to the humerus and radius. Involved in elbow flexion and forearm supination, as in hammer curls and wrist curls.'),
	(19, 8, 'Forearm Extensors', 'aedf'),
	(20, 8, 'Forearm Flexors', 'retjhrte'),
	(21, 7, 'calves', 'zrgzrg');

-- Listage de la structure de table musclemind. muscle_group
CREATE TABLE IF NOT EXISTS `muscle_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muscle_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.muscle_group : ~7 rows (environ)
INSERT INTO `muscle_group` (`id`, `muscle_group`) VALUES
	(1, 'CHEST'),
	(2, 'TRICEPS'),
	(3, 'BICEPS'),
	(4, 'SHOULDERS'),
	(5, 'BACK'),
	(6, 'ABS'),
	(7, 'LEGS'),
	(8, 'FOREARMS');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.performance : ~1 rows (environ)
INSERT INTO `performance` (`id`, `user_performing_id`, `exercice_mesured_id`, `personnal_record`) VALUES
	(4, 1, 191, '105');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.program : ~2 rows (environ)
INSERT INTO `program` (`id`, `creator_id`, `muscle_group_targeted_id`, `secondary_muscle_group_targeted_id`, `title`) VALUES
	(15, 1, 1, 2, 'seance pec de folie');

-- Listage de la structure de table musclemind. ressources
CREATE TABLE IF NOT EXISTS `ressources` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D43EB8070A` (`program_id`),
  KEY `IDX_D044D5D4A76ED395` (`user_id`),
  CONSTRAINT `FK_D044D5D43EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  CONSTRAINT `FK_D044D5D4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.session : ~9 rows (environ)
INSERT INTO `session` (`id`, `program_id`, `date_session`, `user_id`) VALUES
	(226, 15, '2024-05-09 21:22:05', 1),
	(227, 15, '2024-05-13 21:22:05', 1),
	(228, 15, '2024-05-16 21:22:05', 1),
	(229, 15, '2024-05-20 21:22:05', 1),
	(230, 15, '2024-05-23 21:22:05', 1),
	(231, 15, '2024-05-27 21:22:05', 1),
	(232, 15, '2024-05-30 21:22:05', 1),
	(233, 15, '2024-06-03 21:22:05', 1),
	(234, 15, '2024-06-06 21:22:05', 1);

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

-- Listage des données de la table musclemind.tracking : ~2 rows (environ)
INSERT INTO `tracking` (`id`, `user_tracked_id`, `height`, `weight`, `age`, `sex`, `date_of_tracking`) VALUES
	(2, 1, '185', '85', '23', 0, '2024-04-28 21:50:08'),
	(3, 1, '185', '89', '23', 0, '2024-04-28 22:20:16'),
	(4, 1, '186', '89', '23', 0, '2024-04-30 20:22:59');

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

-- Listage des données de la table musclemind.user : ~3 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `score`, `username`) VALUES
	(1, 'aminebncd_pro@hotmail.com', '[]', '$2y$13$9w0wbfZqweUoXdaPcqRHqu4nDNyeSHbWHpL7OHS0yDaNTvdAW8an2', 17745, 'aminebncd'),
	(2, 'user1@gmail.com', '[]', 'abc', 0, 'user1'),
	(3, 'user2@gmail.com', '[]', 'abc', 0, 'user2'),
	(4, 'user3@gmail.com', '[]', 'abc', 0, 'user3');

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table musclemind.workout_plan : ~15 rows (environ)
INSERT INTO `workout_plan` (`id`, `exercice_id`, `program_id`, `number_of_repetitions`, `weights_used`) VALUES
	(19, 191, 15, 12, 60),
	(37, 191, 15, 10, 80),
	(38, 191, 15, 5, 100),
	(39, 191, 15, 5, 100),
	(40, 191, 15, 3, 105),
	(53, 193, 15, 5, 90),
	(54, 193, 15, 5, 90),
	(55, 194, 15, 10, 20),
	(56, 194, 15, 10, 20),
	(57, 195, 15, 10, 14),
	(58, 195, 15, 10, 14),
	(59, 197, 15, 10, 30),
	(60, 197, 15, 10, 30),
	(61, 200, 15, 10, 45),
	(62, 200, 15, 10, 45);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
