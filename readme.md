# 💪 MuscleMind - Intelligent Fitness Tracking Platform

> **Une application web moderne de suivi fitness développée avec Symfony 7, offrant une expérience utilisateur exceptionnelle et des fonctionnalités avancées de tracking sportif.**

[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Symfony](https://img.shields.io/badge/Symfony-7.0-000000?style=for-the-badge&logo=symfony&logoColor=white)](https://symfony.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)

## 🚀 Présentation du Projet

**MuscleMind** est une plateforme complète de suivi fitness développée avec **Symfony 7** et une architecture moderne. Cette application web permet aux utilisateurs de créer, planifier et suivre leurs programmes d'entraînement avec une interface utilisateur intuitive et des fonctionnalités avancées de visualisation des données.

### 🎯 Objectifs du Projet

- **Démonstration de compétences** : Showcase complet des technologies web modernes
- **Architecture robuste** : Implémentation des meilleures pratiques de développement
- **Expérience utilisateur** : Interface moderne avec design system cohérent
- **Scalabilité** : Code maintenable et extensible

## 🛠️ Stack Technique

### Backend
- **Framework** : Symfony 7.0 (PHP 8.2+)
- **ORM** : Doctrine ORM 3.1
- **Base de données** : MySQL 8.0
- **Sécurité** : Symfony Security Bundle avec authentification complète
- **Tests** : PHPUnit 9.5

### Frontend
- **Template Engine** : Twig 3.0
- **CSS Framework** : TailwindCSS 3.4
- **JavaScript** : Vanilla JS + Stimulus
- **Charts** : Chart.js 4.4 avec plugins avancés
- **Build Tools** : Webpack Encore

### DevOps & Outils
- **Bundler** : Composer (PHP) + NPM (JavaScript)
- **Migration** : Doctrine Migrations
- **Admin Panel** : EasyAdmin 4.10
- **Email** : Symfony Mailer
- **Validation** : Symfony Validator

## 🏗️ Architecture & Patterns

### Architecture MVC
```
src/
├── Controller/          # Contrôleurs (17 controllers)
├── Entity/             # Entités Doctrine (12 entités)
├── Repository/         # Repositories (12 repositories)
├── Service/            # Services métier (3 services)
├── Form/               # Formulaires Symfony (5 types)
├── Security/           # Sécurité et authentification
└── EventSubscriber/    # Événements personnalisés
```

### Entités Principales
- **User** : Gestion des utilisateurs avec rôles (Admin, Moderator, User)
- **Program** : Programmes d'entraînement personnalisés
- **Session** : Sessions planifiées avec calendrier
- **WorkoutPlan** : Plans d'exercices détaillés
- **Performance** : Suivi des performances utilisateur
- **Exercice** : Base de données d'exercices (58 exercices pour l'instant)
- **Muscle/MuscleGroup** : Anatomie et ciblage musculaire
- **Ressource** : Système de ressources partagées

## ✨ Fonctionnalités Principales

### 🔐 Système d'Authentification
- Inscription/Connexion sécurisée
- Gestion des rôles et permissions
- Reset de mot de passe
- Validation d'email

### 📊 Gestion des Programmes
- Création de programmes d'entraînement personnalisés
- Planification automatique et manuelle
- Gestion des séries, répétitions et charges
- Méthodes d'intensification avancées

### 📈 Suivi des Performances
- Tracking détaillé des performances
- Graphiques interactifs avec Chart.js
- Zoom et navigation dans les données
- Matrices de progression

### 🎨 Interface Utilisateur
- Design system complet avec Glassmorphism
- Mode sombre/clair avec transition automatique
- Responsive design (mobile-first)
- Animations et micro-interactions

### 👥 Administration
- Panel d'administration avec EasyAdmin
- Gestion des utilisateurs et contenus
- Système de ressources partagées
- Modération et validation

## 🎨 Design System & Architecture CSS

### Structure CSS Modulaire
```
public/css/
├── main-components.css     # Point d'entrée principal
├── layout.css             # Structure et mise en page
├── components.css         # Composants réutilisables
├── mobile-menu.css        # Navigation mobile
├── theme-toggle.css       # Gestion des thèmes
├── utilities.css          # Classes utilitaires
└── animations.css         # Animations et keyframes
```

### Composants Twig Modulaires
```
templates/_components/
├── header.html.twig       # Navigation principale
├── sidebar.html.twig      # Menu mobile
├── footer.html.twig       # Footer avec liens sociaux
├── mobile-menu-script.html.twig    # Scripts menu mobile
└── theme-toggle-script.html.twig   # Scripts thème
```

## 🔧 Installation & Configuration

### Prérequis
- PHP 8.2 ou supérieur
- Composer 2.0+
- Node.js 16+ & NPM
- MySQL 8.0
- Symfony CLI (optionnel)

### Installation Rapide
```bash
# Cloner le repository
git clone https://github.com/Aminebncd/muscleMind.git
cd muscleMind

# Installer les dépendances PHP
composer install

# Installer les dépendances JavaScript
npm install

# Configuration environnement
cp .env .env.local
# Éditer .env.local avec vos paramètres de base de données

# Créer la base de données
php bin/console doctrine:database:create

# Exécuter les migrations
php bin/console doctrine:migrations:migrate

# Charger les données initiales (optionnel)
# Utiliser les requêtes INSERT dans misc/database.sql

# Compiler les assets
npm run build

# Démarrer le serveur
symfony server:start
# ou
php -S localhost:8000 -t public
```

