# Social Nest

Social Nest est une application sociale développée avec le framework Laravel. Elle permet aux utilisateurs de se connecter, de partager des publications, de discuter en temps réel, de gérer des événements, et bien plus encore.

## Fonctionnalités

- **Gestion des utilisateurs** :
  - Inscription, connexion et gestion des profils.
  - Authentification via Google et Facebook.
  - Gestion des rôles (administrateur, utilisateur).
  - Suspension et bannissement des utilisateurs par les administrateurs.

- **Publications** :
  - Création, modification et suppression de publications.
  - Ajout de médias (images, vidéos) aux publications.
  - Gestion de la confidentialité des publications (public, amis, privé).
  - Système de likes et de commentaires.

- **Amis** :
  - Envoi et gestion des demandes d’amitié.
  - Notifications pour les demandes acceptées ou reçues.

- **Messagerie** :
  - Chat en temps réel entre utilisateurs.
  - Notifications pour les nouveaux messages.

- **Événements** :
  - Création, modification et suppression d’événements.
  - Notifications pour les nouveaux événements.

- **Notifications** :
  - Notifications en temps réel pour les interactions importantes (likes, commentaires, demandes d’amitié, etc.).
  - Gestion des notifications lues et non lues.

## Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/ligh-cloud/social-nest.git
   cd social-nest

2.Installez les dépendances PHP et JavaScript :
-composer install

3.Configurez le fichier .env :

 - Copiez le fichier .env.example en .env.
 - Configurez les variables d'environnement (base de données, services tiers, etc.).
 - 
4.Générez la clé de l'application :
 - php artisan key:generate

5.Configurez la base de données :
 - Créez une base de données.
 - Exécutez les migrations :
 - php artisan migrate


6.Lancez le serveur de développement :
 - php artisan serve

   
