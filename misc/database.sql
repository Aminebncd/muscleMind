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

-- Listage des données de la table musclemind.doctrine_migration_versions : ~1 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240413214807', '2024-04-13 21:48:11', 510),
	('DoctrineMigrations\\Version20240413214908', '2024-04-13 21:49:13', 56),
	('DoctrineMigrations\\Version20240419161528', '2024-04-19 16:15:34', 70),
	('DoctrineMigrations\\Version20240428193542', '2024-04-28 19:35:48', 50),
	('DoctrineMigrations\\Version20240428194821', '2024-04-28 19:49:46', 33),
	('DoctrineMigrations\\Version20240521075309', '2024-05-22 08:45:14', 50),
	('DoctrineMigrations\\Version20240523082833', '2024-05-24 16:05:06', 57),
	('DoctrineMigrations\\Version20240524160459', '2024-05-24 16:05:07', 83),
	('DoctrineMigrations\\Version20240531070850', '2024-05-31 07:08:54', 1626),
	('DoctrineMigrations\\Version20240605123700', '2024-06-05 12:37:08', 133),
	('DoctrineMigrations\\Version20240606085929', '2024-06-06 08:59:55', 90),
	('DoctrineMigrations\\Version20240611063908', '2024-06-11 06:39:21', 843);

