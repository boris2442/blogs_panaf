README
github: https://github.com/boris2442/blogs_panaf
Nom du projet : Blogs Ong

ONG Blog – Plateforme pour publier des articles et commentaires visant à éradiquer la souffrance et promouvoir les actions de l’association.

Description

Ce projet est une application web développée avec Laravel 12. Elle permet à une association (ONG) de publier des articles de blog, gérer les utilisateurs et protéger certaines sections pour les administrateurs.

Fonctionnalités principales :

Authentification utilisateurs (login/register).

Gestion des rôles : admin et user.

Gestion des articles (CRUD) pour les administrateurs.

Publication de commentaires pour les utilisateurs connectés.

Affichage dynamique de la navigation selon le rôle.

Interface responsive avec Tailwind CSS.

SEO-friendly avec balises meta optimisées.

Installation

Cloner le projet :

git clone https://github.com/boris2442/blogs_panaf.git
cd blogs_panaf
2.Installer les dépendances
composer install
npm install
npm run dev
3.Configurer l’environnement :
cp .env.example .env
php artisan key:generate
Modifier .env pour configurer la base de données et autres variables.

Migrer la base de données :
Modifier .env pour configurer la base de données et autres variables.

Migrer la base de données :
php artisan migrate
5.Démarrer le serveur local :
php artisan serve

| Route                        | Méthode  | Description            | Accès       |
| ---------------------------- | -------- | ---------------------- | ----------- |
| `/`                          | GET      | Page d’accueil         | Public      |
| `/login`                     | GET/POST | Connexion              | Public      |
| `/register`                  | GET/POST | Inscription            | Public      |
| `/dashboard`                 | GET      | Tableau de bord        | Authentifié |
| `/profile`                   | GET      | Profil utilisateur     | Authentifié |
| `/admin/posts`               | GET      | Liste des posts        | Admin       |
| `/admin/posts/create`        | GET/POST | Création d’un post     | Admin       |
| `/blogs/{post:slug}`         | GET      | Voir un post           | Public      |
| `/blogs/{post:slug}/comment` | POST     | Ajouter un commentaire | Authentifié |

Base de données
Table users

id (PK)

name

email

password

role ENUM(user, admin) – par défaut user

Table posts

id (PK)

title

content

thumbnail

user_id (FK)

Table comments

id (PK)

body

user_id (FK)

post_id (FK)

Middleware

auth : protège les routes pour les utilisateurs connectés.

admin : protège les routes pour les administrateurs uniquement.

Contribution

Fork le projet.

Crée une branche feature/nom-feature.

Commit tes modifications.

Push et ouvre une pull request.

Licence

Ce projet est sous licence MIT.
