# Consignes

Création d'une application de gestion d'énergie d'une maison.

**Info** : une classe par fichier avec le même nom.

---

1. Modélisation de la maison

Une **maison** contient des **pièces**.

Créer une classe **maison** avec les attributs **privés** suivants:
- Matériaux pour la structure : `materiauxStructure` | Type STRING
- Matériaux pour la toiture : `materiauxToiture` | Type STRING

La classe `Maison` contient un ou plusieurs objets `Piece`.

Créer une classe `Piece` avec les attributs privés suivants :
- `surface` | > 0
- `hauteur` | > 0
- `nbFenetres` | >= 0

Créer les setter & getter .

Créer un objet `Maison` qui va contenir plusieurs objets `Piece` (dans `index.php`).

Créer un autoload.

---

2. Affiner nos classes

Créer des constructeurs avec les attributs obligatoires :
- `Maison` : `materiauxStructure`, `materiauxToiture`
- `Piece` : `nom`, `surface`, `hauteur`

Dans `Maison`, les matériaux doivent être préféfinis dans un **array** de type **constante** pour valider les données (avec `in_array`).

---

3. Méthode et commentaire

- Écrire une méthode `getInfos` dans la classe `Maison` qui va retourner un **array** avec toutes les informations (y compris les pièces).
- Écrire un commetaire doc qui décrit la méthode (@return ...).

---

4. AJAX

- Enregistrer les informations dans un fichier & retourner une réponse en JSON.
- Afficher l'envoi du formulaire et envoyer les données POST avec une requête AJAX.
- Afficher la réponse dans une balise HTML.
- JavaScript natif ou JQuery.
- Comment envoyer TOUTES les données d'un formulaire..?