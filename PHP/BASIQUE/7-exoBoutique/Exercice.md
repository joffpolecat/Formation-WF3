# Développement évolutif d'un site web

Pour d'avantage développer notre site, je vous propose plusieurs suggestions d'exerices pour être plus performant : 
Les développements complémentaires pour faire évoluer le site

## BACKOFFICE

### Exercice 1 - Gestion des commandes

Ajoutez (dans le dossier /admin/) une page que vous nommerez `gestion_commandes.php` dans le dossier `/admin` afin d’afficher toutes les commandes passées sur le site ainsi que le détail des commandes.

L’affichage de toutes les informations aideront le commerçant :

- Le numéro de commande (id_commande) ainsi que la date et le montant afin que le commerçant puisse faire le rapprochement avec les chèques qu’il reçoit.
- Les informations sur les articles commandés (id_article) ainsi que le titre, la photo, la quantité demandée, etc. afin qu’il puisse honorer la commande du client.
- Le numéro du membre (id_membre) ainsi que son pseudo, adresse, ville et cp afin que le commerçant puisse envoyer le colis.
- L’état de la commande doit s’afficher et doit pouvoir être modifiable par l’administrateur (s’il souhaite changer une commande jusqu’à présent `en cours de traitement` par `en cours d’envoi` par exemple).
- L’idéal serait que le membre reçoive un email de notification pour l’informer de l’évolution de sa commande.

L’affichage du chiffre d’affaires doit également apparaitre sur cette page.

De l’accessibilité et de la navigation seraient un plus pour le commerçant, en effet il serait bon de lui offrir la possibilité de trier les commandes par date, état, montant, etc. Seul l’administrateur doit avoir accès à cette page.

### Exercice 2 - Gestion des membres (check  ✓)

Ajoutez une page que vous nommerez `gestion_membres.php` dans le dossier `/admin` afin d’afficher tous les membres inscrits sur le site. Seul l’administrateur doit avoir accès à cette page. Dans cette même page, ajoutez la possibilité à l’administrateur de pouvoir supprimer un membre inscrit au site. Donnez-lui la possibilité d’ajouter d’autres comptes `administrateur`.

-----------

## FRONTOFFICE

### Exercice 3 - Modification du compte membre

Ajoutez un lien `mettre à jour mes informations` dans l’espace `profil.php` afin que les personnes inscrites au site aient la possibilité de modifier leurs informations relatives à leurs comptes tels que leur adresse, mot de passe, ville, cp, adresse, etc. Cela implique la création d’une nouvelle page `membres.php`.

### Exercice 4 - Suppression du compte membre

Ajoutez un lien `se désinscrire` dans l’espace `profil.php` afin que les personnes inscrites au site aient la possibilité de supprimer leur compte membre.

### Exercice 5 - Amélioration de l’espace membre

Donner la possibilité aux membres d’avoir des avatars de profil. 
Permettre à l’internaute de solliciter le site en cas de mot de passe perdu. 
Sur la page `profil.php`, affichez le suivi des commandes en cours, l’historique des commandes passées, etc. 
Permettre à l’internaute de pouvoir se connecter avec son pseudo ou son adresse email.


-----------

## AMÉLIORATIONS
### Exercice 6 - Panier ++

Sur la page `panier.php` :

- Affichez le prix HT et TTC unitaire et aussi multiplié par le nombre de produits. 
- Affichez le titre de du produit, ainsi que la photo à coté des autres informations déjà présentes. 
- Donner la possibilité à l'internaute d’augmenter ou réduire les quantités directement sur la page panier. 

Nous allons améliorer notre système permettant de retirer ou baisser les articles si les quantités demandées par notre panier sont supérieures à notre stock restant en base de données. 

Pour cela, il va falloir modifier la page `fiche_produit.php`. Actuellement, s’il reste 3 jeans, l’internaute peut prendre les 3 derniers et les mettre dans son panier. En revanche, il peut revenir sur la fiche détaillée de cet article et les reprendre 3 fois autant de fois qu’il le souhaite. Nous allons faire en sorte que si l’internaute ait déjà cet article 1 fois dans son panier, le site lui propose d’en prendre 2 seulement. Si l’internaute en possède déjà 2 dans son panier, le site lui propose d’en prendre 1 supplémentaire seulement. Dans le panier, il y aura moins de risques pour l’internaute de demander des quantités supérieures au stock restant en base de données.

### Exercice 7 - Graphisme ++

Afin d’avoir un meilleur retour des internautes, nous allons améliorer le visuel : Intégrez un design dans le contexte du site. Ajoutez de l’animation et des effets pour éviter d’avoir un site figé où rien ne bouge.