-- Listage des données de la table musclemind.exercice : ~0 rows (environ)
INSERT INTO `exercice` (`id`, `target_id`, `secondary_target_id`, `exercice_name`, `exercice_function`, `how_to_perform`, `pro_tip`, `video_explication`) VALUES
	(142, 7, 18, 'Dumbbell Hammer Curls', 'Isolation exercise for the biceps, targeting both the biceps and the brachialis with dumbbells held in a neutral grip.', 'Stand up straight with a dumbbell in each hand, your arms fully extended and your palms facing your torso. Curl the weights while keeping your upper arms stationary until your biceps are fully contracted and the dumbbells are at shoulder level. Hold the contracted position for a brief pause as you squeeze your biceps. Slowly begin to bring the dumbbells back to the starting position.', 'Maintain a neutral wrist position throughout the movement to maximize engagement of the brachialis and minimize strain on the wrists.', NULL),
	(143, 6, 7, 'Barbell Spider Curls', 'Isolation exercise for the biceps, performed lying prone on an incline bench with arms hanging straight down, curling the barbell upwards.', 'Lie face down on an incline bench with your chest against the bench and your feet firmly on the floor. Let your arms hang down holding a barbell. Curl the barbell up as high as you can, squeezing your biceps at the top of the movement. Slowly lower the barbell back to the starting position.', 'Focus on slow, controlled movements to maximize bicep engagement and prevent momentum from aiding the lift.', NULL),
	(144, 7, 18, 'Cable Rope Hammer Curls', 'Isolation exercise for the biceps, using a cable machine and a rope attachment for a different angle of resistance.', 'Attach a rope handle to a low pulley. Stand facing the machine, grasp the rope with a neutral grip (palms facing each other), and step back slightly. Curl the rope towards your shoulders, keeping your upper arms stationary. Pause at the top and then slowly lower the rope back to the starting position.', 'Keep your elbows close to your body to avoid shoulder involvement and maximize bicep and brachialis engagement.', NULL),
	(145, 7, 6, 'Incline Dumbbell Curls', 'Isolation exercise for the biceps, performed on an incline bench to target the biceps from a different angle.', 'Sit on an incline bench with a dumbbell in each hand, your arms fully extended and hanging down. Curl the weights while keeping your upper arms stationary until your biceps are fully contracted and the dumbbells are at shoulder level. Hold the contracted position for a brief pause as you squeeze your biceps. Slowly begin to bring the dumbbells back to the starting position.', 'Perform the exercise slowly and under control to maximize muscle engagement and avoid using momentum.', NULL),
	(146, 8, 9, 'Shoulder Press', 'Compound exercise targeting all three deltoid heads and other shoulder muscles.', 'Sit on a bench with back support. Hold a dumbbell in each hand at shoulder height with your palms facing forward. Press the weights overhead until your arms are fully extended. Pause at the top, then slowly lower the weights back to the starting position.', 'Keep your core engaged and avoid arching your back to maintain proper form and prevent injury.', NULL),
	(147, 9, NULL, 'Lateral Raises', 'Isolation exercise for the lateral deltoids, involving lifting the arms laterally to the sides.', 'Stand with your feet shoulder-width apart and a dumbbell in each hand at your sides. Raise your arms to the sides until they are parallel to the floor. Pause at the top, then slowly lower the weights back to the starting position.', 'Keep a slight bend in your elbows to reduce the risk of joint strain and maximize deltoid engagement.', NULL),
	(148, 8, NULL, 'Front Raises', 'Isolation exercise for the anterior deltoids, involving lifting the arms forward in front of the body.', 'Stand with your feet shoulder-width apart and a dumbbell in each hand at your thighs. Lift the weights in front of you to shoulder height. Pause at the top, then slowly lower the weights back to the starting position.', 'Maintain a controlled motion to prevent momentum from taking over and to better isolate the anterior deltoids.', NULL),
	(149, 10, NULL, 'Rear Delt Flyes', 'Isolation exercise for the rear deltoids, targeting the posterior shoulder muscles.', 'Hold a dumbbell in each hand with your arms extended and slightly bent, palms facing each other. Bend at the hips with a straight back and lift the weights laterally until your arms are parallel to the floor. Lower slowly.', 'Engage your core to maintain stability and prevent swinging during the lift.', NULL),
	(150, 11, 7, 'Pull-Ups', 'Compound exercise engaging the lats, biceps, and other back muscles by pulling the body up to a bar.', 'Hang from a pull-up bar with a shoulder-width overhand grip. Pull your body up until your chin is above the bar. Lower yourself back to the starting position with control.', 'Focus on pulling with your back muscles rather than your arms to maximize lat engagement.', NULL),
	(151, 11, NULL, 'Lat Pulldowns', 'Compound exercise targeting the latissimus dorsi muscles by pulling a weighted bar down to the chest.', 'Sit at a lat pulldown machine and grasp the bar with a wide overhand grip. Pull the bar down to your chest while squeezing your shoulder blades together. Slowly return the bar to the starting position.', 'Keep your chest up and avoid leaning back to ensure proper form and maximize back muscle activation.', NULL),
	(152, 11, 13, 'Bent-Over Rows', 'Compound exercise engaging the lats, rhomboids, and other back muscles by pulling a weighted barbell or dumbbells toward the waist.', 'Stand with your feet shoulder-width apart, holding a barbell with a pronated grip. Bend at the hips until your torso is almost parallel to the floor. Row the barbell to your waist, squeezing your shoulder blades together. Lower slowly.', 'Maintain a flat back and avoid rounding your shoulders to prevent injury and maximize muscle engagement.', NULL),
	(154, 14, NULL, 'Crunches', 'Isolation exercise for the rectus abdominis, involving flexion of the spine to contract the abdominal muscles.', 'Lie on your back with your knees bent and feet flat on the floor. Place your hands behind your head and curl your torso towards your knees, contracting your abs. Lower back down with control.', 'Exhale as you lift your torso and inhale as you lower it to maintain a steady breathing pattern.', NULL),
	(155, 15, NULL, 'Russian Twists', 'Isolation exercise for the obliques, involving twisting the torso from side to side while holding a weight.', 'Sit on the floor with your knees bent and feet lifted off the ground. Hold a weight with both hands and rotate your torso from side to side, tapping the weight on the floor beside you.', 'Keep your core tight and move slowly to maximize abdominal engagement and control.', NULL),
	(156, 14, NULL, 'Leg Raises', 'Isolation exercise for the lower abs, involving lifting the legs while lying on the back.', 'Lie on your back with your legs extended. Lift your legs to a 90-degree angle, keeping them straight. Slowly lower them back down without touching the ground.', 'Avoid letting your lower back arch off the ground to protect your spine and maximize abdominal engagement.', NULL),
	(157, 16, 17, 'Squats', 'Compound exercise targeting the quadriceps, hamstrings, and glutes by bending the knees and hips to lower the body into a seated position.', 'Stand with your feet shoulder-width apart and a barbell on your upper back. Bend at the knees and hips to lower your body until your thighs are parallel to the floor. Stand back up to the starting position.', 'Keep your knees aligned with your toes to prevent knee strain and ensure proper squat form.', NULL),
	(158, 16, 17, 'Lunges', 'Compound exercise engaging the quadriceps, hamstrings, and glutes by stepping forward or backward into a lunge position and then returning to standing.', 'Stand upright with your feet together and hands on your hips. Step forward with one leg and lower your hips until both knees are bent at 90 degrees. Push back to the starting position and repeat with the other leg.', 'Keep your torso upright and your core engaged to maintain balance and proper form.', NULL),
	(159, 11, 17, 'Deadlifts', 'Compound exercise engaging the hamstrings, glutes, lower back, and other muscles by lifting a weighted barbell or dumbbells from the ground to a standing position.', 'Stand with your feet hip-width apart and a barbell on the ground in front of you. Bend at the hips and knees to grasp the barbell with an overhand grip. Lift the barbell by straightening your hips and knees to a standing position. Lower it back to the ground with control.', 'Engage your core and keep your back flat to prevent injury and maximize muscle engagement.', NULL),
	(160, 20, NULL, 'Wrist Curls', 'Isolation exercise for the forearm flexors, involving curling the wrist to lift a weight.', 'Sit on a bench with your forearms resting on your thighs, holding a barbell with an underhand grip. Curl your wrists up and then slowly lower them back down.', 'Use a controlled motion and avoid swinging the weight to maximize wrist and forearm engagement.', NULL),
	(161, 19, NULL, 'Reverse Wrist Curls', 'Isolation exercise for the forearm extensors, involving extending the wrist against resistance.', 'Sit on a bench with your forearms resting on your thighs, holding a barbell with an overhand grip. Extend your wrists upwards and then slowly lower them back down.', 'Keep your forearms flat on your thighs to isolate your wrist extensors and prevent elbow involvement.', NULL),
	(162, 7, 18, 'Hammer Curls', 'Isolation exercise for the brachioradialis, involving curling the wrist in a neutral grip.', 'Stand with your feet shoulder-width apart and a dumbbell in each hand, palms facing your torso. Curl the weights towards your shoulders while keeping your upper arms stationary. Lower the weights back to the starting position.', 'Focus on keeping your upper arms stationary to maximize bicep engagement and avoid using momentum.', NULL),
	(163, 6, NULL, 'Zottman Curls', 'Compound exercise involving both the biceps and forearms, performed by curling dumbbells with palms facing up on the concentric phase and facing down on the eccentric phase.', 'Stand holding a pair of dumbbells with your palms facing forward. Curl the weights up, rotating your wrists at the top so your palms face downwards. Lower the weights back down while keeping your palms facing down.', 'Control the rotation of your wrists to ensure smooth motion and prevent joint strain.', NULL),
	(164, 6, NULL, 'Machine Preacher Curls', 'Isolation exercise for the biceps, performed on a machine with padded arms to isolate the biceps.', 'Sit at a preacher curl machine and grasp the handles with an underhand grip. Curl the weights towards your shoulders, squeezing your biceps at the top. Lower the weights back down with control.', 'Avoid letting your elbows flare out to maintain proper form and maximize bicep engagement.', NULL),
	(165, 7, 18, 'Cross-Body Hammer Curls', 'Isolation exercise for the biceps and brachialis, involving curling dumbbells across the body towards the opposite shoulder.', 'Stand with a dumbbell in each hand, palms facing your torso. Curl one weight across your body towards the opposite shoulder, keeping your upper arm stationary. Lower and repeat with the other arm.', 'Keep your upper arm close to your body to isolate your biceps and minimize shoulder involvement.', NULL),
	(166, 7, 6, 'EZ-Bar Preacher Curls', 'Isolation exercise for the biceps, performed with an EZ-bar on a preacher bench to emphasize the peak contraction of the biceps.', 'Sit at a preacher bench with an EZ-bar. Curl the bar up towards your shoulders, squeezing your biceps at the top. Lower the bar back down with control.', 'Use a full range of motion to maximize bicep engagement and avoid using momentum.', NULL),
	(167, 7, 6, 'Alternating Incline Dumbbell Curls', 'Isolation exercise for the biceps, performed on an incline bench with alternating arm curls to target each bicep individually.', 'Sit on an incline bench with a dumbbell in each hand, palms facing forward. Curl one weight up while keeping your upper arm stationary, then lower it back down and repeat with the other arm.', 'Perform the exercise slowly and under control to maximize muscle engagement and avoid using momentum.', NULL),
	(168, 8, 9, 'Arnold Dumbbell Press', 'Compound exercise targeting all three deltoid heads, performed by rotating the arms as they are pressed overhead with dumbbells.', 'Sit on a bench with back support, holding a dumbbell in each hand at shoulder height with your palms facing you. Rotate your wrists as you press the weights overhead until your palms face forward. Lower the weights back to the starting position with control.', 'Avoid arching your back by engaging your core and keeping your spine neutral throughout the lift.', NULL),
	(169, 8, NULL, 'Cable Face Pulls', 'Isolation exercise targeting the rear delts and upper back, performed by pulling a rope attachment towards the face at eye level.', 'Attach a rope to a high pulley. Stand facing the machine and grasp the rope with both hands. Pull the rope towards your face, flaring your elbows out. Squeeze your shoulder blades together and then slowly return to the starting position.', 'Focus on squeezing your shoulder blades together to maximize rear deltoid and upper back engagement.', NULL),
	(170, 8, NULL, 'Machine Shoulder Press', 'Compound exercise targeting the deltoids and triceps, performed on a machine with guided movement for the shoulders.', 'Sit on a shoulder press machine and grasp the handles. Press the weights overhead until your arms are fully extended. Lower the weights back to the starting position with control.', 'Maintain a controlled motion to ensure proper shoulder engagement and avoid using momentum.', NULL),
	(171, 9, NULL, 'Single-Arm Cable Lateral Raises', 'Isolation exercise targeting the lateral deltoids, performed with a cable machine and one arm at a time for unilateral development.', 'Stand next to a cable machine with the pulley at the lowest setting. Grasp the handle with one hand and raise your arm laterally to shoulder height. Lower the weight back to the starting position with control.', 'Keep a slight bend in your elbow to reduce joint strain and ensure deltoid engagement.', NULL),
	(172, 8, 9, 'Seated Dumbbell Shoulder Press', 'Compound exercise targeting the deltoids and triceps, performed seated with dumbbells pressed overhead.', 'Sit on a bench with back support, holding a dumbbell in each hand at shoulder height with your palms facing forward. Press the weights overhead until your arms are fully extended. Lower the weights back to the starting position with control.', 'Avoid arching your back by engaging your core and keeping your spine neutral throughout the lift.', NULL),
	(173, 12, 13, 'Wide-Grip Pull-Ups', 'Compound exercise engaging the lats and upper back, performed with a wide grip to emphasize lat width and upper back development.', 'Hang from a pull-up bar with a wide overhand grip. Pull your body up until your chin is above the bar. Lower yourself back to the starting position with control.', 'Focus on pulling with your back muscles rather than your arms to maximize lat engagement.', NULL),
	(174, 11, NULL, 'Machine Lat Pulldowns', 'Compound exercise targeting the latissimus dorsi muscles, performed on a machine with a weighted bar attached to a cable pulley system.', 'Sit at a lat pulldown machine and grasp the bar with a wide overhand grip. Pull the bar down to your chest while squeezing your shoulder blades together. Slowly return the bar to the starting position.', 'Keep your chest up and avoid leaning back to ensure proper form and maximize back muscle activation.', NULL),
	(175, 11, NULL, 'Chest-Supported Dumbbell Rows', 'Compound exercise targeting the upper back and lats, performed lying face down on an incline bench and rowing dumbbells towards the hips.', 'Lie face down on an incline bench with a dumbbell in each hand. Row the weights towards your hips, squeezing your shoulder blades together. Lower the weights back down with control.', 'Maintain a flat back and avoid rounding your shoulders to prevent injury and maximize muscle engagement.', NULL),
	(176, 12, NULL, 'Barbell Shrugs', 'Isolation exercise targeting the trapezius muscles, involving shrugging the shoulders upwards with a barbell held in front of the body.', 'Stand with your feet shoulder-width apart, holding a barbell with an overhand grip. Shrug your shoulders up towards your ears, then slowly lower them back down.', 'Avoid rolling your shoulders forward to ensure proper form and maximize trapezius engagement.', NULL),
	(177, 11, NULL, 'Straight-Arm Pulldowns', 'Isolation exercise targeting the lats and upper back, performed by pulling a straight bar down to the thighs with straight arms.', 'Stand facing a cable machine with a straight bar attached to a high pulley. Grasp the bar with a wide overhand grip and pull it down to your thighs, keeping your arms straight. Slowly return to the starting position.', 'Maintain a slight bend in your elbows to avoid joint strain and ensure proper muscle engagement.', NULL),
	(178, 15, 14, 'Hanging Windshield Wipers', 'Advanced core exercise targeting the obliques and rectus abdominis, performed hanging from a pull-up bar with legs extended and rotated from side to side.', 'Hang from a pull-up bar with your legs extended and together. Rotate your legs from side to side in a windshield wiper motion, keeping your core engaged.', 'Keep your core tight throughout the movement to maintain stability and control.', NULL),
	(179, 14, NULL, 'Plank with Leg Lifts', 'Core stabilization exercise targeting the entire core, performed in a plank position with alternating leg lifts for added difficulty.', 'Start in a plank position with your forearms on the ground and your body in a straight line. Lift one leg towards the ceiling, keeping your core tight. Lower the leg and repeat with the other leg.', 'Engage your core and avoid letting your hips drop to ensure proper form and prevent injury.', NULL),
	(180, 15, NULL, 'Cable Woodchoppers', 'Dynamic core exercise targeting the obliques and rotational strength, performed with a cable machine and a rope attachment to simulate chopping wood from high to low or low to high.', 'Attach a rope to a low pulley. Stand sideways to the machine and grasp the rope with both hands. Rotate your torso and pull the rope across your body, simulating a chopping motion. Return to the starting position and repeat.', 'Focus on controlled motion and avoid using momentum to maximize core engagement and control.', NULL),
	(181, 14, NULL, 'Hanging Leg Circles', 'Core exercise targeting the lower abs and hip flexors, performed hanging from a pull-up bar with legs extended and tracing circular motions.', 'Hang from a pull-up bar with your legs extended. Trace circular motions with your legs, keeping your core engaged throughout the movement.', 'Keep your core tight throughout the movement to maintain stability and control.', NULL),
	(182, 14, NULL, 'Ab Rollouts from Feet', 'Advanced core exercise targeting the entire core, performed with an ab wheel from a kneeling position with feet lifted off the ground for increased difficulty.', 'Kneel on the ground with an ab wheel in front of you. Roll the wheel forward, extending your body into a straight line. Pull the wheel back towards your knees to return to the starting position.', 'Engage your core and avoid letting your hips sag to maintain proper form and prevent injury.', NULL),
	(183, 16, 17, 'Hack Squats', 'Compound exercise targeting the quadriceps, hamstrings, and glutes, performed on a hack squat machine with a sled.', 'Stand on a hack squat machine with your feet shoulder-width apart. Bend your knees and hips to lower your body into a squat, then push back up to the starting position.', 'Keep your knees aligned with your toes to prevent knee strain and ensure proper squat form.', NULL),
	(184, 16, 17, 'Step-Ups', 'Compound exercise engaging the quadriceps, hamstrings, and glutes, performed by stepping onto a raised platform or bench with one foot at a time.', 'Stand in front of a raised platform or bench. Step up onto the platform with one foot, driving through your heel to lift your body. Step back down and repeat with the other leg.', 'Drive through your heel to maximize glute engagement and maintain balance during the step-up.', NULL),
	(185, 21, NULL, 'Leg Press Machine Calf Raises', 'Isolation exercise targeting the calf muscles, performed on a leg press machine by pushing the platform with the balls of the feet.', 'Sit on a leg press machine with your feet on the platform. Push the platform away with the balls of your feet, extending your ankles. Lower the platform back down with control.', 'Use a full range of motion to maximize calf engagement and avoid bouncing at the top.', NULL),
	(186, 17, 11, 'Sumo Deadlifts', 'Compound exercise targeting the inner thighs, hamstrings, and glutes, performed with a wide stance and a barbell or dumbbells.', 'Stand with your feet wider than shoulder-width apart and your toes pointed outwards. Bend at the hips and knees to grasp a barbell with an overhand grip. Lift the barbell by straightening your hips and knees to a standing position. Lower it back to the ground with control.', 'Keep your core engaged and your back flat to maintain proper form and prevent injury.', NULL),
	(187, 16, 17, 'Box Squats', 'Compound exercise targeting the quadriceps, hamstrings, and glutes, performed by squatting onto a box or bench and then standing back up.', 'Stand in front of a box or bench with a barbell on your upper back. Bend at the knees and hips to lower your body onto the box, then stand back up to the starting position.', 'Engage your core and avoid leaning forward to maintain proper form and prevent injury.', NULL),
	(188, 20, 19, 'Zottman Forearm Curls', 'Compound exercise targeting the forearm flexors and extensors, performed by curling dumbbells with palms facing up on the concentric phase and facing down on the eccentric phase.', 'Stand holding a pair of dumbbells with your palms facing forward. Curl the weights up, rotating your wrists at the top so your palms face downwards. Lower the weights back down while keeping your palms facing down.', 'Control the rotation of your wrists to ensure smooth motion and prevent joint strain.', NULL),
	(189, 20, 19, 'Wrist Roller Reverse Grip', 'Isolation exercise targeting the forearm flexors and extensors, performed by rolling up and down a weight attached to a rope with a reverse grip for forearm strength and endurance.', 'Stand with your feet shoulder-width apart, holding a wrist roller with an overhand grip. Roll the weight up by twisting the handle, then slowly lower it back down.', 'Use a controlled motion and avoid using your body weight to roll the weight up and down.', NULL),
	(190, 20, 19, 'Plate Pinch Walks', 'Isometric exercise targeting grip strength and forearm endurance, performed by holding weight plates together between your fingers by the sides for a certain distance to work on grip strength and overall body stability.', 'Stand holding a barbell with an overhand grip at shoulder width. Raise the bar to your chest level while keeping your upper arms parallel to the floor. Lower the barbell back to the starting position with control.', 'Maintain a controlled motion to ensure proper shoulder engagement and avoid using momentum.', NULL),
	(191, 1, 4, 'Bench Press', 'Compound exercise targeting the chest, shoulders, and triceps, performed by pressing a barbell away from the chest while lying on a bench.', 'Stand with a dumbbell in each hand, palms facing your torso. Curl the weights towards your shoulders while keeping your upper arms stationary. Lower the weights back to the starting position.', 'Focus on keeping your upper arms stationary to maximize bicep engagement and avoid using momentum.', 'https://app-media.fitbod.me/v2/29/videos/full_1080p.mp4'),
	(192, 1, NULL, 'Dumbbell Flyes', 'Isolation exercise targeting the chest, performed by lying on a bench and opening the arms wide, lowering dumbbells to the sides, and then bringing them back up.', NULL, NULL, NULL),
	(193, 1, 8, 'Incline Bench Press', 'Compound exercise targeting the upper chest, shoulders, and triceps, performed on an inclined bench with a barbell or dumbbells.', NULL, NULL, NULL),
	(194, 1, 4, 'Chest Dips', 'Compound exercise targeting the lower chest and triceps, performed by lowering and raising the body on parallel bars or dip bars.', NULL, NULL, NULL),
	(195, 1, NULL, 'Cable Crossover', 'Isolation exercise targeting the chest, performed by crossing cables in front of the body at shoulder height to contract the chest muscles.', NULL, NULL, NULL),
	(196, 5, 3, 'Tricep Dumbell kickbacks', 'Isolation exercise targeting the triceps, performed by extending the arm behind the body with a dumbbell while bent over.', NULL, NULL, NULL),
	(197, 5, 7, 'Tricep Rope Pushdowns', 'Isolation exercise targeting the triceps, performed by pushing a rope attachment down towards the thighs with elbows stationary at the sides.', NULL, NULL, NULL),
	(198, 4, 3, 'Overhead Tricep Extension', 'Isolation exercise targeting the triceps, performed by extending a dumbbell or barbell overhead with both hands.', NULL, NULL, NULL),
	(199, 5, 7, 'Close-Grip Bench Press', 'Compound exercise targeting the triceps, performed with a narrow grip on the barbell to emphasize tricep engagement while bench pressing.', NULL, NULL, NULL),
	(200, 4, 5, 'Skull Crushers', 'Isolation exercise targeting the triceps, performed by lowering a barbell or dumbbells towards the forehead while lying on a bench and then extending the arms back up.', NULL, NULL, NULL);

