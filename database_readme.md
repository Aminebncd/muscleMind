# Structure de la Base de Données - MuscleMind

Cette documentation liste les entités Doctrine (et donc les tables de la base de données) de l'application MuscleMind avec leurs propriétés et leurs relations.

## 1. Utilisateurs (Users & Authentication)

### `User`
Table principale stockant les informations des membres.
- **Colonnes** : `id`, `username`, `email` (Unique), `dateOfBirth`, `sex`, `roles` (JSON array), `password`, `score`, `isVerified`, `lastResetYear`
- **Relations** : 
  - *OneToMany* vers `Tracking` (historique corporel)
  - *OneToMany* vers `Performance` (records personnels)
  - *OneToMany* vers `Session` (séances planifiées/effectuées)
  - *OneToMany* vers `Program` (créateur des programmes)
  - *OneToMany* vers `Ressource` (auteur de ressources)
  - *ManyToMany* vers `Ressource` (ressources favorites)

## 2. Bibliothèque d'Exercices et Muscles

### `Exercice`
Désigne un mouvement exécutable. Connecté à ExerciseDB via `apiId`.
- **Colonnes** : `id`, `exerciceName`, `apiId`, `gifUrl`, `exerciceFunction`, `howToPerform`, `proTip`, `videoExplication`
- **Relations** :
  - *ManyToOne* vers `Muscle` (target - muscle principal)
  - *ManyToOne* vers `Muscle` (secondaryTarget - muscle secondaire)
  - *OneToMany* vers `Performance`
  - *OneToMany* vers `WorkoutPlan`

### `Muscle`
Représente un muscle spécifique ciblé par un exercice.
- **Colonnes** : `id`, `muscleName`, `muscleFunction`
- **Relations** :
  - *ManyToOne* vers `MuscleGroup` (le groupe musculaire père)
  - *OneToMany* vers `Exercice` (en tant que muscle principal et secondaire)

### `MuscleGroup`
Les grands groupes musculaires (ex: Dos, Pectoraux, Bras). Utilisé pour la classification visuelle.
- **Colonnes** : `id`, `muscleGroup` (nom), `muscleGroupImage`, `muscleGroupSvgFront`, `muscleGroupSvgBack`
- **Relations** :
  - *OneToMany* vers `Muscle`

## 3. Programmes et Séances d'entraînement

### `Program`
Un programme d'entraînement créé par un utilisateur, constitué de plusieurs exercices.
- **Colonnes** : `id`, `title`, `color`
- **Relations** :
  - *ManyToOne* vers `User` (créateur)
  - *ManyToOne* vers `MuscleGroup` (muscleGroupTargeted)
  - *ManyToOne* vers `MuscleGroup` (secondaryMuscleGroupTargeted)
  - *OneToMany* vers `WorkoutPlan` (exercices contenus, cascade)
  - *OneToMany* vers `Session` (sessions reliées à ce programme)

### `WorkoutPlan`
Modélise la liaison entre un Exercice et un Programme (le volume de travail d'un exercice dans un programme).
- **Colonnes** : `id`, `numberOfRepetitions`, `weightsUsed`, `intensificationMethod`
- **Relations** :
  - *ManyToOne* vers `Program`
  - *ManyToOne* vers `Exercice`

### `Session`
Une instance ou date d'exécution d'un programme d'entraînement par un utilisateur.
- **Colonnes** : `id`, `dateSession`
- **Relations** :
  - *ManyToOne* vers `User`
  - *ManyToOne* vers `Program`

## 4. Suivi et Performances

### `Tracking`
Historique biométrique de l'utilisateur (poids, taille) à un jour J.
- **Colonnes** : `id`, `height`, `weight`, `dateOfTracking`
- **Relations** :
  - *ManyToOne* vers `User` (userTracked)

### `Performance`
Enregistrement des records personnels (Personal Records) pour un exercice précis.
- **Colonnes** : `id`, `personnalRecord`, `dateOfPerformance`
- **Relations** :
  - *ManyToOne* vers `User` (userPerforming)
  - *ManyToOne* vers `Exercice` (exerciceMesured)

## 5. Ressources Externes (Blog / Articles)

### `Ressource`
Articles ou liens externes utiles pour la nutrition ou la santé musculaire.
- **Colonnes** : `id`, `content`, `link`, `title`, `createdAt`, `updatedAt`, `isPublished`
- **Relations** :
  - *ManyToOne* vers `User` (Author)
  - *ManyToOne* vers `Tag`

### `Tag`
Catégories attribuées aux ressources (ex: health, nutrition).
- **Colonnes** : `id`, `label`
- **Relations** :
  - *OneToMany* vers `Ressource`
