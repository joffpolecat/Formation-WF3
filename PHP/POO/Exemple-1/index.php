<?php 

class Auteur
{
    private $nom = "Nom auteur";

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
        return $this;
    }
}

class Article
{
    // Propriétés :
    private $titre = "Titre par défaut - NON dynamique"; 

    /*
        si on ne set pas $titre a posteriori, $titre aura comme valeur cette string
        il n'est pas obligatoire de définir cette propriété, on peut se contenter de la déclarer, 
        auquel cas si on crée par la suite une instance sans donner de valeur à $titre, 
        $titre sera vide
    */

    private $contenu;
    private $statut;
    private $auteur;

    public static $counter = 0;

    // Contantes :
    const S_PUBLIC = 1;
    const S_PRIVATE = 0;

    // Contructeur :
    public function __construct($titre, $contenu, Auteur $auteur)
    {
        $this->setTitre($titre);
        $this->setContenu($contenu);
        $this->auteur = $auteur; // ou $this->setAuteur($auteur)
        $this->statut = self::S_PUBLIC;
        self::$counter++;

        $this->setContenu($contenu);
    }

    // Méthodes :
    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($nouveauTitre)
    {        
        $this->titre = $nouveauTitre;
        return $this;
    }

    public function isPublic()
    {
        return $this->statut == self::S_PUBLIC;
    }

    public function getCounter() 
    {
        return self::$counter;
    }

    // Getter / Setter obtenu avec clic droit sur $contenu :
    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function setAuteur(Auteur $auteur)
    {
        $this->auteur = $auteur;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }
    
    public function getInfos()
    {
        return $this->getTitre() . ' ' . $this->auteur->getNom() . ' ' . $this->getContenu();
    }
}



// echo Article::$counter . '< article(s) <br>';

// $monArticle = new Article("Article 1");
// echo Article::$counter . '< article(s) <br>';

// $article2 = new Article("Article 2");
// echo Article::$counter . '< article(s) <br>';

// echo Article::getCounter();



$auteur = new Auteur;
$article1 = new Article('Titre', 'Contenu', $auteur);

// echo $article1->getInfos();
echo '<br>';

$article1->setTitre('Nouveau titre')
->setContenu('Nouveau contenu')
->setAuteur($auteur);

$article1->getAuteur()->setNom("Nouvel auteur");

echo $article1->getInfos();