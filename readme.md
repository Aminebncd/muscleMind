# 💪 MuscleMind

**Plateforme complète de gestion d'entraînement et de suivi de progression physique**

MuscleMind est une application web moderne permettant aux utilisateurs de créer des programmes d'entraînement personnalisés, suivre leurs performances, gérer leurs sessions, et analyser leur progression au fil du temps.

---

## 🚀 Architecture

### Stack Technique

#### Backend - API Platform

- **Framework**: Symfony 7.0
- **API**: API Platform 4.0 (REST + GraphQL)
- **Base de données**: MySQL 8.0
- **ORM**: Doctrine ORM 3.5
- **Authentification**: JWT (LexikJWTAuthenticationBundle)
- **Email**: Symfony Mailer + SendGrid
- **Cache**: Redis
- **Sécurité**:
  - reCAPTCHA v3 (anti-spam)
  - Email verification
  - Password reset
  - Role-based access control (Admin, Moderator, User)

#### Frontend - React

- **Framework**: React 18
- **Build**: Vite
- **UI Library**: Material-UI (MUI)
- **Routing**: React Router DOM
- **State Management**: React Query + Context API
- **HTTP Client**: Axios
- **Testing**: Vitest

#### DevOps

- **Containerisation**: Docker + Docker Compose
- **Serveur Web**: Nginx
- **PHP**: PHP 8.2-FPM
- **Node.js**: Node 20 Alpine

---

## 📋 Prérequis

### Option 1: Docker (Recommandé)

- Docker Desktop (Windows/Mac) ou Docker Engine (Linux)
- Docker Compose v2+

### Option 2: Installation Locale

- PHP 8.2+ avec extensions: `pdo_mysql`, `intl`, `opcache`, `apcu`
- Composer 2.x
- Node.js 20+ et npm
- MySQL 8.0+
- Redis (optionnel mais recommandé)

---

## 🛠️ Installation

### Avec Docker (Méthode Rapide)

```bash
# 1. Cloner le projet
git clone https://github.com/votre-repo/muscleMind.git
cd muscleMind

# 2. Copier les fichiers d'environnement
cp .env.example .env
cp backend/.env.example backend/.env.local
cp frontend/.env.example frontend/.env.local

# 3. Configurer les variables d'environnement
# Éditer .env, backend/.env.local et frontend/.env.local

# 4. Lancer les conteneurs
docker compose up -d

# 5. Installer les dépendances PHP
docker compose exec web composer install

# 6. Créer la base de données et exécuter les migrations
docker compose exec web php bin/console doctrine:database:create --if-not-exists
docker compose exec web php bin/console doctrine:migrations:migrate --no-interaction

# 7. Générer les clés JWT
docker compose exec web php bin/console lexik:jwt:generate-keypair

# 8. Installer les dépendances frontend
docker compose exec frontend npm install

# 9. Accéder à l'application
# Frontend: http://localhost:3000
# Backend API: http://localhost:8000/api
# API Docs: http://localhost:8000/api/docs
# Mailpit: http://localhost:8025
```

### Sans Docker (Installation Locale)

#### Backend

```bash
# 1. Installer les dépendances
cd backend
composer install

# 2. Configurer la base de données
# Éditer .env.local avec vos credentials MySQL
DATABASE_URL="mysql://root:password@127.0.0.1:3306/musclemind"

# 3. Créer la base et migrer
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# 4. Générer les clés JWT
php bin/console lexik:jwt:generate-keypair

# 5. Lancer le serveur de développement
symfony serve -d
# ou
php -S localhost:8000 -t public
```

#### Frontend

```bash
# 1. Installer les dépendances
cd frontend
npm install

# 2. Configurer l'URL de l'API
# Éditer .env.local
VITE_API_URL=http://localhost:8000

# 3. Lancer le serveur de développement
npm run dev
```

---

## 🎯 Utilisation

### Accès à l'Application

