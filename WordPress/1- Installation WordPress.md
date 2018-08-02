# Installer Wordpress en localhost :

- Télécharger les [fichiers de Wordpress](https://wordpress.org/download)
- Les placer dans un dossier du serveur (htdocs sur Xamp ou www sur Wamp)

## Dans PHPMYADMIN

- Créer une base de donnée avec un utilisateur qui n'a accès qu'à cette base de donnée (encodage : `utf8_general_ci`)
- Selectionner la base de donnée fraîchement créée 
- Dans l'onglet `privilèges`
- Ajouter un compte d'utilisateur
    - Nom d'utilisateur
    - Nom d'hôte local / `localhost`
    - Mot de passe
    - C'EST TOUT !
                
## URL du site
- Executer l'assistant d'installation
- Choisir la langue
- Rentrer toutes les infos
- Adresse de la BDD : Localhost
- Préfixe des tables : changer
- Informations nécessaires
    - **COCHER** : Site en construction : demander aux moteurs de recherche de ne pas indexer ce site

** LE SITE EST INSTALLÉ**