-- Listage des données de la table musclemind.messenger_messages : ~0 rows (environ)

-- Listage des données de la table musclemind.muscle : ~0 rows (environ)
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

-- Listage des données de la table musclemind.muscle_group : ~0 rows (environ)
INSERT INTO `muscle_group` (`id`, `muscle_group`, `muscle_group_image`, `muscle_group_svg_front`, `muscle_group_svg_back`) VALUES
	(1, 'CHEST', 'chest.webp', 'chest.svg', NULL),
	(2, 'TRICEPS', 'triceps.webp', 'triceps.svg', ''),
	(3, 'BICEPS', 'biceps.webp', 'biceps.svg', ''),
	(4, 'SHOULDERS', 'shoulders.webp', 'shoulders.svg', 'shoulders_b.svg'),
	(5, 'BACK', 'back.webp', 'back.svg', 'back_b.svg'),
	(6, 'ABS', 'abs.webp', 'abs.svg', ''),
	(7, 'LEGS', 'legs.webp', 'legs.svg', 'legs_b.svg'),
	(8, 'FOREARMS', 'forearms.webp', 'forearms.svg', 'forearms_b.svg');

-- Listage des données de la table musclemind.performance : ~0 rows (environ)
INSERT INTO `performance` (`id`, `user_performing_id`, `exercice_mesured_id`, `personnal_record`, `date_of_performance`) VALUES
	(6, 1, 191, '110', '2024-06-11 07:12:06');