## 🎯 Fonctionnalités Avancées

### Système de Graphiques
- **Chart.js 4.4** avec plugins de zoom
- **Matrices de progression** avec chartjs-chart-matrix
- **Graphiques interactifs** avec navigation temporelle
- **Responsive charts** adaptatifs

### Sécurité
- **CSRF Protection** sur tous les formulaires
- **Validation côté serveur** avec Symfony Validator
- **Hashage sécurisé** des mots de passe
- **Gestion des permissions** par rôles

### Performance
- **Lazy Loading** des relations Doctrine
- **Optimisation des requêtes** avec repositories personnalisés
- **Mise en cache** des données fréquemment utilisées
- **Pagination** avec KnpPaginatorBundle

## 📱 Responsive Design

### Mobile-First Approach
- Interface adaptée aux écrans mobiles
- Navigation hamburger avec animations
- Gestures touch optimisées
- Performance mobile optimisée

### Breakpoints
- Mobile : < 768px
- Tablet : 768px - 1023px
- Desktop : 1024px+

## 🧪 Tests & Qualité

### Tests Unitaires
- PHPUnit 9.5 pour les tests backend
- Coverage des entités et services
- Tests d'intégration des controllers

### Standards de Code
- PSR-12 pour le code PHP
- ESLint pour JavaScript
- Symfony Best Practices

## 🚀 Déploiement

### Environnements
- **Development** : Symfony server local
- **Production** : Compatible Apache/Nginx

### Optimisations Production
```bash
# Optimiser l'autoloader
composer dump-autoload --optimize

# Compiler les assets en production
npm run build

# Vider les caches
php bin/console cache:clear --env=prod

# Optimiser Doctrine
php bin/console doctrine:cache:clear-metadata
```

## 🔮 Évolutions Futures

### Fonctionnalités Prévues
- [ ] API REST pour application mobile
- [ ] Système de notifications push
- [ ] Intégration avec wearables
- [ ] IA pour recommandations personnalisées
- [ ] Système de gamification
- [ ] Partage social des performances

### Améliorations Techniques
- [ ] Migration vers Symfony 8
- [ ] Implémentation d'un cache Redis
- [ ] Tests end-to-end avec Panther
- [ ] CI/CD avec GitHub Actions
- [ ] Monitoring avec Sentry

## 🤝 Contribution

Les contributions sont les bienvenues ! Processus de contribution :

1. **Fork** le repository
2. **Créer** une branche feature (`git checkout -b feature/amazing-feature`)
3. **Commit** les changements (`git commit -m 'Add amazing feature'`)
4. **Push** vers la branche (`git push origin feature/amazing-feature`)
5. **Ouvrir** une Pull Request

## 🏆 Compétences Démontrées

### Backend
- **Symfony 7** : Framework moderne PHP
- **Doctrine ORM** : Mapping objet-relationnel
- **Architecture MVC** : Séparation des responsabilités
- **Sécurité** : Authentification et autorisations
- **Tests** : Tests unitaires et d'intégration

### Frontend
- **Twig** : Template engine avancé
- **TailwindCSS** : Framework CSS utilitaire
- **JavaScript** : Vanilla JS et Stimulus
- **Chart.js** : Visualisation de données
- **Responsive Design** : Mobile-first

### DevOps
- **Composer** : Gestionnaire de dépendances PHP
- **NPM/Webpack** : Build tools JavaScript
- **Doctrine Migrations** : Gestion de schéma BDD
- **Git** : Contrôle de version

## 📞 Contact

**Mohamed Amine Bounachada**
- **Email** : aminebncd_pro@hotmail.com
- **GitHub** : [@Aminebncd](https://github.com/Aminebncd)
- **LinkedIn** : [Mohamed Amine Bounachada](https://www.linkedin.com/in/amine-bounachada/)

---

*Développé avec ❤️ par [Mohamed Amine Bounachada](https://github.com/Aminebncd)*

## 🐳 Docker Quick Start

The repository ships with a production-grade Docker setup and a dev-friendly `docker-compose.yml`.

```bash
cp .env.docker .env.local
make build
make up
# first-time: install deps & init db
docker compose exec php composer install
docker compose exec node npm ci
docker compose exec node npm run build  # or npm run dev
make migrate
```

Then open [http://localhost:${APP_PORT:-8080}](http://localhost:${APP_PORT:-8080}) (and Vite's dev server on port 5173 when running `npm run dev`).

- `php`, `nginx`, `db`, and `redis` start by default; enable `mailhog` with `--profile mail` for email testing and `node` with `--profile node` for the Vite dev server or when running `make assets`.
- Symfony Messenger can point workers at Redis via `REDIS_URL`; Mailer can target Mailhog at `smtp://mailhog:1025` in development.

For production builds use `docker build --target runtime .` and inject secrets via environment variables (never commit them). A minimal `.env.prod` example:

```env
APP_ENV=prod
APP_DEBUG=0
APP_SECRET=change_me_in_prod
DATABASE_URL="mysql://app:app@db:3306/app?serverVersion=8.0"
REDIS_URL="redis://redis:6379"
```

Provision databases/queues only after the containers report healthy status (see `scripts/wait-for-db.sh`).
