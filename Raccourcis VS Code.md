# Créer des snippets sur Visual Studio Code

> Tout d'abord, remerciez Steve, c'est grâce à lui que vous avez ce petit tuto ! ʕ•͡ᴥ•ʔ


## Sommaire des snippets triés par language :

- [Les snippets de Steve](https://github.com/Piotezaza/CoursNumericall/blob/master/Cr%C3%A9atio```n%20raccourcis%20VS%20Code.md#petite-liste-avec-les-snippets-php-de-steve-%EF%BE%9F-%E3%83%BD%E3%83%AE%E3%83%BD)

- [Snippets Twig](https://github.com/Piotezaza/CoursNumericall/blob/master/Cr%C3%A9ation%20raccourcis%20VS%20Code.md#twig)

--- 

Les raccourcis *appellés `snippet`* sont utilisés pour gagner du temps. Par exemple, si tu commences à écrire `html` tu vas avoir l'auto-complétion avec des portions de code pré-enregistrées qui vont apparaître et tu auras juste à faire `TAB` ou `ENTRER` pour que ça s'affiche. Je vais donc vous expliquer comment créer tout ça pour gagner du temps lors de vos séances de codage.

## Manip's dans Visual Studio Code

### 1ère étape : **organisation de nos snippets**

- Clique sur l'engrenage en bas à gauche de ton écran. Un menu s'affiche. 
- Clique sur `Paramètres`.
- Dans `Paramètres utilisateur` colle ce bout de code à la fin *(n'oublies pas les virgules !)* : `"editor.snippetSuggestions": "top"`. Il permet de placer **tes propres** snippets tout en haut dans les suggestions. Elles seront donc prioritaires sur les autres, ce qui est bien pratique !

### 2ème étape : **accéder au bon fichier pour le bon language**

- Clique sur le même engrenage que pour la 1ère étape. 
- Clique sur `Extraits de code de l'utilisateur`
- Sélectionne le language pour tes snippets. Ici on va prendre **PHP**.
- Un fichier `.json` va s'ouvrir et là on commence à prendre son pied \ (•◡•) /

### 3ème étape : **créer un snippet**

En soit, c'est écrit sur le fichier, mais on va reprendre pas à pas les étapes clés pour créer correctement un snippet. 

Chaque snippet doit contenir :

- Un **nom** : c'est juste le nom de ton snippet, rien de bien compliqué.
- Un **prefixe** : c'est ce que tu vas écrire pour appeler ton snippet. 
- Un **body** : la manière dont ton snippet va fonctionner.
- Une **description** : petit descriptif de ta fonction et/ou de ton snippet.

Voici l'apparence d'un snippet :

```json
"NOM": {
	"prefix": "CE QUE TU VAS ÉCRIRE",
	"body": [
	"CE QUI VA APPARAÎTRE SUR UNE",
        "OU DEUX LIGNES"
	],
	"description": "TA DESCRIPTION"
}
```
---

**PREREQUIS**

Dans un snippet, tu as déjà dû le remarquer, ton curseur se met **AUTOMATIQUEMENT** à des endroits **clés** pour te faire gagner du temps. Tu as juste à faire `TAB` pour naviguer entre les différents paramètres de ton raccourci pour écrire ce que tu veux. 

Pour insérer un emplacement de curseur, il suffit d'écrire `${1:}`. 
- le `${}` indique qu'il va y avoir une interraction avec le curseur, on y entre des paramètres comme expliqué en dessous.
- Le `1:` représente l'ordre de navigation de ton curseur. Si tu as qu'un emplacement, il faut quand même le mettre. Si tu en as plusieurs, il te suffit d'incrémenter à la mano tes numéros.

Tu as peut-être déjà remarqué mais des fois, t'as carrément un texte sélectionné qui apparaît ! ⚆ _ ⚆ 

C'est l'oeuvre du `:` apres le `1`. Pour écrire le texte, il te suffit d'écrire ce que tu veux derrière les deux points. Je vais faire quelques exemples pour que ce soit bien clair.

**BONNUS** : Pour faire une tabulation, écris juste `\t` à l'endroit où tu veux la voir apparaître !

---

**EXEMPLE 1 :** Snippet pour la fonction `if()`

```json
"if()": {
	"prefix": "if",
	"body": [
	"if(${1:})",
        "{",
        "\t${2:}",
        "}"
	],
	"description": "Petit if des familles"
}
```

Le résutat sera le suivant :

```php
if(EMPLACEMENT1)
{
EMPLACEMENT2
}
```

---

**EXEMPLE 2 :** Snippet pour initier une base de donnée *(issu du code de Steve)*

```json
"BDD": {
		"prefix": "BDD",
		"body": [
			"$$dsn = 'mysql:host=${1:localhost}; dbname=${2:nom}';",
			"$$login = '${3:root}';",
			"$$pwd = '${4:}';",
			"$$attributes = [",
			"\tPDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,",
			"\tPDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',",
			"\tPDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC",
			"];",
			"$$pdo = new PDO($$dsn, $$login, $$pwd, $$attributes);"
		],
		"description": "Connexion à la BDD"
	}
```

Le résutat sera le suivant :

```php
$dsn = 'mysql:host=localhost; dbname=nom';
$login = 'root';
$pwd = '';
$attributes = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO($dsn, $login, $pwd, $attributes);
```

Pour mieux visualiser les emplacements :

```php
$EMPLACEMENT5 = 'mysql:host=EMPLACEMENT1; dbname=EMPLACEMENT2';
$EMPLACEMENT6 = 'EMPLACEMENT3';
$EMPLACEMENT7 = 'EMPLACEMENT4';
$EMPLACEMENT8 = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$EMPLACEMENT9 = new PDO($EMPLACEMENT5, $EMPLACEMENT6, $EMPLACEMENT7, $EMPLACEMENT8);
```

---

À TOI DE JOUER \ (•◡•) /

---

## Petite liste avec les snippets **PHP** de Steve ✧ﾟ･: *ヽ(◕ヮ◕ヽ)

```json
"print_r()": {
		"prefix": "printr",
		"body": [
			"print_r(${1:})"
		],
		"description": "print_r()"
	},
	"get_declared_classes()": {
		"prefix": "getdeclaredclasses",
		"body": [
			"get_declared_classes(${1:})"
		],
		"description": "toutes les classes dispo dans php"
	},
	"get_class_methods()": {
		"prefix": "getclassmethods",
		"body": [
			"get_class_methods($${1:variable})"
		],
		"description": "get_class_methods()"
	},
	"gettype()": {
		"prefix": "gettype",
		"body": [
			"gettype($${1:variable})"
		],
		"description": "gettype()"
	},
	"ucfirst()": {
		"prefix": "ucfirst",
		"body": [
			"ucfirst(${1:})"
		],
		"description": "mets en majuscule la premiere lettre du sujet selectionné"
	},
	"str_replace()": {
		"prefix": "strreplace",
		"body": [
			"str_replace('${1:elemToReplace}', '${2:newElem}', '$${3:variable}')"
		],
		"description": "remplace un caractere par un autre"
	},
	"define()": {
		"prefix": "define",
		"body": [
			"define(${1:},${2:});"
		],
		"description": "define()"
	},
	"password_hash()": {
		"prefix": "passwordhash",
		"body": [
			"password_hash($_POST['${1:mdp}'], ${2:PASSWORD_BCRYPT});"
		],
		"description": "sécurise l'enregistrement du mdp dans le BDD"
	},
	"isset()": {
		"prefix": "isset",
		"body": [
			"isset($${1:variable})"
		],
		"description": "vérifie si la variable est définie et si elle n'est pas nulle"
	},
	"empty()": {
		"prefix": "empty",
		"body": [
			"empty($${1:variable})"
		],
		"description": "empty()"
	},
	"implode()": {
		"prefix": "implode",
		"body": [
			"implode($${1:variable}, ' ${2:-} ')"
		],
		"description": "implode()"
	},
	"iconv_strlen()": {
		"prefix": "inconvstrlen",
		"body": [
			"iconv_strlen(${1:variavle})"
		],
		"description": "affiche la longueur de $variable"
	},
	"strlen()": {
		"prefix": "strlen",
		"body": [
			"strlen(${1:variable})"
		],
		"description": "Compte la $variable en nombre de bit"
	},
	"substr()": {
		"prefix": "substr",
		"body": [
			"substr($${1:variable}, ${2:depart}, ${3:arret})"
		],
		"description": "substr()"
	},
	"mail()": {
		"prefix": "mail",
		"body": [
			"mail($${1:destinataire}, $${2:sujet}, $${3:contenu},, $${4:header});"
		],
		"description": "mail()"
	},
	"date()": {
		"prefix": "date",
		"body": [
			"date('${1:W}, ${2:d/m/Y}')"
		],
		"description": "date()"
	},
	"setCookie()": {
		"prefix": "setCookie",
		"body": [
			"setCookie('${1:nomCookie}', $${2:valeurCookie}, time() + 365 * 24 * 3600)"
		],
		"description": "setCookie()"
	},
	"session_start()": {
		"prefix": "sessionstart",
		"body": [
			"session_start(${1:})"
		],
		"description": "Ouverture de session"
	},
	"session_destroy()": {
		"prefix": "sessiondestroy",
		"body": [
			"session_destroy(${1:})"
		],
		"description": "fermeture de session"
	},
	"unset()": {
		"prefix": "unset",
		"body": [
			"unset($_SESSION['${1:nom}'])"
		],
		"description": "retirer des parametres de la session"
	},
	"query()": {
		"prefix": "query",
		"body": [
			"query(${1:requête})"
		],
		"description": "requête"
	},
	"prepare()": {
		"prefix": "prepare",
		"body": [
			"prepare(${1:})"
		],
		"description": "exécute une requête préparée à l'avance"
	},
	"execute()": {
		"prefix": "execute",
		"body": [
			"execute(${1:})"
		],
		"description": "prépare une requête pour l'executer"
	},
	"lastInsertId()": {
		"prefix": "lastInsertId",
		"body": [
			"lastInsertId(${1:})"
		],
		"description": "récupère l'ID du dernier enregistrement effectué dans la BDD"
	},
	"fetch()": {
		"prefix": "fetch",
		"body": [
			"fetch(${1:})"
		],
		"description": "renvoie un ARRAY"
	},
	"fetchAll()": {
		"prefix": "fetchAll",
		"body": [
			"fetchAll(${1:})"
		],
		"description": "renvoie un ARRAY multidimensionnel"
	},
	"fetch_field()": {
		"prefix": "fetchfield",
		"body": [
			"fetch_field(${1:})"
		],
		"description": "retourne le nom des champs de la table selectionnée"
	},
	"fetch_assoc()": {
		"prefix": "fetchassoc",
		"body": [
			"fetch_assoc(${1:})"
		],
		"description": "convertit un OBJET en ARRAY"
	},
	"fetch_row()": {
		"prefix": "fetchrow",
		"body": [
			"fetch_row(${1:})"
		],
		"description": "indexer de manière numérique"
	},
	"fetch_array()": {
		"prefix": "fetcharray",
		"body": [
			"fetch_array(${1:})"
		],
		"description": "indexer de manière numérique + associative"
	},
	"rowCount()": {
		"prefix": "rowCount",
		"body": [
			"rowCount(${1:})"
		],
		"description": "compter le nombre de lignes en résultat"
	},
	"header()": {
		"prefix": "header",
		"body": [
			"header(location:${1:chemin})"
		],
		"description": "redirige l'internaute sur une autre page"
	},
	"addslashes()": {
		"prefix": "addslashes",
		"body": [
			"addslashes(${1:})"
		],
		"description": "protège les caractères spéciaux d'un formulaire"
	},
	"extract()": {
		"prefix": "extract",
		"body": [
			"extract(${1:})"
		],
		"description": "extrait les valeurs d'un array dans des variables"
	},
	"explode()": {
		"prefix": "explode",
		"body": [
			"explode('${1:@}', ${2:STR/VAR})"
		],
		"description": "explose une STR/VAR à partir de l'élément choisi en 1er argument"
	},
	"in_array()": {
		"prefix": "inarray",
		"body": [
			"in_array(${1:aVerif}, $${2:ref})"
		],
		"description": "vérifie sI une valeur existe dans un ARRAY"
	},
	"is_numeric()": {
		"prefix": "isnumeric",
		"body": [
			"is_numeric($${1:})"
		],
		"description": "vérifie si une valeur est numérique ou si c'est une string numérique"
	},
	"preg_match()": {
		"prefix": "pregmatch",
		"body": [
			"preg_match(${1:}, ${2:STR/VAR})"
		],
		"description": "définit les caracteres autorisés dans une STR/VAR"
	},
	"filter_var()": {
		"prefix": "filtervar",
		"body": [
			"filter_var(${1:}, FILTER_VALIDATE_${2:EMAIL})"
		],
		"description": "vérifier une STR (email, URL -> FILTER_VALIDATE_URL)"
	},
	"include()": {
		"prefix": "include",
		"body": [
			"include('${1:fichier.ext}');"
		],
		"description": "inclure un fichier"
	},
	"require()": {
		"prefix": "require",
		"body": [
			"require('${1:fichier.ext}');"
		],
		"description": "requiert un fichier"
	},
	"include_once()": {
		"prefix": "includeonce",
		"body": [
			"include_once('${1:fichier.ext}');"
		],
		"description": "include_once()"
	},
	"require_once()": {
		"prefix": "requireonce",
		"body": [
			"require_once('${1:fichier.ext}');"
		],
		"description": "require_once()"
	},
	"bindValue()": {
		"prefix": "bindValue",
		"body": [
			"bindValue('${1::écouteur}', $${2:variable}, PDO::PARAM_${3:STR});"
		],
		"description": "bindvalue()"
	},
	"fopen();": {
		"prefix": "fopen",
		"body": [
			"fopen('${1:file.txt}', '${2:a}')"
		],
		"description": "fopen()"
	},
	"file();": {
		"prefix": "file",
		"body": [
			"file($${1:fichier})"
		],
		"description": "file()"
	},
	"fwrite();": {
		"prefix": "fwrite",
		"body": [
			"fwrite(${1:}, ${2:})"
		],
		"description": "fwrite()"
	},
	" fclose()": {
		"prefix": " fclose",
		"body": [
			" fclose($${1:});"
		],
		"description": " fclose()"
	},
	"if(condition)": {
		"prefix": "if",
		"body": [
			"if(${1:condition})",
			"{",
			"\t${2:# code...}",
			"}"
		],
		"description": "if condition"
	},
	"if else": {
		"prefix": "ifelse",
		"body": [
			"if(${1:condition})",
			"{",
			"\t${2:# code...}",
			"}",
			"else",
			"{",
			"\t${3:# code...}",
			"}"
		],
		"description": "if else"
	},
	"else": {
		"prefix": "else",
		"body": [
			"else",
			"{",
			"\t${1:# code...}",
			"}"
		],
		"description": "else"
	},
	"if short": {
		"prefix": "ifshort",
		"body": [
			"$${1:retVal} = (${2:condition}) ? ${3:a} : ${4:b} ;"
		],
		"description": "if short"
	},
	"md5()": {
		"prefix": "md5",
		"body": [
			"md5(${1:})"
		],
		"description": "hash une string"
	},
	"uniqid()": {
		"prefix": "uniqid",
		"body": [
			"uniqid(${1:})"
		],
		"description": "renvoie un identifiant unique"
	},
	"copy()": {
		"prefix": "copy",
		"body": [
			"copy(${1:provenance}, ${2:destination})"
		],
		"description": "copie un upload de fichier dans un dossier spécifié"
	},
	"unlink()": {
		"prefix": "unlink",
		"body": [
			"unlink(${1:fichier})"
		],
		"description": "supprime le fichier selectionné"
	},
	"switch": {
		"prefix": "switch",
		"body": [
			"switch ($${1:variable}) {",
			"\tcase '${2:value}'",
			"\t\t${3:# code...}",
			"\tbreak;",
			"\t",
			"\tdefault:",
			"\t\t${3:# code...}",
			"\tbreak;",
			"}"
		],
		"description": "switch"
	},
	//connexion BDD
	"BDD": {
		"prefix": "BDD",
		"body": [
			"$$dsn = 'mysql:host=${1:localhost}; dbname=${2:nom}';",
			"$$login = '${3:root}';",
			"$$pwd = '${4:}';",
			"$$attributes = [",
			"\tPDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,",
			"\tPDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',",
			"\tPDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC",
			"];",
			"$$pdo = new PDO($$dsn, $$login, $$pwd, $$attributes);"
		],
		"description": "Connexion à la BDD"
	}
```


## Twig

```json
"{% block %}": {
		"prefix": "block",
		"body": [
			"{% block $1 %}",
			"\t $2",
			"{% endblock %}",
		],
		"description": "Raccourci pour {% block $1 %} $2 {% endblock %}"
	},

	"{% extends '' %}": {
		"prefix": "extends",
		"body": [
			"{% extends '$1' %}",
		],
		"description": "Raccourci pour {% extends '$1' %}"
	},

	"{% embed %}": {
		"prefix": "embed",
		"body": [
			"{% embed '$1' %} $2{% endembed %}",
		],
		"description": "Raccourci pour {% embed $1 %} $2 {% endembed %}"
	},

	"{% for %}": {
		"prefix": "for",
		"body": [
			"{% for $1 %} $2{% endfor %}",
		],
		"description": "Raccourci pour {% for $1 %} $2 {% endfor %}"
	},

	"{{ }}": {
		"prefix": "bal",
		"body": [
			"{{ $1 }}",
		],
		"description": "Raccourci pourles doubles balises"
	},

	"{% set %}": {
		"prefix": "set",
		"body": [
			"{% set $1 %}",
		],
		"description": "Création de variable avec set"
	},

	"{% ''|trans %}": {
		"prefix": "trad",
		"body": [
			"{{ '$1'|trans$2 }}",
		],
		"description": "Traduction"
	},

	"{% ''|transchoice() %}": {
		"prefix": "trad",
		"body": [
			"{{ '$1'|transchoice($2) }}",
		],
		"description": "Traduction à choix multiples"
	}
```