-- Listage des données de la table musclemind.program : ~0 rows (environ)
INSERT INTO `program` (`id`, `creator_id`, `muscle_group_targeted_id`, `secondary_muscle_group_targeted_id`, `title`) VALUES
	(15, 1, 1, 2, 'seance pec de folie'),
	(16, 1, 7, 8, 'jambes avant bras'),
	(17, 1, 5, 3, 'dos biceps'),
	(18, 1, 1, 4, 'program test');

-- Listage des données de la table musclemind.reset_password_request : ~0 rows (environ)

-- Listage des données de la table musclemind.ressource : ~17 rows (environ)
INSERT INTO `ressource` (`id`, `author_id`, `tag_id`, `content`, `link`, `title`, `created_at`, `updated_at`, `is_published`) VALUES
	(1, 1, 1, 'Taking care of your mental and emotional well-being is just as important as taking care of your physical body. Here are ten tips to help you cultivate better mental and emotional health...', NULL, '10 Tips for Improving Your Mental and Emotional Well-being', '2024-06-11 11:23:58', '2024-06-11 11:23:58', 1),
	(2, 1, 1, 'Regular exercise is crucial for maintaining good physical and mental health. Incorporating weightlifting into your fitness routine can help you build muscle, improve bone density, and boost your metabolism...', NULL, 'The Benefits of Weightlifting for Better Physical Fitness', '2024-06-11 11:23:58', '2024-06-11 11:23:58', 1),
	(3, 1, 1, 'Good nutrition is essential for overall health and well-being. Eating a balanced diet that includes a variety of fruits, vegetables, whole grains, and lean proteins can help you maintain a healthy weight and reduce your risk of chronic diseases...', NULL, 'The Importance of Nutrition for Optimal Health', '2024-05-19 11:23:58', '2024-06-11 11:23:58', 1),
	(5, 1, 1, 'Maintaining strong social connections is essential for mental and emotional well-being. Spending time with friends and loved ones can provide support, reduce feelings of loneliness, and improve your overall quality of life...', NULL, 'The Importance of Social Connections for Mental Health', '2024-06-11 11:23:58', '2024-06-11 11:23:58', 1),
	(6, 1, 2, 'Superfoods are nutrient-rich foods that offer numerous health benefits. Incorporating these foods into your diet can help you improve your overall health and prevent diseases...', NULL, 'Superfoods to Add to Your Diet for Better Health', '2024-05-11 11:23:58', '2024-06-11 11:23:58', 1),
	(7, 1, 2, 'Eating a balanced diet that includes plenty of fruits, vegetables, whole grains, and lean proteins is essential for maintaining good health. Avoiding processed foods, sugary drinks, and excessive amounts of salt and sugar can help you stay healthy and prevent chronic diseases...', NULL, 'Tips for Maintaining a Healthy Diet', '2024-06-05 11:23:58', '2024-06-11 11:23:58', 1),
	(8, 1, 2, 'Antioxidants are compounds that help protect your cells from damage caused by free radicals. Including foods rich in antioxidants, such as berries, nuts, seeds, and leafy greens, in your diet can help support your overall health and well-being...', NULL, 'Foods High in Antioxidants for Radiant Skin', '2024-06-04 11:23:58', '2024-06-11 11:23:58', 1),
	(9, 1, 2, 'Proper hydration is essential for good health. Drinking enough water throughout the day can help keep your body hydrated, improve digestion, flush out toxins, and support healthy skin...', NULL, 'The Importance of Hydration for Overall Health', '2024-05-09 11:23:58', '2024-06-11 11:23:58', 1),
	(10, 1, 2, 'Eating a diet rich in fiber can have numerous health benefits, including improved digestion, reduced risk of heart disease, and better weight management. Foods high in fiber include fruits, vegetables, whole grains, nuts, and seeds...', NULL, 'The Benefits of a High-Fiber Diet for Health', '2024-06-02 11:23:58', '2024-06-11 11:23:58', 1),
	(11, 1, 3, 'Weightlifting is a versatile strength training exercise that offers many health and fitness benefits. By lifting weights regularly and with proper form, you can strengthen your muscles, improve your bone density, and boost your metabolism...', NULL, 'The Benefits of Weightlifting for Better Physical Fitness', '2024-06-11 11:23:58', '2024-06-11 11:23:58', 1),
	(12, 1, 3, 'Incorporating weightlifting into your fitness routine can help you achieve your fitness goals faster. Whether you want to build muscle, burn fat, or improve your overall strength and endurance, weightlifting can help you get there...', NULL, 'How to Incorporate Weightlifting into Your Workout Routine', '2024-05-03 11:23:58', '2024-06-11 11:23:58', 1),
	(13, 1, 3, 'Resistance training, such as weightlifting, can help improve your overall athletic performance. By increasing your strength, power, and muscular endurance, you can perform better in sports and other physical activities...', NULL, 'The Role of Weightlifting in Improving Athletic Performance', '2024-05-30 11:23:58', '2024-06-11 11:23:58', 1),
	(14, 1, 3, 'Weightlifting isn\'t just for bodybuilders. It\'s a beneficial form of exercise for people of all ages and fitness levels. Whether you\'re a beginner or an experienced lifter, you can enjoy the many benefits of weightlifting, including increased muscle tone, improved posture, and enhanced metabolic health...', NULL, 'Why Everyone Should Try Weightlifting', '2024-05-28 11:23:58', '2024-06-11 11:23:58', 1),
	(15, 1, 3, 'Strength training, such as weightlifting, can help reduce your risk of injury by strengthening your muscles and improving your joint stability. By incorporating weightlifting into your fitness routine, you can build a stronger, more resilient body that\'s better equipped to handle the physical demands of everyday life...', NULL, 'How Weightlifting Can Help Prevent Injuries', '2024-04-24 11:23:58', '2024-06-11 11:23:58', 1),
	(16, 1, 1, 'In today\'s fast-paced world, stress has become an all-too-common part of everyday life. From work pressures to personal responsibilities, many people find themselves constantly battling stress and anxiety. One effective method to combat these issues is through the practice of meditation. Meditation, an ancient practice with roots in various cultures and religions, offers numerous benefits for mental and emotional well-being.\n\nUnderstanding Meditation\n\nMeditation involves focusing the mind on a particular object, thought, or activity to achieve a mentally clear and emotionally calm state. There are various types of meditation, including mindfulness meditation, transcendental meditation, and guided meditation, each with its own techniques and goals. Despite the differences, the core principle remains the same: to quiet the mind and achieve a state of relaxation and awareness.\n\nBenefits of Meditation\n\n1. Reduces Stress: One of the most well-documented benefits of meditation is its ability to reduce stress. By focusing on the present moment and letting go of worries about the past or future, meditation helps to calm the mind and reduce the body\'s stress response. Studies have shown that regular meditation can lower cortisol levels, the hormone associated with stress, leading to a more relaxed state.\n\n2. Improves Emotional Health: Meditation can significantly enhance emotional well-being. It promotes a positive outlook on life, increases self-awareness, and helps in managing negative emotions. People who meditate regularly report feeling more content and emotionally stable.\n\n3. Enhances Concentration and Focus: Meditation trains the mind to stay focused on a single point of reference. This practice can improve attention span and cognitive function, making it easier to concentrate on tasks and improve productivity.\n\n4. Promotes Physical Health: The benefits of meditation extend beyond mental health. It can lower blood pressure, improve heart rate, and boost the immune system. By reducing stress, meditation also helps to prevent stress-related illnesses and promotes overall physical health.\n\nHow to Get Started\n\nStarting a meditation practice is simple and doesn\'t require any special equipment. Here are some basic steps to begin:\n\n1. Find a Quiet Space: Choose a place where you won\'t be disturbed. This could be a quiet room in your house, a peaceful spot in a park, or any place where you feel comfortable.\n\n2. Sit Comfortably: Find a comfortable position. You can sit on a chair, on the floor, or even lie down if that\'s more comfortable. The key is to maintain a position where you can stay still and relaxed.\n\n3. Focus on Your Breath: Close your eyes and take deep breaths. Focus on the sensation of your breath entering and leaving your body. If your mind starts to wander, gently bring your focus back to your breath.\n\n4. Start Small: Begin with short sessions, such as 5-10 minutes a day. As you become more comfortable with the practice, you can gradually increase the duration.\n\n5. Be Patient: Meditation is a skill that takes time to develop. Don\'t get discouraged if you find it difficult at first. With regular practice, it will become easier and more beneficial.\n\nConclusion\n\nMeditation is a powerful tool for managing stress and improving overall well-being. By incorporating meditation into your daily routine, you can experience a more relaxed, focused, and emotionally balanced life. Whether you\'re dealing with everyday stressors or seeking to enhance your mental health, meditation offers a simple and effective solution.', NULL, 'The Role of Meditation in Stress Reduction', '2024-05-26 11:23:58', '2024-06-11 11:23:58', 1),
	(17, 1, 1, 'Sleep is an essential component of overall health and well-being, yet it is often overlooked or sacrificed in our busy lives. The importance of sleep extends far beyond merely feeling rested; it plays a critical role in maintaining mental health. Poor sleep can lead to a variety of mental health issues, while good sleep can enhance cognitive function, emotional stability, and overall quality of life.\n\nUnderstanding the Sleep Cycle\n\nSleep is divided into several stages, including light sleep, deep sleep, and REM (rapid eye movement) sleep. Each stage serves a unique function and is essential for various aspects of physical and mental health. During deep sleep, the body repairs and regenerates tissues, builds bone and muscle, and strengthens the immune system. REM sleep, on the other hand, is crucial for cognitive functions such as memory consolidation and learning.\n\nMental Health Benefits of Sleep\n\n1. Enhances Cognitive Function: Adequate sleep is vital for cognitive processes. It improves memory, problem-solving skills, and the ability to learn new information. During sleep, the brain processes and stores information from the day, making it easier to recall and use that information later.\n\n2. Stabilizes Mood: Sleep has a profound impact on mood regulation. Insufficient sleep can lead to irritability, mood swings, and an increased risk of mental health disorders such as depression and anxiety. Good sleep helps maintain emotional stability and resilience.\n\n3. Reduces Stress: Sleep is a natural stress reliever. During sleep, the body reduces levels of stress hormones like cortisol. Lack of sleep, on the other hand, can trigger the body\'s stress response, leading to increased anxiety and tension.\n\n4. Supports Mental Health Treatment: For individuals undergoing treatment for mental health disorders, sleep is a crucial component of recovery. Good sleep can enhance the effectiveness of therapy and medication, and improve overall treatment outcomes.\n\nConsequences of Poor Sleep\n\nPoor sleep, whether due to insomnia, sleep apnea, or other sleep disorders, can have severe consequences for mental health. Chronic sleep deprivation has been linked to a higher risk of developing mental health disorders, impaired cognitive function, and decreased quality of life. Common consequences of poor sleep include:\n\n- Increased Anxiety and Depression: Lack of sleep can exacerbate symptoms of anxiety and depression, making it harder to cope with daily challenges.\n- Cognitive Impairment: Sleep deprivation affects attention, alertness, concentration, and decision-making abilities. This can lead to mistakes, accidents, and reduced productivity.\n- Weakened Immune System: Poor sleep weakens the immune system, making the body more susceptible to infections and illnesses.\n\nTips for Improving Sleep Quality\n\nImproving sleep quality requires adopting healthy sleep habits and creating an environment conducive to restful sleep. Here are some tips to help you get better sleep:\n\n1. Maintain a Regular Sleep Schedule: Go to bed and wake up at the same time every day, even on weekends. This helps regulate your body\'s internal clock and improves sleep quality.\n\n2. Create a Relaxing Bedtime Routine: Engage in calming activities before bed, such as reading, taking a warm bath, or practicing relaxation techniques like deep breathing or meditation.\n\n3. Optimize Your Sleep Environment: Make your bedroom a comfortable and inviting place to sleep. Keep the room cool, dark, and quiet, and invest in a comfortable mattress and pillows.\n\n4. Limit Exposure to Screens: Reduce screen time before bed, as the blue light emitted by phones, tablets, and computers can interfere with your body\'s natural sleep-wake cycle.\n\n5. Watch Your Diet: Avoid large meals, caffeine, and alcohol close to bedtime, as these can disrupt sleep. Instead, opt for light snacks if you\'re hungry before bed.\n\nConclusion\n\nSleep is a cornerstone of mental health, playing a critical role in cognitive function, emotional stability, and overall well-being. Prioritizing good sleep habits and creating a sleep-friendly environment can significantly improve your mental health and quality of life. Remember, sleep is not a luxury but a necessity for maintaining mental and physical health.', NULL, 'The Importance of Sleep for Mental Health', '2024-04-26 11:23:58', '2024-06-11 11:23:58', 1),
	(18, 1, 1, 'Physical activity is widely recognized for its benefits to physical health, but its impact on emotional well-being is equally profound. Regular exercise can enhance mood, reduce symptoms of depression and anxiety, and improve overall mental health. Understanding the connection between physical activity and emotional well-being can help individuals harness the power of exercise to enhance their quality of life.\n\nThe Science Behind Exercise and Emotional Well-being\n\nWhen you engage in physical activity, your body undergoes various physiological changes that positively affect your mental state. Here are some key mechanisms through which exercise influences emotional well-being:\n\n1. Release of Endorphins: Physical activity triggers the release of endorphins, also known as "feel-good" hormones. Endorphins act as natural painkillers and mood elevators, creating a sense of happiness and euphoria often referred to as the "runner\'s high."\n\n2. Reduction of Stress Hormones: Exercise helps reduce levels of stress hormones like cortisol and adrenaline. Lower levels of these hormones lead to a calmer and more relaxed state of mind.\n\n3. Improved Brain Function: Regular exercise enhances brain function by promoting the growth of new neurons and increasing blood flow to the brain. This can improve cognitive abilities, enhance memory, and boost overall brain health.\n\n4. Regulation of Sleep: Exercise can improve sleep quality, which is crucial for emotional well-being. Better sleep helps regulate mood, reduce stress, and improve overall mental health.\n\nEmotional Benefits of Physical Activity\n\n1. Reduces Symptoms of Depression and Anxiety: Exercise is a powerful tool for managing symptoms of depression and anxiety. It helps release tension, reduces feelings of worry, and promotes a sense of calm. Many mental health professionals recommend physical activity as part of a comprehensive treatment plan for these conditions.\n\n2. Enhances Mood: Regular physical activity is associated with improved mood and a greater sense of happiness. It helps combat feelings of sadness, frustration, and irritability, contributing to a more positive outlook on life.\n\n3. Boosts Self-esteem: Exercise can improve self-esteem and body image. Achieving fitness goals, whether big or small, fosters a sense of accomplishment and confidence. Feeling better about one\'s physical appearance and capabilities translates to a more positive self-view.\n\n4. Provides Social Interaction: Participating in group exercise activities or sports offers social benefits that can alleviate feelings of loneliness and isolation. Building connections through shared physical activity fosters a sense of community and support.\n\nHow to Incorporate Physical Activity into Your Life\n\n1. Choose Activities You Enjoy: Finding an activity that you enjoy increases the likelihood that you will stick with it. Whether it\'s running, swimming, dancing, or playing a sport, choose something that makes you feel good.\n\n2. Set Realistic Goals: Start with small, achievable goals and gradually increase the intensity and duration of your workouts. Setting and achieving these goals provides a sense of accomplishment and motivates you to keep going.\n\n3. Make it a Routine: Incorporate physical activity into your daily routine. Whether it\'s a morning jog, a lunchtime walk, or an evening yoga session, consistency is key to reaping the benefits of exercise.\n\n4. Stay Active Throughout the Day: Look for opportunities to be active, even in small ways. Take the stairs instead of the elevator, walk or bike to work, or engage in active hobbies like gardening or playing with your pets.\n\nConclusion\n\nPhysical activity is a powerful tool for enhancing emotional well-being. By understanding and harnessing the mental health benefits of exercise, you can improve your mood, reduce symptoms of depression and anxiety, and boost your overall quality of life. Remember, the key is to find activities you enjoy and make them a regular part of your routine. With consistent effort, you can achieve a healthier, happier, and more emotionally balanced life.', NULL, 'How Physical Activity Influences Emotional Well-being', '2024-04-27 11:23:58', '2024-06-11 11:23:58', 1);

