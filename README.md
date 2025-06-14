# Social Nest  
Social Nest est une application web sociale moderne développée avec Laravel. Elle offre une plateforme complète pour se connecter, partager, discuter en temps réel, organiser des événements et interagir avec d'autres utilisateurs dans un environnement sécurisé et dynamique.  
  
## 🚀 Fonctionnalités principales  
  
👥 Gestion des utilisateurs  
- Inscription et connexion avec vérification  
- Authentification via Google et Facebook  
- Profils personnalisables  
- Gestion des rôles (utilisateur, administrateur)  
- Suspension et bannissement des utilisateurs par les administrateurs  
  
📝 Publications  
- Création, édition et suppression de publications  
- Ajout de médias : images et vidéos  
- Gestion de la confidentialité : public, amis, privé  
- Réactions : système de likes et commentaires  
  
🤝 Système d’amis  
- Envoi, acceptation et suppression de demandes d’amitié  
- Suggestions d’amis  
- Notifications en temps réel lors de nouvelles interactions  
  
💬 Messagerie  
- Chat en temps réel entre amis  
- Notifications instantanées pour les nouveaux messages  
  
📅 Événements  
- Création et gestion d’événements (titre, lieu, date, description)  
- Consultation des événements créés ou rejoints  
- Notifications lors de la création ou mise à jour d’un événement  
  
🔔 Notifications  
- Notifications en temps réel pour : likes, commentaires, demandes et acceptations d’amitié, nouveaux messages et événements  
- Marquage des notifications comme lues ou non lues  
  
## ⚙️ Installation locale  
  
1. Cloner le dépôt :  
git clone https://github.com/ligh-cloud/social-nest.git  
cd social-nest  
  
2. Installer les dépendances :  
composer install  

  
3. Configurer l’environnement :  
cp .env.example .env  
php artisan key:generate  
  
4. Configurer la base de données :  
- Créer une base de données localement  
- Modifier les informations dans `.env`  
- Exécuter les migrations :  
php artisan migrate  
  
5. Lancer le serveur :  
php artisan serve  
  
## 🛠️ Stack technique  
- Backend : Laravel 12  
- Frontend : Blade, Tailwind CSS, HTMX  
- Temps réel : Pusher  
- Base de données : MySQL  
- Authentification sociale : Laravel Socialite  
  
## 📌 Auteur  
Développé par Hatim Belghiti  
GitHub : https://github.com/ligh-cloud
