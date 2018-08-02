# Installer Wordpress en local

Wordpress fonctionne avec une base de donnée : Apache/MySQL/PHP, il est donc nécessaire de faire tourner un serveur sur sa machine en local pour pouvoir faire fonctionner un site Wordpress.


## Faire de notre machine un serveur web local

- télécharger et installer XAMPP ou MAMP ou WAMP sur sa machine
- lancer l'application et les services Apache et MySQL (cliquer sur start)
- si besoin éditer la configuration (php.ini, http.conf, my.ini)
- verifier le bon fonctionnement du serveur en allant avec un navigateur à l'adresse http://localhost/ ou http://127.0.0.1
- Pour XAMPP : les fichiers du serveurs doivent être déposés dans le dossier C:/xampp/htdocs/

## Installer Wordpress

WordPress est célèbre pour pouvoir être installé et prêt à publier en 5 minutes ! Voici comment :

- Téléchargez et décompressez WordPress
- Créez une base de données pour WordPress sur votre serveur Web, de sorte que MySQL ait tous les privilèges en accès et en modification
    - se connecter à phpmyadmin à l'adresse http://localhost/phpmyadmin/
    - créer une nouvelle base de donnée (wordpress_tuto par exemple)
    - dans la base de donnée, accéder à l'onglet 'privilèges' et créer un nouvel utilisateur (wordpress_tuto), lui associer un mot de passe et la connection en 'localhost'
    - la case à cocher 'donner tous les privilèges à cet utilisateur sur la base de donnée ...' devra être cochée
    - cliquer sur executer

- Déposez les fichiers de WordPress à l’emplacement désiré sur votre serveur Web, au besoin, créer un sous-dossier pour le site dans c:/xampp/htdocs/
- Si vous souhaitez placer WordPress à la racine de votre domaine (par exemple http://www.example.com/), déplacez ou téléchargez tout le contenu du répertoire WordPress décompressé (en excluant le répertoire lui-même) dans le répertoire racine de votre serveur Web.
- Si vous souhaitez placer votre installation de WordPress dans un sous-répertoire de votre site Web (par exemple http//www.example.com/blog/), renommez le répertoire wordpress avec le nom que vous avez choisi pour le sous-répertoire et déplacez ou téléchargez-le vers votre serveur Web. Par exemple, si vous voulez que votre installation de WordPress soit présente dans le sous-répertoire appelé « blog », vous devez renommer le répertoire appelé « wordpress » en « blog » et le télécharger dans le répertoire racine de votre serveur Web.
- Lancer le script d’installation en ouvrant l’adresse de WordPress dans votre navigateur Web préféré. Suivez les instructions de l’installateur, et validez.
- Et voilà ! WordPress devrait à présent être installé.

Pendant le processus d'installation de Wordpress on aura pris soin de créer un utilsateur administrateur et veuillé à cocher la case pour ne pas permettre l'indexation par les moteurs de recherche dans le cadre du développement du site.

