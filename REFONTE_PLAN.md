# Plan de Refonte MuscleMind

Ce document détaille les étapes techniques pour réarchitecturer le projet MuscleMind, en se limitant strictement aux deux axes majeurs : l'intégration de ExerciseDB (gestion des médias) et la refonte visuelle minimaliste.

---

## Axe 1 : Remplacement par l'API ExerciseDB (Sync & Cache Backend)

### 1.1. Mise à jour de la Base de Données (Entités)
- [ ] Modifier l'entité `Exercice` : 
  - Ajouter `apiId` (string, unique, nullable) pour garder une trace de l'ID externe.
  - Ajouter `gifUrl` (string, nullable) pour stocker le lien du média fourni par l'API.
  - (Optionnel) Adapter ou cleaner des champs comme `videoExplication`.
- [ ] Générer et appliquer la migration Doctrine (`make:migration` -> `doctrine:migrations:migrate`).

### 1.2. Client d'API `ExerciseDBClient`
- [ ] Ajouter les variables d'environnement (`RAPIDAPI_KEY`, `RAPIDAPI_HOST`) dans `.env` et `.env.local`.
- [ ] Créer le service `src/Service/ExerciseDBClient.php`.
- [ ] Implémenter l'utilisation de `HttpClientInterface` pour faire les calls API REST (endpoints `/exercises`, etc.) en respectant les headers requis par RapidAPI.

### 1.3. Commande de Synchronisation locale (Cache)
- [ ] Créer une console command Symfony : `src/Command/SyncExercisesCommand.php` (`app:sync-exercises`).
- [ ] Implémenter la logique métier de synchronisation :
  - Fetch des données depuis le `ExerciseDBClient`.
  - Parcours des données et création/mise à jour (upsert) des entités `Muscle` et `Exercice`.
  - Lier correctement l'exercice à ses muscles cibles.
- [ ] Planification de la commande (soit via le composant Symfony Scheduler, soit documentation pour l'ajout en crontab serveur).

---

## Axe 2 : Refonte Visuelle Minimaliste et UI/UX (Frontend)

### 2.1. Nettoyage et Configuration Base TailwindCSS
- [ ] Suppression des anciens assets lourds et médias stockés localement (dans `/public/` ou autre dossier d'uploads).
- [ ] Nettoyage massif de `tailwind.config.js` :
  - Suppression des box-shadow lourdes (`glass`, `neumorph`, etc.).
  - Transition vers une palette de couleurs stricte (blanc, noir, nuances de gris, et une couleur d'accent pour l'action `primary`.
  - Maintien exclusif de la typographie existante "Inter".
- [ ] Épuration de `assets/styles/app.css` ou équivalent.

### 2.2. Implémentation du système de chargement (Skeletons)
- [ ] Créer un contrôleur Stimulus (`assets/controllers/image-loader_controller.js`) gérant l'écoute de l'événement `load` des images.
- [ ] Concevoir une classe CSS Tailwind de Skeleton (ex: `.animate-pulse`, zone grisée) qui s'affiche via Twig par défaut.
- [ ] Dès que l'image est chargée, le contrôleur Stimulus désactive le Skeleton et fait une transition douce (fade-in) sur le GIF.

### 2.3. Refonte des Vues (Mobile-First)
- [ ] Refonte exhaustive du Layout global (`templates/base.html.twig`) : Navbars et structure principale allégée.
- [ ] Refonte de l'index des exercices / Dashboard : Remplacement par un design épuré, privilégiant les listicles ou le système de Grid avec la mise en avant de la stat (progression) et suppression de tout le *clutter* visuel.
- [ ] Validation responsive sur écran étroit (approche Mobile-First native de Tailwind).