| Service           | URL                               | Description           |
| ----------------- | --------------------------------- | --------------------- |
| Frontend React    | http://localhost:3000             | Interface utilisateur |
| API Backend       | http://localhost:8000/api         | API REST/GraphQL      |
| API Documentation | http://localhost:8000/api/docs    | Swagger UI            |
| GraphiQL          | http://localhost:8000/api/graphql | GraphQL Playground    |
| Admin Panel       | http://localhost:8000/admin       | EasyAdmin (legacy)    |
| Mailpit           | http://localhost:8025             | Emails de test        |

### Créer un Compte Administrateur

```bash
# Avec Docker
docker compose exec web php bin/console app:create-admin

# Sans Docker
php bin/console app:create-admin
```

### Commandes Utiles

#### Docker

```bash
# Voir les logs
docker compose logs -f [service]

# Arrêter les conteneurs
docker compose down

# Reconstruire les images
docker compose build --no-cache

# Accéder à un conteneur
docker compose exec web bash
docker compose exec frontend sh

# Nettoyer le cache Symfony
docker compose exec web php bin/console cache:clear
```

#### Symfony (Backend)

```bash
# Cache
php bin/console cache:clear
php bin/console cache:warmup

# Base de données
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load

# Tests
php bin/phpunit

# Debug
php bin/console debug:router
php bin/console debug:config
```

#### React (Frontend)

```bash
# Build de production
npm run build

# Preview du build
npm run preview

# Tests
npm run test

# Linter
npm run lint
```

---

## 📚 Documentation API

### Endpoints d'Authentification

#### Inscription

```http
POST /api/auth/register
Content-Type: application/json

{
  "email": "user@example.com",
  "username": "username",
  "password": "Password123!",
  "dateOfBirth": "1990-01-01",
  "sex": "M"
}
```

#### Connexion

```http
POST /api/auth/login
Content-Type: application/json

{
  "username": "username",
  "password": "Password123!"
}

Response:
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbG..."
}
```

#### Profil Utilisateur

```http
GET /api/auth/me
Authorization: Bearer {token}
```

### Endpoints Principaux

| Resource      | GET (List)           | GET (Item)                | POST  | PATCH | DELETE |
| ------------- | -------------------- | ------------------------- | ----- | ----- | ------ |
| Programs      | `/api/programs`      | `/api/programs/{id}`      | ✅    | ✅    | ✅     |
| Sessions      | `/api/sessions`      | `/api/sessions/{id}`      | ✅    | ✅    | ✅     |
| Exercises     | `/api/exercices`     | `/api/exercices/{id}`     | Admin | Admin | Admin  |
| Performances  | `/api/performances`  | `/api/performances/{id}`  | ✅    | ✅    | ✅     |
| Tracking      | `/api/trackings`     | `/api/trackings/{id}`     | ✅    | ✅    | ✅     |
| Muscle Groups | `/api/muscle_groups` | `/api/muscle_groups/{id}` | Admin | Admin | Admin  |
| Resources     | `/api/ressources`    | `/api/ressources/{id}`    | ✅    | ✅    | ✅     |

**Légende:**

- ✅ : Accessible par l'utilisateur authentifié (propriétaire)
- Admin : Réservé aux administrateurs
- Vide : Accessible publiquement

---

## 📁 Structure du Projet

```
muscleMind/
├── backend/                    # API Symfony + API Platform
│   ├── config/                 # Configuration Symfony
│   ├── migrations/             # Migrations Doctrine
│   ├── public/                 # Point d'entrée web
│   ├── src/
│   │   ├── Controller/         # Controllers API
│   │   ├── Entity/             # Entités Doctrine
│   │   ├── Repository/         # Repositories
│   │   └── Security/           # Services de sécurité
│   ├── templates/              # Templates Twig (emails)
│   └── composer.json
│
├── frontend/                   # Application React
│   ├── public/                 # Assets statiques
│   ├── src/
│   │   ├── components/         # Composants React
│   │   ├── pages/              # Pages principales
│   │   ├── context/            # Context API (Auth, Theme)
│   │   ├── services/           # Services API
│   │   └── App.jsx
│   ├── package.json
│   └── vite.config.js
│
├── src/                        # Code legacy (monolithe Symfony)
├── templates/                  # Templates Twig legacy
├── docker-compose.yml          # Configuration Docker
├── Dockerfile                  # Image Docker backend
├── Dockerfile.frontend         # Image Docker frontend
└── README.md
```

