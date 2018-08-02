# EN TRAVAUX - Apprendre le SQL

Le SQL (Structured Query Language) est un langage permettant de communiquer avec une base de données. Ce langage informatique est notamment très utilisé par les développeurs web pour communiquer avec les données d’un site web. SQL.sh recense des cours de SQL et des explications sur les principales commandes pour lire, insérer, modifier et supprimer des données dans une base.

Partons sur le principe d'une base de donnée simple pour pratiquer correctement ces quelques commandes.

Voici le [schéma de la BDD](https://raw.githubusercontent.com/Piotezaza/CoursNumericall/master/SQL/exos/Schema%20BDD.png) ainsi que [le code SQL](https://github.com/Piotezaza/CoursNumericall/tree/master/SQL%20-%20EN%20TRAVAUX#code-sql) pour ajouter la les données à votre BDD fraîchement crée. Pour avoir les mêmes résultats que moi, il vous suffit de vous rendre dans votre **PHPMYADMIN** en local, de séléctionner la base de donnée et de vous rendre dans l'onglet `SQL`.



## Commandes de base

### SELECT

L’utilisation la plus courante de SQL consiste à lire des données issues de la base de données. Cela s’effectue grâce à la commande SELECT, qui retourne des enregistrements dans un tableau de résultat. Cette commande peut sélectionner une ou plusieurs colonnes d’une table.

#### Commande basique

L’utilisation basique de cette commande s’effectue de la manière suivante:

```sql
SELECT nom_du_champ FROM nom_du_tableau
```

Dans notre exemple, on va sélectionner tous (écrit `*` en SQL) les stagiaires. Pour se faire, il suffit d'écrire :

```sql
SELECT * FROM stagiaires
```

Résultat :






















## CODE SQL

```

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `aime` (
  `passions_id_passion` int(11) NOT NULL,
  `stagiare_identifiant_utilisateur` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `aime` (`passions_id_passion`, `stagiare_identifiant_utilisateur`) VALUES
(0, 'tre');

CREATE TABLE `langage` (
  `id_langage` int(11) NOT NULL,
  `nom_langage` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `langage` (`id_langage`, `nom_langage`) VALUES
(0, 'tre');

CREATE TABLE `notesfinales` (
  `stagiare_identifiant_utilisateur` int(11) NOT NULL,
  `langage_id_langage` varchar(80) NOT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `notesfinales` (`stagiare_identifiant_utilisateur`, `langage_id_langage`, `note`) VALUES
(0, 'tre', 0);

CREATE TABLE `passion` (
  `id_passion` int(11) NOT NULL,
  `nom_passion` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pays` (
  `code_pays` int(11) NOT NULL,
  `nom_pays` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `stagiare` (
  `identifiant_stagiare` int(11) NOT NULL,
  `civilte` varchar(80) DEFAULT NULL,
  `prenom` varchar(80) DEFAULT NULL,
  `nom` varchar(80) DEFAULT NULL,
  `adresse` varchar(80) DEFAULT NULL,
  `adresse_compolement` varchar(80) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `abonnement_newsletter` binary(2) DEFAULT NULL,
  `heure_repas_pref` time DEFAULT NULL,
  `commentaire` varchar(80) DEFAULT NULL,
  `villes_code_commune_insee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `stagiare` (`identifiant_stagiare`, `civilte`, `prenom`, `nom`, `adresse`, `adresse_compolement`, `email`, `tel`, `date_naissance`, `abonnement_newsletter`, `heure_repas_pref`, `commentaire`, `villes_code_commune_insee`) VALUES
(0, 'tre', 'tre', 'tre', 'tre', 'tre', 'tre', 0, '0000-00-00', NULL, '00:00:00', 'tre', 0);

CREATE TABLE `villes` (
  `code_commune_insee` int(3) NOT NULL,
  `code_postal` int(10) DEFAULT NULL,
  `nom_ville` varchar(80) DEFAULT NULL,
  `pays_code_pays` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `villes` (`code_commune_insee`, `code_postal`, `nom_ville`, `pays_code_pays`) VALUES
(0, 0, 'tre', 0);

ALTER TABLE `aime`
  ADD PRIMARY KEY (`passions_id_passion`,`stagiare_identifiant_utilisateur`);

ALTER TABLE `langage`
  ADD PRIMARY KEY (`id_langage`);

ALTER TABLE `notesfinales`
  ADD PRIMARY KEY (`stagiare_identifiant_utilisateur`,`langage_id_langage`);

ALTER TABLE `passion`
  ADD PRIMARY KEY (`id_passion`);

ALTER TABLE `pays`
  ADD PRIMARY KEY (`code_pays`);

ALTER TABLE `stagiare`
  ADD PRIMARY KEY (`identifiant_stagiare`);

ALTER TABLE `villes`
  ADD PRIMARY KEY (`code_commune_insee`);
COMMIT;
```