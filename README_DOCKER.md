# MuscleMind - Guide Docker

## 🎯 Démarrage rapide

Pour lancer le projet dockerisé :

```bash
# Construire les images
docker compose -f docker-compose.yml build

# Démarrer tous les services
docker compose -f docker-compose.yml up -d

# Créer le schéma de base de données
docker compose -f docker-compose.yml exec php php bin/console doctrine:schema:create
```

## 🛠️ Services disponibles

| Service | Port | Description |
|---------|------|-------------|
| **Web Application** | http://localhost:8080 | Application Symfony principale |
| **Frontend Dev Server** | http://localhost:5173 | Serveur de développement Vite (profil node) |
| **Database** | 3306 | MySQL 8 |
| **Cache** | 6379 | Redis |

## 📋 Commandes utiles

### Gestion des conteneurs
```bash
# Voir le statut des conteneurs
docker compose -f docker-compose.yml ps

# Voir les logs
docker compose -f docker-compose.yml logs

# Arrêter les services
docker compose -f docker-compose.yml down

# Arrêter et supprimer les volumes
docker compose -f docker-compose.yml down -v
```

### Commandes Symfony
```bash
# Nettoyer le cache
docker compose -f docker-compose.yml exec php php bin/console cache:clear

# Migrations de base de données
docker compose -f docker-compose.yml exec php php bin/console doctrine:migrations:migrate

# Accéder au conteneur PHP
docker compose -f docker-compose.yml exec php bash
```

### Développement Frontend
```bash
# Démarrer le serveur de développement frontend
docker compose -f docker-compose.yml --profile node up -d

# Installer les dépendances npm
docker compose -f docker-compose.yml exec node npm install

# Builder les assets
docker compose -f docker-compose.yml exec node npm run build
```

### Base de données
```bash
# Accéder à MySQL
docker compose -f docker-compose.yml exec db mysql -u root -proot app

# Dump de la base de données
docker compose -f docker-compose.yml exec db mysqldump -u root -proot app > backup.sql

# Restore de la base de données
docker cp backup.sql musclemind-db-1:/tmp/backup.sql
docker compose -f docker-compose.yml exec db mysql -u root -proot app -e "source /tmp/backup.sql"
```

## 🔧 Configuration

### Variables d'environnement
Le fichier `.env.docker` contient la configuration pour Docker :

- `MYSQL_DATABASE=app`
- `MYSQL_USER=app` 
- `MYSQL_PASSWORD=app`
- `MYSQL_ROOT_PASSWORD=root`
- `APP_PORT=8080` (port d'accès à l'application)

### Fichiers de configuration importants
- `docker-compose.yml` : Configuration des services
- `Dockerfile` : Construction de l'image PHP
- `.env.docker` : Variables d'environnement pour Docker
- `nginx/conf.d/app.conf` : Configuration Nginx

## 🚀 Architecture

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│   Nginx     │    │     PHP     │    │   MySQL     │
│  (Reverse   │◄──►│  (Symfony)  │◄──►│ (Database)  │
│   Proxy)    │    │             │    │             │
└─────────────┘    └─────────────┘    └─────────────┘
       │                   │                   │
       │                   │                   │
       ▼                   ▼                   ▼
   Port 8080          Port 9000          Port 3306
                            │
                            ▼
                    ┌─────────────┐
                    │    Redis    │
                    │  (Cache)    │
                    └─────────────┘
                            │
                            ▼
                       Port 6379
```

## 📝 Notes

- L'application est accessible sur `http://localhost:8080`
- Les logs se trouvent dans `var/log/`
- Le cache est dans `var/cache/`
- Les assets sont compilés dans `public/build/`
- Les volumes Docker persistent les données de MySQL et Redis

## 🔍 Dépannage

### Problèmes courants

1. **Port déjà utilisé** : Changez la variable `APP_PORT` dans `.env.docker`
2. **Permissions** : Les fichiers dans `var/` appartiennent à `www-data`
3. **Cache** : Nettoyez le cache Symfony si nécessaire
4. **Base de données** : Vérifiez que MySQL est healthy avant d'exécuter les migrations

### Commandes de diagnostic
```bash
# Vérifier les logs d'erreur
docker compose -f docker-compose.yml logs php

# Vérifier la connectivité à la base de données
docker compose -f docker-compose.yml exec php php bin/console dbal:run-sql "SELECT 1"

# Tester la configuration
docker compose -f docker-compose.yml exec php php bin/console debug:config
```