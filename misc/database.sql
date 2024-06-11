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

-- Listage des données de la table musclemind.doctrine_migration_versions : ~9 rows (environ)
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
	('DoctrineMigrations\\Version20240606085929', '2024-06-06 08:59:55', 90);

-- Listage des données de la table musclemind.exercice : ~58 rows (environ)
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

-- Listage des données de la table musclemind.muscle : ~21 rows (environ)
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

-- Listage des données de la table musclemind.muscle_group : ~8 rows (environ)
INSERT INTO `muscle_group` (`id`, `muscle_group`, `muscle_group_image`, `muscle_group_svg_front`, `muscle_group_svg_back`) VALUES
	(1, 'CHEST', 'chest.webp', 'chest.svg', NULL),
	(2, 'TRICEPS', 'triceps.webp', 'triceps.svg', ''),
	(3, 'BICEPS', 'biceps.webp', 'biceps.svg', ''),
	(4, 'SHOULDERS', 'shoulders.webp', 'shoulders.svg', 'shoulders_b.svg'),
	(5, 'BACK', 'back.webp', 'back.svg', 'back_b.svg'),
	(6, 'ABS', 'abs.webp', 'abs.svg', ''),
	(7, 'LEGS', 'legs.webp', 'legs.svg', 'legs_b.svg'),
	(8, 'FOREARMS', 'forearms.webp', 'forearms.svg', 'forearms_b.svg');

-- Listage des données de la table musclemind.performance : ~2 rows (environ)
INSERT INTO `performance` (`id`, `user_performing_id`, `exercice_mesured_id`, `personnal_record`, `date_of_performance`) VALUES
	(4, 1, 191, '105', '2024-06-08 00:00:00' ),
	(5, 1, 191, '110', '2024-06-08 00:00:00' );


-- Listage des données de la table musclemind.tag : ~3 rows (environ)
INSERT INTO `tag` (`id`, `label`) VALUES
	(1, 'weight lifting'),
	(2, 'health'),
	(3, 'nutrition');

-- Listage des données de la table musclemind.user : ~1 rows (environ)
INSERT INTO `user` (`id`, `username`, `email`, `date_of_birth`, `sex`, `roles`, `password`, `score`, `is_verified`) VALUES
	(1, 'aminebncd', 'aminebncd_pro@hotmail.com', '2001-01-15 00:00:00', 'male', '["ROLE_ADMIN", "ROLE_MODERATOR"]', '$2y$13$9w0wbfZqweUoXdaPcqRHqu4nDNyeSHbWHpL7OHS0yDaNTvdAW8an2', 15210, 1);

-- Listage des données de la table musclemind.tracking : ~3 rows (environ)
INSERT INTO `tracking` (`id`, `user_tracked_id`, `height`, `weight`, `date_of_tracking`) VALUES
	(2, 1, '185', '85', '23', '0', '2024-04-28 21:50:08'),
	(3, 1, '185', '89', '23', '0', '2024-04-28 22:20:16'),
	(4, 1, '186', '89', '23', '0', '2024-04-30 20:22:59');


-- Listage des données de la table musclemind.program : ~3 rows (environ)
INSERT INTO `program` (`id`, `creator_id`, `muscle_group_targeted_id`, `secondary_muscle_group_targeted_id`, `title`) VALUES
	(15, 1, 1, 2, 'seance pec de folie'),
	(16, 1, 7, 8, 'jambes avant bras'),
	(17, 1, 5, 3, 'dos biceps'),
	(18, 1, 1, 4, 'program test');

-- Listage des données de la table musclemind.session : ~21 rows (environ)
INSERT INTO `session` (`id`, `program_id`, `user_id`, `date_session`) VALUES
	(232, 15, 1, '2024-05-30 21:22:05'),
	(233, 15, 1, '2024-06-03 21:22:05'),
	(234, 15, 1, '2024-06-06 21:22:05'),
	(235, 17, 1, '2024-06-01 14:47:29'),
	(236, 17, 1, '2024-06-05 14:47:29'),
	(237, 17, 1, '2024-06-08 14:47:29'),
	(238, 17, 1, '2024-06-12 14:47:29'),
	(239, 17, 1, '2024-06-15 14:47:29'),
	(240, 17, 1, '2024-06-19 14:47:29'),
	(241, 17, 1, '2024-06-22 14:47:29'),
	(242, 17, 1, '2024-06-26 14:47:29'),
	(243, 17, 1, '2024-06-29 14:47:29'),
	(244, 16, 1, '2024-06-03 14:47:40'),
	(245, 16, 1, '2024-06-06 14:47:40'),
	(246, 16, 1, '2024-06-10 14:47:40'),
	(247, 16, 1, '2024-06-13 14:47:40'),
	(248, 16, 1, '2024-06-17 14:47:40'),
	(249, 16, 1, '2024-06-20 14:47:40'),
	(250, 16, 1, '2024-06-24 14:47:40'),
	(251, 16, 1, '2024-06-27 14:47:40'),
	(252, 16, 1, '2024-07-01 14:47:40');
-- Listage des données de la table musclemind.workout_plan : ~17 rows (environ)
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