---

## ✨ Fonctionnalités

### Gestion d'Entraînement

- ✅ Création de programmes personnalisés
- ✅ Planification de sessions (manuelle + auto)
- ✅ Bibliothèque d'exercices avec instructions
- ✅ Ciblage musculaire (principal + secondaire)
- ✅ Suivi des poids et répétitions

### Suivi de Performance

- ✅ Enregistrement des records personnels
- ✅ Historique des performances
- ✅ Graphiques de progression
- ✅ Suivi du poids corporel
- ✅ Calendrier d'entraînement

### Communauté

- ✅ Partage de ressources éducatives
- ✅ Système de tags
- ✅ Classement (Leaderboard)
- ✅ Système de points

### Anatomie

- ✅ Catalogue de groupes musculaires
- ✅ Détails anatomiques des muscles
- ✅ Visualisation SVG (avant/arrière)
- ✅ Exercices par muscle ciblé

---

## 🔒 Sécurité

### Authentification

- Tokens JWT avec expiration
- Refresh tokens
- Email verification obligatoire
- reCAPTCHA v3 anti-spam

### Autorisation

- Role-based access control (RBAC)
- Owner-based access (ressources utilisateur)
- API rate limiting (à configurer)

### Données

- Passwords hashés (bcrypt)
- HTTPS obligatoire en production
- CORS configuré
- SQL injection protection (Doctrine ORM)
- XSS protection (React)

---

## 🧪 Tests

### Backend

```bash
# Tests unitaires et fonctionnels
php bin/phpunit

# Coverage
php bin/phpunit --coverage-html var/coverage
```

### Frontend

```bash
# Tests unitaires
npm run test

# Tests avec coverage
npm run test:coverage
```

---

## 🚢 Déploiement

### Production avec Docker

```bash
# 1. Build des images de production
docker compose -f docker-compose.prod.yml build

# 2. Lancer en production
docker compose -f docker-compose.prod.yml up -d

# 3. Migrations
docker compose exec web php bin/console doctrine:migrations:migrate --no-interaction

# 4. Optimisation
docker compose exec web php bin/console cache:clear --env=prod
docker compose exec frontend npm run build
```

### Variables d'Environnement Importantes

```env
# Backend (.env.local)
APP_ENV=prod
APP_SECRET=your-secret-key
DATABASE_URL=mysql://user:pass@db:3306/musclemind
JWT_PASSPHRASE=your-jwt-passphrase
MAILER_DSN=smtp://user:pass@smtp.sendgrid.net:587
RECAPTCHA_SITE_KEY=your-recaptcha-key

# Frontend (.env.local)
VITE_API_URL=https://api.musclemind.com
VITE_RECAPTCHA_SITE_KEY=your-recaptcha-key
```

---

## 🤝 Contribution

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

---

## 📝 License

Ce projet est sous license MIT. Voir le fichier `LICENSE` pour plus de détails.

---

## 👨‍💻 Auteur

**Amine** - [GitHub](https://github.com/Aminebncd)

---

## 🙏 Remerciements

- Symfony & API Platform communities
- React & Material-UI teams
- Tous les contributeurs open-source

---

## 📞 Support

Pour toute question ou problème:

- 📧 Email: support@musclemind.com
- 🐛 Issues: [GitHub Issues](https://github.com/votre-repo/muscleMind/issues)
- 📖 Documentation: [Wiki](https://github.com/votre-repo/muscleMind/wiki)
