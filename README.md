# 🍽️ L'épicurien

Site web professionnel pour un restaurant, développé dans le cadre de mon stage de fin d'année.

Le site permet de réserver une table en ligne, de gérer ses réservations et de communiquer avec le restaurant.

## 🏗 Architecture & Stack Technique

Le projet est une application **Symfony** unique : le backend et le frontend (templates Twig) vivent dans le même dépôt.

### 🖥️ Backend
- **Langage** : PHP
- **Framework** : Symfony
- **Base de données** : PostgreSQL (données relationnelles) 
- **ORM** : Doctrine
- **Sécurité** :  Argon2

### 🎨 Frontend
- **Templates** : Twig
- **Langages** : HTML, CSS, JavaScript
- **Assets** : AssetMapper (`importmap.php`)

## 🚀 Démarrage Rapide (Docker)

La méthode la plus simple pour lancer le projet complet (base de données, backend, frontend) est d'utiliser Docker Compose.

### Pré-requis
- Docker & Docker Compose installés sur votre machine.

### Lancer le projet
```bash
# Construire et lancer les conteneurs en arrière-plan
docker compose up --build -d
```

### Arrêter le projet
```bash
# Arrêter les conteneurs
docker compose down

# Arrêter et supprimer les volumes (attention : perte de données)
docker compose down -v
```

## 🌐 Accès aux Services

Une fois la stack lancée, les services sont accessibles aux adresses suivantes :

| Service        | URL                     | Description               |
|----------------|-------------------------|---------------------------|
| **Frontend**   | <http://localhost:8080> | Interface utilisateur Web |
| **PostgreSQL** | `localhost:5432`        | Base de données SQL       |

## ✨ Fonctionnalités Clés

- **Authentification** : création de compte client / patron, connexion sécurisée, gestion du profil et des informations personnelles.
- **Réservation** : prise de réservation en ligne (date, heure, nombre de couverts, message), réservée aux utilisateurs connectés.
- **Carte** : affichage dynamique des plats et de leurs prix, gérés depuis la base de données.
- **Galerie** : photos de l'établissement, gérées depuis la base de données.
- **Horaires** : affichage des horaires d'ouverture du restaurant.

## 🧠 Arborescence

```
L-epicurien/
├── .idea/                 # Configuration de l'IDE (PhpStorm)
├── assets/                # Sources front : CSS, JavaScript, images
├── bin/                   # Exécutables (bin/console)
├── config/                # Configuration Symfony (routes, sécurité, services, packages)
├── docker/                # Fichiers Docker (Dockerfile, config serveur web, etc.)
├── migrations/            # Migrations Doctrine (schéma de la base de données)
├── public/                # Point d'entrée web (index.php) et fichiers publics
├── src/                   # Code PHP de l'application
│   ├── Controller/        # Contrôleurs (pages, réservation, authentification)
│   ├── Entity/            # Entités Doctrine
│   ├── Form/              # Formulaires Symfony (ex. formulaire de réservation)
│   ├── Repository/        # Requêtes Doctrine
│   └── Security/          # Authentification et autorisations
├── templates/             # Vues Twig (base.html.twig, accueil, etc.)
├── tests/                 # Tests PHPUnit
├── translations/          # Fichiers de traduction
├── .editorconfig          # Règles de formatage de l'éditeur
├── .env.dev               # Variables d'environnement (développement)
├── .env.test              # Variables d'environnement (tests)
├── .gitignore
├── compose.yaml           # Orchestration Docker Compose
├── composer.json          # Dépendances PHP
├── composer.lock
├── importmap.php          # Dépendances JavaScript (AssetMapper)
├── package.json           # Dépendances Node
├── package-lock.json
├── phpunit.dist.xml       # Configuration PHPUnit
├── symfony.lock
└── README.md
```

## 👥 Auteurs

Younes
