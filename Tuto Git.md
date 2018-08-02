# Tuto GIT

Tu veux utiliser Git mais tu comprends rien ? Ce tuto est pour toi !

> Attention, les astuces que je vais te donner sont approximatives, ça fonctionnera mais ça ne sera pas du tout optimal, j'ai pas encore mon BAC+8 en Git ಠ_ಠ

## Créer un projet GIT

Tu veux uploader ton projet (déjà créé ou non) sur un repository github mais t'es COM-PLÈ-TE-MENT largué(e) ? 

Voici la démarche à faire :

- Sur GitHub, [créé un nouveau repository](https://github.com/new).
- Choisis un nom, entre une description et coche `initialize this repository with a README`.
- Une fois créé, quand tu es sur ton projet, cliques sur le bouton vert `Clone or download` et copie le lien.
- Maintenant, sur ton PC, vas dans le dossier où tu veux voir apparaître le dossier de ton projet (normalement `HTDOCS` ou `WWW`).
- Installes [Git](https://git-scm.com/downloads).
- Lorsque tu fais un clic droit, tu devrais voir apparaître `Git Bash Here`.
- Cliques dessus, un terminal va s'ouvrir.
- Écris `git clone <lien que tu as copié avant>` : un dossier avec le nom de ton projet va appraître.

**LE TOUR EST JOUÉ !**

## Récupérer un projet GIT

Démarche à faire :

- Quand tu es sur le bon projet sur GitHub, cliques sur le bouton vert `Clone or download` et copie le lien.
- Sur ton PC, vas dans le dossier où tu veux voir apparaître le dossier de ton projet (normalement `HTDOCS` ou `WWW`).
- Installes [Git](https://git-scm.com/downloads).
- Lorsque tu fais un clic droit, tu devrais voir apparaître `Git Bash Here`.
- Cliques dessus, un terminal va s'ouvrir.
- Écris `git clone <lien que tu as copié avant>` : un dossier avec le nom de ton projet va appraître.

**LE TOUR EST JOUÉ !**

## Dans Visual Studio Code

Maintenant, en bas à gauche de ta fenêtre, tu vas voir apparaître `master` avec la représentation d'une branche Git. Si tu as ça, TOUT EST NORMAL, c'est que tout est bien installé. Je vais te lister les commandes dont tu vas avoir besoin pour gérer ton projet. Tu devras les effectuer dans cet ordre, sinon ça ne fonctionnera pas.

Si tu veux tout mettre sur ta branche principale (le tron de ton arbre = branche *master*)

 - Pour initialiser les dossiers de ton projet sur ton git local.
    - `git add *` : initialise TOUS les dossiers
    - `git add <nom du dossier>` : initialise un dossier en particulier
- `git commit -m "<commentaire>"` : 
    - permet de préparer l'upload sur git en sauvegardant les fichiers en local.
    - **ATTENTION, c'est pas un `CTRL+S` !!**
- Mettre en ligne
    - `git push origin master` : met sur ta branche principale
    - `git push origin <nom de ta branche>` : met sur la branche de ton choix

Pour créer une branche, tu as besoin d'une seule commande : `git checkout -b <nom de la branche>` . Une fois entrée, tu te retrouve directement sur cette dernière et ça va remplacere la mention `master` en bas à gauche de VS Code. Pour naviguer entre tes branches, tu as juste besoin de cliquer sur le nom de ta branche en bas et tu vas avoir une liste des branches de ton projet qui va apparaître. **Penses à `sauvegarder`, `add`, `commit` & `push` tes fichiers avant de changer de branche !**