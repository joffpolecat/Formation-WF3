# Méthode pour accéder à mon GIT

Alors déjà, tu as du recevoir un mail comme quoi je t'ai autorisé à triffouiller mon Git.

## Dans Visual Studio Code

Tu vas devoir rentrer quelques commandes...

- Premièrement, créé toi un dossier annexe où tu vas pouvoir récupérer tous mes dossiers
- Vas dans ce dossier avec les commandes du terminal (`ls` pour aller dans un dossier, `mkdir` pour créer un nouveau dossier)
- Une fois que tu as le bon chemin, écris ça : `git init` et un dossier `.git`  va se créer
- Pour te connecter à mon projet, tu dois écrire `$ git remote add origin <le lien du mail (normalement)>` 
- Ensuite tu dervais normalement être sur mon git donc avoir récupéré tous mes fichiers (oui je dis plein de fois normalement ಠ⌣ಠ)
- Pour créer ta branche, écris : `git checkout -b <le nom de ta branche>`. Une fois que tu auras écrit ça, tu seras dans la bonne branche
- Tu peux directement ajouter tes fichiers dans `6-boutique`, vu que tu es sur ta branche, ça n'impactera pas du tout sur la branche principale.

Pour mettre en ligne, tu as 2 3 commandes à faire :

- Ajouter les modifications : `git add *`
- Tout sauvegarder en local : `git commit -m "message que tu veux"` 
- Mettre en ligne : `git remote add origin <nom de ta branche>`

Pour aller plus vite par la suite, il te suffira de faire `flèche du haut` 3 fois puis `ENTRER` et recommencer encore 2 fois
En fait ça remonte dans tes commandes précédentes, donc tu n'auras plus rien à écrire \ (◉◡◉) /