-- Listage des données de la table musclemind.session : ~0 rows (environ)
INSERT INTO `session` (`id`, `program_id`, `user_id`, `date_session`) VALUES
	(254, 17, 1, '2024-06-17 08:43:32'),
	(255, 17, 1, '2024-06-20 08:43:32'),
	(256, 17, 1, '2024-06-24 08:43:32'),
	(257, 17, 1, '2024-06-27 08:43:32'),
	(258, 17, 1, '2024-07-01 08:43:32'),
	(259, 17, 1, '2024-07-04 08:43:32'),
	(260, 17, 1, '2024-07-08 08:43:32'),
	(261, 17, 1, '2024-07-11 08:43:32'),
	(262, 17, 1, '2024-07-15 08:43:32'),
	(263, 17, 1, '2024-07-18 08:43:32'),
	(264, 17, 1, '2024-07-22 08:43:32'),
	(265, 17, 1, '2024-07-25 08:43:32'),
	(266, 17, 1, '2024-07-29 08:43:32'),
	(267, 17, 1, '2024-08-01 08:43:32'),
	(268, 17, 1, '2024-08-05 08:43:32'),
	(269, 17, 1, '2024-08-08 08:43:32'),
	(270, 17, 1, '2024-08-12 08:43:32'),
	(271, 17, 1, '2024-08-15 08:43:32'),
	(272, 17, 1, '2024-08-19 08:43:32'),
	(273, 17, 1, '2024-08-22 08:43:32'),
	(274, 17, 1, '2024-08-26 08:43:32'),
	(275, 17, 1, '2024-08-29 08:43:32'),
	(276, 17, 1, '2024-09-02 08:43:32'),
	(277, 17, 1, '2024-09-05 08:43:32'),
	(278, 17, 1, '2024-09-09 08:43:32'),
	(279, 17, 1, '2024-09-12 08:43:32'),
	(280, 17, 1, '2024-09-16 08:43:32'),
	(281, 17, 1, '2024-09-19 08:43:32'),
	(282, 17, 1, '2024-09-23 08:43:32'),
	(283, 17, 1, '2024-09-26 08:43:32'),
	(284, 17, 1, '2024-09-30 08:43:32'),
	(285, 17, 1, '2024-10-03 08:43:32'),
	(286, 17, 1, '2024-10-07 08:43:32'),
	(287, 17, 1, '2024-10-10 08:43:32'),
	(288, 17, 1, '2024-10-14 08:43:32'),
	(289, 17, 1, '2024-10-17 08:43:32'),
	(290, 17, 1, '2024-10-21 08:43:32'),
	(291, 17, 1, '2024-10-24 08:43:32'),
	(292, 17, 1, '2024-10-28 08:43:32'),
	(293, 17, 1, '2024-10-31 08:43:32'),
	(294, 17, 1, '2024-11-04 08:43:32'),
	(295, 17, 1, '2024-11-07 08:43:32'),
	(296, 17, 1, '2024-11-11 08:43:32'),
	(297, 17, 1, '2024-11-14 08:43:32'),
	(298, 17, 1, '2024-11-18 08:43:32'),
	(299, 17, 1, '2024-11-21 08:43:32'),
	(300, 17, 1, '2024-11-25 08:43:32'),
	(301, 17, 1, '2024-11-28 08:43:32'),
	(302, 17, 1, '2024-12-02 08:43:32'),
	(303, 17, 1, '2024-12-05 08:43:32'),
	(304, 17, 1, '2024-12-09 08:43:32'),
	(305, 15, 1, '2024-06-14 08:43:45'),
	(306, 15, 1, '2024-06-21 08:43:45'),
	(307, 15, 1, '2024-06-28 08:43:45'),
	(308, 15, 1, '2024-07-05 08:43:45'),
	(309, 15, 1, '2024-07-12 08:43:45'),
	(310, 15, 1, '2024-07-19 08:43:45'),
	(311, 15, 1, '2024-07-26 08:43:45'),
	(312, 15, 1, '2024-08-02 08:43:45'),
	(313, 15, 1, '2024-08-09 08:43:45'),
	(314, 15, 1, '2024-08-16 08:43:45'),
	(315, 15, 1, '2024-08-23 08:43:45'),
	(316, 15, 1, '2024-08-30 08:43:45'),
	(317, 15, 1, '2024-09-06 08:43:45'),
	(318, 15, 1, '2024-09-13 08:43:45'),
	(319, 15, 1, '2024-09-20 08:43:45'),
	(320, 15, 1, '2024-09-27 08:43:45'),
	(321, 15, 1, '2024-10-04 08:43:45'),
	(322, 15, 1, '2024-10-11 08:43:45'),
	(323, 15, 1, '2024-10-18 08:43:45'),
	(324, 15, 1, '2024-10-25 08:43:45'),
	(325, 15, 1, '2024-11-01 08:43:45'),
	(326, 15, 1, '2024-11-08 08:43:45'),
	(327, 15, 1, '2024-11-15 08:43:45'),
	(328, 15, 1, '2024-11-22 08:43:45'),
	(329, 15, 1, '2024-11-29 08:43:45'),
	(330, 15, 1, '2024-12-06 08:43:45'),
	(332, 15, 1, '2024-06-18 08:43:58'),
	(333, 15, 1, '2024-06-25 08:43:58'),
	(334, 15, 1, '2024-07-02 08:43:58'),
	(335, 15, 1, '2024-07-09 08:43:58'),
	(336, 15, 1, '2024-07-16 08:43:58'),
	(337, 15, 1, '2024-07-23 08:43:58'),
	(338, 15, 1, '2024-07-30 08:43:58'),
	(339, 15, 1, '2024-08-06 08:43:58'),
	(340, 15, 1, '2024-08-13 08:43:58'),
	(341, 15, 1, '2024-08-20 08:43:58'),
	(342, 15, 1, '2024-08-27 08:43:58'),
	(343, 15, 1, '2024-09-03 08:43:58'),
	(344, 15, 1, '2024-09-10 08:43:58'),
	(345, 15, 1, '2024-09-17 08:43:58'),
	(346, 15, 1, '2024-09-24 08:43:58'),
	(347, 15, 1, '2024-10-01 08:43:58'),
	(348, 15, 1, '2024-10-08 08:43:58'),
	(349, 15, 1, '2024-10-15 08:43:58'),
	(350, 15, 1, '2024-10-22 08:43:58'),
	(351, 15, 1, '2024-10-29 08:43:58'),
	(352, 15, 1, '2024-11-05 08:43:58'),
	(353, 15, 1, '2024-11-12 08:43:58'),
	(354, 15, 1, '2024-11-19 08:43:58'),
	(355, 15, 1, '2024-11-26 08:43:58'),
	(356, 15, 1, '2024-12-03 08:43:58'),
	(357, 15, 1, '2024-12-10 08:43:58'),
	(358, 16, 1, '2024-06-15 08:44:12'),
	(359, 16, 1, '2024-06-22 08:44:12'),
	(360, 16, 1, '2024-06-29 08:44:12'),
	(361, 16, 1, '2024-07-06 08:44:12'),
	(362, 16, 1, '2024-07-13 08:44:12'),
	(363, 16, 1, '2024-07-20 08:44:12'),
	(364, 16, 1, '2024-07-27 08:44:12'),
	(365, 16, 1, '2024-08-03 08:44:12'),
	(366, 16, 1, '2024-08-10 08:44:12'),
	(367, 16, 1, '2024-08-17 08:44:12'),
	(368, 16, 1, '2024-08-24 08:44:12'),
	(369, 16, 1, '2024-08-31 08:44:12'),
	(370, 16, 1, '2024-09-07 08:44:12'),
	(371, 16, 1, '2024-09-14 08:44:12'),
	(372, 16, 1, '2024-09-21 08:44:12'),
	(373, 16, 1, '2024-09-28 08:44:12'),
	(374, 16, 1, '2024-10-05 08:44:12'),
	(375, 16, 1, '2024-10-12 08:44:12'),
	(376, 16, 1, '2024-10-19 08:44:12'),
	(377, 16, 1, '2024-10-26 08:44:12'),
	(378, 16, 1, '2024-11-02 08:44:12'),
	(379, 16, 1, '2024-11-09 08:44:12'),
	(380, 16, 1, '2024-11-16 08:44:12'),
	(381, 16, 1, '2024-11-23 08:44:12'),
	(382, 16, 1, '2024-11-30 08:44:12'),
	(383, 16, 1, '2024-12-07 08:44:12');

