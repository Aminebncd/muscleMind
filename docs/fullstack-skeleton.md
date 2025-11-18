# MuscleMind API Platform + React Skeleton

Ce document décrit comment les dossiers `backend/` et `frontend/` interagissent pour fournir une application complète.

## Flux d'authentification

1. L'utilisateur saisit ses identifiants dans la page React `/login`.
2. `loginRequest` appelle `POST http://localhost:8000/auth/login` (géré par Symfony Security + Lexik JWT).
3. Le token reçu est stocké via `AuthContext` et ajouté dans les en-têtes Axios.
4. Les requêtes vers `/training_programs` et `/training_sessions` sont protégées par `security.yaml`.

## Exemple de requête

### Création d'un programme

```
POST /training_programs
Authorization: Bearer <JWT>
Content-Type: application/json

{
  "name": "Hypertrophie 6 semaines",
  "description": "Push/Pull/Legs",
  "isPublished": true
}
```

### Réponse JSON-LD

```
HTTP/1.1 201 Created
Content-Type: application/ld+json

{
  "@context": "/contexts/TrainingProgram",
  "@id": "/training_programs/1",
  "@type": "TrainingProgram",
  "name": "Hypertrophie 6 semaines",
  "description": "Push/Pull/Legs",
  "isPublished": true,
  "sessions": []
}
```

## Ajouter une nouvelle fonctionnalité

1. Décrire le besoin dans `docs/`.
2. Créer entité + tests côté backend.
3. Exposer la ressource via API Platform.
4. Ajouter un service React Query + composant UI.
5. Documenter les routes dans Swagger (`/docs`) et dans le README frontend.

## Démarrage rapide (local)

```bash
# Backend API Platform
cd backend
composer install
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate
php bin/console lexik:jwt:generate-keypair --overwrite
symfony server:start -d --dir=public

# Frontend React
cd ../frontend
npm install
npm run dev
```

Les tests automatisés peuvent s'exécuter sans MySQL grâce à SQLite (`php bin/phpunit` côté backend, `npm run test` côté frontend).
