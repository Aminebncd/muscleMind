# MuscleMind API Platform Backend

Ce dossier contient un squelette Symfony 7 + API Platform 3 prêt à être branché à une base de données MySQL et sécurisé par JWT.

## Installation

```bash
cd backend
cp .env.example .env # (ou personnalisez directement .env)
composer install
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate
php bin/console lexik:jwt:generate-keypair --overwrite --no-interaction
symfony server:start -d --dir=public
```

## Points clés

- **API Platform** expose automatiquement les entités `User`, `TrainingProgram`, `TrainingSession` en REST et GraphQL.
- **Groupes de sérialisation** (`user:read`, `program:write`, etc.) contrôlent précisément les champs exposés.
- **JWT** via LexikJWTAuthenticationBundle protège toutes les routes sauf `/auth/login`.
- **Filtres** (recherche, dates) et **pagination** sont activés.
- **Swagger UI** et **GraphiQL** sont livrés par API Platform.
- **Console Symfony** (`bin/console`) et point d'entrée HTTP (`public/index.php`) sont déjà prêts, ce qui permet de lancer des commandes standard (`cache:clear`, `messenger:consume`, etc.).

## Tests

```bash
php bin/phpunit
```

Le test d'exemple `ProgramApiTest` vérifie la pagination et le schéma JSON-LD retourné.

> Le bootstrap PHPUnit prépare un schéma SQLite éphémère grâce à Doctrine `SchemaTool`. Aucun serveur MySQL n'est nécessaire pour les tests.

## Structure

```
backend/
├── bin/                # console Symfony
├── config/             # configuration Framework/API Platform/JWT
├── public/             # front-controller HTTP
├── src/Entity          # entités Doctrine exposées via API Platform
├── tests/              # ApiTestCase + bootstrap Dotenv
├── translations/       # i18n (vide par défaut)
└── var/                # caches et logs ignorés par git
```

## Ajouter une ressource

1. Créer l'entité Doctrine dans `src/Entity`.
2. L'annoter avec `#[ApiResource]` en définissant les opérations et groupes.
3. Générer la migration (`php bin/console make:migration`).
4. Implémenter la politique de sécurité (`security.yaml`).
5. Tester via PHPUnit et via la console API Platform (`/docs`).
