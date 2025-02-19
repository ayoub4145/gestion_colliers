****Gestion des Colis****

**Description**

Ce projet est une application web développée avec Laravel pour la gestion des livraisons de colis. Il permet aux administrateurs de suivre les colis, aux livreurs de confirmer les envois, et aux clients de vérifier le statut de leurs colis.

**Fonctionnalités**

-Authentification des administrateurs, des livreurs et des clients

-Gestion des colis (création, mise à jour, suppression)

-Confirmation d'envoi par les livreurs

-Notification des raisons d'échec de livraison(n'est pas encore disponible)

-Tableau de bord pour le suivi des livraisons/Réception des colis

Technologies Utilisées

Backend : Laravel

Base de données : MySQL

Frontend : Blade, HTML, CSS, JavaScript

**Installation**

Cloner le dépôt :

git clone https://github.com/ton-repo/gestion-des-colis.git
cd gestion-des-colis

**Installer les dépendances :**

composer install
npm install
npm run dev

Configurer le fichier .env :

cp .env.example .env
php artisan key:generate

Configurer la base de données dans .env puis :

php artisan migrate --seed

Démarrer le serveur :

php artisan serve

Utilisation

Accéder à l'application via http://localhost:8000.

Se connecter avec les identifiants administrateur ou livreur créés lors du seeding.

Contributeurs

Ayoub
