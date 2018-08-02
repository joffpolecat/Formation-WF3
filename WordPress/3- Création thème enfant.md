# Thème enfant

Avantages :
- Continuer à profiter des mises à jour
- Accélère le temps de développement
- Bonne façon de commencer pour apprendre

Les fichiers du thème enfant:
- wp-config.php
- wp-content/
    - languages/
    - plugins/
    - themes/
        - thèmes par défaut
        - thème utilisé/
        - THÈME ENFANT
        - index.php
    - upgrade/
    - uploads/
    - index.php

Pour créer un thème enfant :

- Reprendre le **MÊME NOM DE DOSSIER** que le thème de base suivi de `-child` à la fin (*ex: twentyfifteen-child*).
- Copier-coller le fichier `style.css` & `screenshot.png` du dossier d'origine dans le dossier enfant.

Le fichier `Screenshot.png` permet d'avoir un aperçu du thème dans la section `Apparence` → `Thèmes`.

- Garder uniquement le 1er commentaire.
- À la fin du `Theme Name`, rajouter le terme `child`.
- En dessous de cette ligne, écrire `Template: <nom du thème parent>`. **ATTENTION AUX ESPACES**
- Aller dans `Apparence` → `Thèmes` et sélectionner le thème enfant.

```
/*
Theme Name: Twenty Fifteen child
Tempalte: twentyfifteen
// d'autres mensions facultatives renseignant sur l'auteur, l'url de téléchargement...
*/
```

- Importer la feuille de style du thème parent. Ici : `@import url('../twentyfifteen/style.css')` 



## Astuces

- Trouver l'**ID** d'une page :
    - En inspéctant le code de la page
    - Dans l'url de l'édition de la page *wp-admin/post.php?post=5&action=edit* : `post=5` → ici l'ID est donc 5


- Faire une modification sur une page en particulier :

Dans le dossier parent du thème : copier le fichier `page.php` et le coller dans le dossier enfant. Renommer le fichier `page.php` par `page-<nom de l'id de la page>` et y faire les modidifications nécéssaires. 

- Fonctionnement fichiers WordPress

    - Dans l'interface de WordPress, on a activé le thème enfant. 
    - WordPress va donc regarder ce thème en premier, le thème parent sera sondé en deuxième partie. 
    - S'il ne trouve pas un fichier dans le thème enfant, il va le chercher dans le thème parent.
    - Si il trouve un fichier dans le thème enfant, il utilise ce dernier mais il n'utilise pas celui du fichier parent.

**EXCEPTION POUR LE FICHIER `FUNCTIONS`**

```
PARENT/
    ...
    ...
    ...
    style.css
    index.php
    functions.php
    ...
    ...
    ...

ENFANT/
    style.css
    index.php
    functions.php
```


## Détail des fichiers 

`functions.php` : On peut définir les caractéristiques du thème, ajouter des sidebar, des menus... Il permet d'étendre les fonctionnalités du thème.