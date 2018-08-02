# SYMFONY

- [RECAP SYMFONY](https://github.com/Piotezaza/CoursNumericall/blob/master/PHP/SYMFONY/Recap.md)
- [MEMO](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/SYMFONY#memo)
- [Liens utiles](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/SYMFONY#liens-utiles)

---
## Commandes

---
**Installer la toolbar Apache**

`composer require symfony/apache-pack`, à la fin, faire yes : `y`.

---
**Afficher la liste des routes**

`php bin/console debug:router` 


---
**Créer une base de données**

- Dans le fichier `.env`, modifier la ligne **23** (dans l'exemple1 : `DATABASE_URL=mysql://root@127.0.0.1:3306/Sf_exo`) 
- Dans le terminal : `php bin/console doctrine:database:create`

---
**MODIFICATIONS DANS `assets`**

Pour que les changements prennent effet il faut rentrer cette commande dans le terminal : 
`npm run dev` 

---
**Installer fontawesome**

- dans le terminal : `npm i @fortawesome/fontawesome-free-webfonts --save-dev`
- dans `assets` trouver le fichier CSS ou SCSS et coller ces deux lignes dispo aussi [ici](https://www.npmjs.com/package/@fortawesome/fontawesome-free-webfonts) puis faire `npm run dev`
```scss
@import "~@fortawesome/fontawesome-free-webfonts/scss/fa-solid.scss";
@import "~@fortawesome/fontawesome-free-webfonts/scss/fontawesome.scss";
```

---
**Mettre à jour les bibliothèques (Fontawesome par exemple)**

`npm update` 

---
Lancer le serveur proposé par Symfony `php bin/console server:run`. Avantage : les liens ressemblent à ceux de la prod

---
**Nettoyer le cache**

`php bin/console cache:clear`

---
**Statut des traductions**
`php bin/console debug:translation fr`

---
**Installer bundle FriendsOfSymfony**

`composer require friendsofsymfony/user-bundle`

Si erreur ci-dessous :

```
Error: Encore.setOutputPath() cannot be called yet because the runtime environment doesn't appear to be 
configured. Make sure you're using the encore executable or call Encore.configureRuntimeEnvironment()
first if you're purposely not calling Encore directly.

```
 Dans `webpack.config.js`, ajouter cette partie en dessous de `Encore` : `.configureRuntimeEnvironment('dev')`

---
**BUNDLE SYMFONY**

`composer require knplabs/knp-menu-bundle` aide à faire des menus

---
**USER**

- Créer un nouvel utilisateur : `php bin/console fos:user:create`
- Promouvoir un utilisateur : `php bin/console fos:user:promote`

---
**Afficher les services**

`php bin/console debug:autowiring`

---
**Créer une nouvelle entité** → [Reste de la démarche](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/SYMFONY#ajouter-deux-nouvelles-entit%C3%A9es)
`php bin/console make:entity`

---
## MEMO

### Installation


Via composer (gestionnaire de bibliothèques externes). `symfony/website-skeleton` peut être remplacé par un lien de dépot git.

```
composer create-project symfony/website-skeleton NomDuProjet
```

### Dossiers

- **ASSETS** : fichiers JS/CSS
- **BIN** : fichiers binaire tel que la console
- **CONFIG** : fichiers de configuration des modules (version Symfony < 4 : un seul fichier `config.yml`)
- **PUBLIC** : contient `index.php` et les fichiers statiques créés par *WebPack*
- **SRC** :  tout le code source de l'application
- **TEMPLATES** : contient toutes les vues (fichiers **Twig**)
- **TESTS** : fichiers pour les tests unitaires 
- **TRANSLATIONS** : fichiers de traduction (version Symfony < 4 : les vues sont dans le dossier `Ressource/Views` des Bundle)
- **VAR** : contient le cache et les fichiers log
- **VENDOR** : bibliothèques externes à notre application (comme Doctrine, Twig, SwiftMailer, etc)

### Webpack

Webpack permet de condenser tous les fichiers assets dans un seul. Par exemple, tous les fichiers JavaScript sont minifiés et placés dans un seul fichier.

Pour installer les modules

```
npm install --save-dev
```

#### Annotation

Les annotations sont des instructions définies dans un commentaire doc. Elles permettent de définir des paramètres rapidement sans aller dans les fichiers config. Par exemple pour définir les routes dans un controller :

```php
/**
* @Route("/chemin/de/la/route")
*/
```

Avec paramètres :
```php
/**
* @Route("/edit/{id}", requirements={"id":"\d+"})
*/
```

### Entity

#### Annotations

Définir l'entité, annotation à mettre au dessus de la déclaration de classe

```php
/**
 * @ORM\Entity(repositoryClass="Namespace\De\La\Classe")
 * @OR\Table(name="nom_de_la_table")
 * /
```

Définir une colonne

```php
/**
* @ORM\Column(name="nom_du_champ", type="string|text|integer|float|datetime|json_array", nullable=true, length=255)
*/
```

Définir une relation

*Un seul objet peut être associé à un seul autre*

```php
/**
* @ORM\OneToOne(targetEntity="Namespace\De\La\Classe")
*/
```

Plusieurs objets peuvent être associés à un seul autre

```php
/**
* @ORM\ManyToOne(targetEntity="Classe")
*/
```

Plusieurs objets peuvent être associés à plusieurs autres

```php
/**
* @ORM\ManyToMany(targetEntity="Classe")
*/
```

Pour une relation inverse (ex: obtenir les articles d'une catégorie)
```php
/**
* @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
*/
```

Pour faire une relation ManyToMany avec paramètres il faut créer une entité intermédiaire
```php
//PANIER

/**
* @ORM\OneToMany(targetEntity="PanierProduit")
*/
```
```php
//PANIER PRODUIT

/**
* @ORM\ManyToOne(targetEntity="Panier")
*/

/**
* @ORM\ManyToOne(targetEntity="Produit")
*/
```
```php
//PRODUIT

/**
* @ORM\ManyToOne(targetEntity="PanierProduit")
*/
```

### Twig

Tester si l'utilisateur est identifié
```twig
{% if is_granted('IS_AUTHENTICATED_REMEMBERED') %}
{% endif %}
```

### Controller

#### AJAX

Pour retourner du Json dans un controller
```php
use Symfony\Component\HttpFoundation\JsonResponse;

// ...

return new JsonResponse(array(/*...*/));
```

Pour tester si la requête est en Ajax
```php
if ($request -> isXmlHttpRequest()){}
```

### Lifecycle

Il est possible d'indiquer à Doctrine d'appeler automatiquement des méthodes d'une entité, par exemple avant de faire un persist.

Avant la déclaration de la classe, indique à Doctrine qu'il y a des méthodes à appeler:
```php
/**
 * @ORM\HasLifecycleCallbacks
 * /
```

```php
/**
 * @ORM\PrePersist()
 * @ORM\PreUpdate()
 * @ORM\PreRemove()
 * @ORM\PostPersist()
 * @ORM\PostUpdate()
 * @ORM\PostRemove()
*/
```
---
## Liens utiles

- [OPENCLASSROOMS - Développez votre site web avec le framework Symfony](https://openclassrooms.com/courses/3619856-developpez-votre-site-web-avec-le-framework-symfony)
- [SYMFONY - Querying for Objects: The Repository](http://symfony.com/doc/current/doctrine.html#querying-for-objects-the-repository)

---
## Autre

### Ajouter deux nouvelles entitées

```bash
PS C:\wamp\www\CoursNumericall\PHP\SYMFONY\Exemple1> php bin/console make:entity


 Class name of the entity to create or update (e.g. DeliciousElephant):
 > ArticleFollow

 created: src/Entity/ArticleFollow.php
 created: src/Repository/ArticleFollowRepository.php

 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > date

 Field type (enter ? to see all types) [string]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/ArticleFollow.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > article

 Field type (enter ? to see all types) [string]:
 > ManyToOne

 What class should this entity be related to?:
 > Article

 Is the ArticleFollow.article property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to Article so that you can access/update ArticleFollow objects from it - e.g. $article->getArticleFollows()? (yes/no) [yes]:
 > yes

 A new property will also be added to the Article class so that you can access the related ArticleFollow objects from it.

 New field name inside Article [articleFollows]:
 >

 Do you want to activate orphanRemoval on your relationship?
 A ArticleFollow is "orphaned" when it is removed from its related Article.
 e.g. $article->removeArticleFollow($articleFollow)

 NOTE: If a ArticleFollow may *change* from one Article to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\ArticleFollow objects (orphanRemoval)? (yes/no) [no]:
 > yes

 updated: src/Entity/ArticleFollow.php
 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > ManyToOne

 What class should this entity be related to?:
 > User

 Is the ArticleFollow.user property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to User so that you can access/update ArticleFollow objects from it - e.g. $user->getArticleFollows()? (yes/no) [yes]:
 > yes

 A new property will also be added to the User class so that you can access the related ArticleFollow objects from it.

 New field name inside User [articleFollows]:
 >

 Do you want to activate orphanRemoval on your relationship?
 A ArticleFollow is "orphaned" when it is removed from its related User.
 e.g. $user->removeArticleFollow($articleFollow)

 NOTE: If a ArticleFollow may *change* from one User to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\ArticleFollow objects (orphanRemoval)? (yes/no) [no]:
 > yes

 updated: src/Entity/ArticleFollow.php
 updated: src/Entity/User.php
```