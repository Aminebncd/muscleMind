# 🚀 Guide de Démarrage Rapide - MuscleMind

## ✅ Prérequis Vérifiés

- ✅ Docker Desktop installé et lancé
- ✅ Git installé
- ✅ Port 8080 disponible (application principale)

---

## 📋 Démarrage en 5 Minutes

### 1. Lancer l'Infrastructure Docker

```bash
# Dans le dossier du projet
cd c:\laragon\www\muscleMind

# Lancer tous les services
docker compose up -d

# Vérifier que tout tourne
docker compose ps
```

**Résultat attendu:**

```
NAME                    STATUS
musclemind-db-1         healthy
musclemind-nginx-1      running
musclemind-php-1        healthy
musclemind-redis-1      healthy
```

### 2. Installer les Dépendances PHP

```bash
# Installer Composer dans le container
docker compose exec php composer install
```

### 3. Configurer la Base de Données

```bash
# Créer la base de données
docker compose exec php php bin/console doctrine:database:create --if-not-exists

# Exécuter les migrations
docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

# (Optionnel) Charger des données de test
docker compose exec php php bin/console doctrine:fixtures:load --no-interaction
```

### 4. Générer les Clés JWT (pour l'API)

```bash
docker compose exec php php bin/console lexik:jwt:generate-keypair --skip-if-exists
```

### 5. Installer le Frontend (si besoin)

```bash
# Lancer le service Node.js
docker compose --profile node up -d

# Ou installer localement
cd frontend
npm install
npm run dev
```

---

## 🌐 Accéder à l'Application

Une fois tout lancé, ouvrir:

| Service               | URL                            | Identifiants    |
| --------------------- | ------------------------------ | --------------- |
| **Application Web**   | http://localhost:8080          | Créer un compte |
| **API Backend**       | http://localhost:8080/api      | -               |
| **API Documentation** | http://localhost:8080/api/docs | -               |
| **Admin Panel**       | http://localhost:8080/admin    | admin / admin   |
| **MailHog (Emails)**  | http://localhost:8025          | -               |
| **Frontend React**    | http://localhost:3000          | (si lancé)      |

---

## 🛑 Arrêter l'Application

```bash
# Arrêter tous les containers
docker compose down

# Arrêter et supprimer les volumes (⚠️ perte de données!)
docker compose down -v
```

---

## 🔧 Commandes Utiles

### Voir les Logs

```bash
# Tous les services
docker compose logs -f

# Un service spécifique
docker compose logs -f php
docker compose logs -f nginx
```

### Accéder au Container PHP

```bash
docker compose exec php bash

# Puis exécuter des commandes Symfony
php bin/console cache:clear
php bin/console debug:router
```

### Créer un Utilisateur Admin

```bash
docker compose exec php php bin/console app:create-admin
```

### Nettoyer le Cache Symfony

```bash
docker compose exec php php bin/console cache:clear
docker compose exec php php bin/console cache:warmup
```

---

## 🐛 Problèmes Fréquents

### Port 8080 déjà utilisé

```bash
# Changer le port dans .env.docker
APP_PORT=8081

# Relancer
docker compose down
docker compose up -d
```

### Base de données vide

```bash
# Vérifier la connexion
docker compose exec php php bin/console doctrine:schema:validate

# Recréer la base
docker compose exec php php bin/console doctrine:database:drop --force
docker compose exec php php bin/console doctrine:database:create
docker compose exec php php bin/console doctrine:migrations:migrate -n
```

### Erreur "Composer not found"

```bash
# Rebuilder l'image PHP
docker compose build php --no-cache
docker compose up -d
```

---

## 📝 Développement

### Modifier du Code PHP

- Les fichiers sont synchronisés automatiquement
- Pas besoin de redémarrer (sauf modification de config)

### Modifier du Code Frontend

```bash
# Le serveur Vite reload automatiquement
npm run dev
```

### Ajouter une Dépendance PHP

```bash
docker compose exec php composer require vendor/package
```

### Créer une Nouvelle Entité

```bash
docker compose exec php php bin/console make:entity
docker compose exec php php bin/console make:migration
docker compose exec php php bin/console doctrine:migrations:migrate
```

---

## ✨ C'est Prêt!

Ton application MuscleMind tourne maintenant! 🎉

Pour plus de détails, consulte le fichier `README.md` complet.
