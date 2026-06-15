# le44
Ce projet consiste en la création d’un site web professionnel pour un restaurant, développé dans le cadre de mon stage de fin d'annee

Le site  offre la possibilité de réserver une prestation, de gérer ses rendez‑vous, de recevoir des notifications et de communiquer avec le restaurant.

## 🏗 Architecture & Stack Technique

Le projet est structuré en monorepo composé de deux parties principales :

### 🖥️ Backend (`/backend`)
- **Langage** : php
- **Framework** : symfony
- **Base de données** : PostgreSQL (Données relationnelles) & MongoDB (Messages/Logs)
- **ORM** : Doctrine
- **Sécurité** : JWT & Argon2

### ⚛️ Frontend (`/frontend`)
- **Langage** : html,css

## 🚀 Démarrage Rapide (Docker)

La méthode la plus simple pour lancer le projet complet (Base de données, Backend, Frontend) est d'utiliser Docker Compose.

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

Une fois le stack lancé, les services sont accessibles aux adresses suivantes :

| Service | URL | Description |
|---------|-----|-------------|
| **Frontend** | [http://localhost:3000](http://localhost:3000) | Interface utilisateur Web |
| **PostgreSQL** | `localhost:5432` | Base de données SQL |
| **MongoDB** | `localhost:27017` | Base de données NoSQL |
| **pgAdmin** | [http://localhost:5050](http://localhost:5050) | Interface d'administration Postgres |
| **Mongo Express** | [http://localhost:8081](http://localhost:8081) | Interface d'administration MongoDB |

## ✨ Fonctionnalités Clés

- **Authentification** : Création de compte client/patron, connexion sécurisée, gestion du profil et des informations personnelles.

- **Rendez-vous** : Prise de rendez‑vous en ligne, choix du type de lavage, sélection des options, gestion des disponibilités en temps réel.

- **Prestations** : Catalogue dynamique des services (lavage extérieur, intérieur, complet, detailing, cire, polissage), affichage des tarifs et durées estimées.

- **Gestion du car wash** : Administration des horaires d’ouverture, fermetures exceptionnelles, gestion des employés et de leurs plannings.

- **Avis & Fidélité** : Système d’avis clients, notes, programme de fidélité, points cumulés ou réductions.

- **Communicatio**n : Formulaire de contact ou messagerie simple pour échanger avec le car wash (questions, demandes spéciales, devis).

## 🧠 Architecture 

```
car-wash/
│
├── src/
│   ├── Controller/
│   │   ├── HomeController.php
│   │   ├── AppointmentController.php        # prise de RDV client
│   │   ├── ServiceController.php            # affichage des prestations
│   │   ├── StaffController.php              # équipe (optionnel côté public)
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── AppointmentAdminController.php
│   │       ├── ServiceAdminController.php
│   │       └── StaffAdminController.php
│   │
│   ├── Entity/
│   │   ├── User.php                         # client + admin
│   │   ├── Role.php
│   │   ├── Client.php                       # infos client (véhicule, historique)
│   │   ├── Staff.php                        # employés du car wash
│   │   ├── Service.php                      # lavage, detailing, options
│   │   ├── Appointment.php                  # RDV
│   │   ├── AppointmentService.php           # services associés à un RDV
│   │   └── Payment.php                      # paiement (optionnel)
│   │
│   ├── Repository/
│   │   ├── AppointmentRepository.php
│   │   ├── ServiceRepository.php
│   │   └── StaffRepository.php
│   │
│   ├── Form/
│   │   ├── AppointmentType.php              # choix du service + créneau
│   │   ├── ServiceType.php
│   │   └── StaffType.php
│   │
│   └── Security/
│       └── (auth, login, voters si besoin)
│
├── templates/
│   ├── base.html.twig
│   ├── home/
│   │   └── index.html.twig
│   ├── services/
│   │   ├── index.html.twig
│   │   └── show.html.twig
│   ├── appointments/
│   │   ├── new.html.twig
│   │   ├── my_list.html.twig
│   │   └── show.html.twig
│   └── admin/
│       ├── dashboard.html.twig
│       ├── appointments/
│       │   ├── index.html.twig
│       │   └── edit.html.twig
│       ├── services/
│       │   ├── index.html.twig
│       │   └── edit.html.twig
│       └── staff/
│           ├── index.html.twig
│           └── edit.html.twig
│
├── config/
│   ├── routes.yaml
│   └── packages/
│       └── security.yaml
│
├── public/
└── assets/
    ├── css/
    ├── js/
    └── images/

```
## 👥 Auteurs
Younes