-- Listage des données de la table musclemind.tag : ~0 rows (environ)
INSERT INTO `tag` (`id`, `label`) VALUES
	(1, 'weight lifting'),
	(2, 'health'),
	(3, 'nutrition');

-- Listage des données de la table musclemind.tracking : ~0 rows (environ)
INSERT INTO `tracking` (`id`, `user_tracked_id`, `height`, `weight`, `date_of_tracking`) VALUES
	(2, 1, '185', '85', '2024-04-28 21:50:08');

-- Listage des données de la table musclemind.user : ~0 rows (environ)
INSERT INTO `user` (`id`, `username`, `email`, `date_of_birth`, `sex`, `roles`, `password`, `score`, `is_verified`) VALUES
	(1, 'aminebncd', 'aminebncd_pro@hotmail.com', '2001-01-15 00:00:00', 'male', '["ROLE_ADMIN", "ROLE_MODERATOR"]', '$2y$13$9w0wbfZqweUoXdaPcqRHqu4nDNyeSHbWHpL7OHS0yDaNTvdAW8an2', 0, 1);

-- Listage des données de la table musclemind.workout_plan : ~0 rows (environ)
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
	(62, 200, 15, 10, 45),
	(72, 200, 15, 8, 50),
	(73, 157, 16, 12, 40),
	(74, 157, 16, 12, 40),
	(75, 157, 16, 8, 60),
	(76, 157, 16, 8, 80),
	(77, 157, 16, 5, 100);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
