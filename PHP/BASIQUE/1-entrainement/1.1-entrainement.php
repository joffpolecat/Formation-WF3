<h1>1. Affichage</h1>

<?php
    echo "Bonjour"; // echo nous permet d'afficher du texte
    echo "<br>"; # je suis un commentaire 
    print "Bienvenue à ce cours"; /*
    print est un équivalent à echo
    */
?>

<p>Salut, je suis un texte</p>
<br>
<!-- Forme contractée particulièrement utilisée dans les CMS et les frameworks. Elle permet de ne pas écrire echo ou print-->
<p>Attention à cette autre <?= "forme contractée" ?></p> <!-- le = équivaut à php echo -->

<hr> <!-- _____________________________________________ -->

<h1>2. Variables : type, déclaration, affectation</h1>

<?php
# une variable permet de conserver et transporter une valeur

$prenom = 'Joe'; // attention à ne pas mettre d'accents ou de signes dans le nom de nos variables
echo $prenom;
echo '<br>';

$prenom = "Laurent";
echo $prenom;
echo '<br>';


$a = 127;
echo gettype($a); // gettype() est une fonction qui permet d'avoir le type de la valeur
//integer - entier
echo '<br>';

$double = 1.5;
echo gettype($double); 
//double - chiffre avec une virgule
echo '<br>';

$string = "Aloha";
echo gettype($string); 
//string - texte
echo '<br>';


$b = "1";
echo gettype($b);
//string - texte
echo '<br>';

$boolean = TRUE;
echo gettype($boolean);
//boolean - Vrai / Faux || 0 / 1
echo '<br>';

/* integer ou INT
double ou float ou real
string
boolean ou BOOL
unset ou NULL
array
object
 */

?>

<hr> <!-- _____________________________________________ -->

<h1>3. Concaténation</h1>

<?php 
echo "Bonjour" . " tout le monde" . "<br>"; //on peut faire une concaténation avec un point ou une virgule. Le point est beaucoup plus utilisé que la virgule et donc recommandé.

echo 'bonjour ' . $prenom . '<br>';

echo 'Bonjour aujourd\'hui <br>'; // si je souhaite rajouter un apostrophe dans une simple quote, il faut placer un anti-slash \ avant la quote.

$var = "Comment allez-vous ";
echo $var . $prenom . ' ?';
echo '<br>';

$prenom = 'Anthony';
$prenom .= " Pierini"; // équivaut à : $prenom = $prenom . "Pierini";
// $prenom .= $var; // Nous pouvons concaténer des variables et tout autre type
echo $prenom;
?>

<hr> <!-- _____________________________________________ -->

<h1>4. Quotes et guillemets</h1>

<?php

echo 'bonjour $prenom <br>';
echo "bonjour $prenom <br>";
// nos double quotes nous permettent de ne pas concaténer, la variable est interprétée.

$msg1 = "aujourd'hui";
$msg2 = 'aujourd\'hui';

echo $msg1 . " " . $msg2;
?>

<hr> <!-- _____________________________________________ -->

<h1>5. Constantes</h1>

<?php

# Rôle d'une constante = garder en mémoire tout le temps une valeur et impossibilité de la redéfinir.

define("VILLE", "Paris"); //Quand on écrit une constante, toujours l'écrire en CAPS
// fonction qui prend en compte deux arguments : le nom de la constante + sa valeur. Une constante s'écrit tout le temps en majuscules, c'est une convention.

echo VILLE;

// define ("VILLE", "Luxembourg");
// Notice: Constant VILLE already defined in C:\wamp\www\PHP\1-entrainement\1.1-entrainement.php on line 119 || UNE CONSTANTE NE SE REDÉFINIT PAS

echo '<br>';
echo __FILE__;
echo '<br>';
echo __DIR__;
echo '<br>';
echo __LINE__;
echo '<br>';

?>

<hr> <!-- _____________________________________________ -->

<h1>6. Opérateurs arithmétiques</h1>

<?php

$a = 10; $b = 2;
echo $a + $b . '<br>';
echo $a - $b . '<br>';
echo $a * $b . '<br>';
echo $a / $b . '<br>';

echo $a += $b; // équivaut à $a = $a + $b
echo '<br>';

$a++; // équivaut à $a += 1;
echo $a;
echo '<br>';

$a--; // équivaut à $a -= 1;
echo $a;
echo '<br>';

/*
$a = &$b;
echo $a;
echo '<br>';
echo $b;
echo '<br>';
$b = 41;
echo $a;
echo '<br>';
$a = 53;
echo $b;
echo '<br>';
*/

$a = 10; $b = 3;
echo $a % $b; // le modulo nous affiche le reste de la division

?>

<hr> <!-- _____________________________________________ -->

<h1>7. Structures conditionnelles (if, else, if else, switch,...)</h1>

<?php 

$a = 10; $b = 5; $c = 2;

echo "a = $a / b = $b / c = $c <br>";

if($a > $b) {
    echo "A est bien supérieur à B";
} else { // else équivaut au cas par défaut, il s'affichera si aucune des conditions n'est remplie
    echo "B est supérieur à A";
}

echo '<br>';


if ($a > $b && $b > $c){
    echo "Toutes les conditions sont remplies";
}

echo '<br>';

if ($a == 9 || $b > $c){ // || >< XOR
    echo "On rentre dans une des deux conditions";
}

echo '<br>';

if($a == 8){
    echo '$a et bien égal à 8';
}elseif($a != 10) {
    echo '$a est différent de 10';
}else {
    echo "Aucune condition n'est remplie";
}

echo '<br>';

echo ($a == 10) ? '$a est égale à 10' : 'pas d\égalité';

echo '<br>';

if ($a == 10) {
    echo '$a est égale à 10';
}else {
    echo 'pas d\égalité';
}   

echo '<br>';

echo ($a == "10") ? '$a est égale à "10"' : 'pas d\égalité';

echo '<br>';

// $var2 = "yeah";

if (isset ($var2)){
    echo "La variable existe bien";
} else {
    echo "Non la variable n'existe pas.";
}

echo '<br>';

$var3 ="";
if (empty($var3)){
    echo "la variable est bien vide";
}else {
    echo "la variable contient une valeur";
}
echo '<br>';

/*
$var4 = isset($var) ? $var : "pas de valeur";

Pour remplir $var4 je vais tester l'existence de $var. 
Si elle existe, on lui donne la valeur de $var,
sinon on lui donne la string définie

echo $var4;
echo '<br>';
*/

$couleur = "rouge";

switch ($couleur) {
    case 'bleu':
    echo "vous aimez le bleu";
    break;
    case 'jaune':
    echo "vous aimez le jaune";
    break;
    case 'rouge':
    echo "vous aimez le rouge";
    break;
    default:
    echo 'Vous n\'aimez pas les couleurs primaires';
}

echo '<br>';

if($couleur == "bleu"){
    echo 'Vous aimez le bleu';

} elseif ($couleur == "jaune"){
    echo 'Vous aimez le jaune';

} elseif ($couleur == "rouge") {
    echo 'Vous aimez le rouge';

} else {
    echo 'Vous n\'aimez pas les couleurs primaires';
}

?>

<hr> <!-- _____________________________________________ -->

<h1>8. Fonctions préféfinies</h1>

<?php 

    #FONCTION = bout de code pré-codé qu'on active en l'appelant par son nom

    $phrase = "Je suis un texte éà";
    echo iconv_strlen($phrase); //compte le nombre de caractères 

    echo '<br>';

    echo strlen($phrase); // Compte en nombre de bits : les accents sont comptés 

    echo '<br>';

    echo substr($phrase, 0, 10); //substr() prend 3 paramètres : la variable, le point de départ et le point d'arrêt.

    echo '<br>';

    echo date('W, d/m/Y');

    echo '<br>';

    echo "<h3>Conditions + Fonctions</h3>";

    $pseudo = 'Joker';

    if( empty($pseudo) ){
        echo "Pas de pseudo";
    }else{
        echo "Bonjour $pseudo !";
    }
?>


<hr> <!-- _____________________________________________ -->

<h1>9. Fonctions utilisateurs</h1>

<?php 

    #Fonctions qui n'existent pas encore

    function bonjour() { // Les parenthèses peuvent accepter des arguments
        echo "Bonjour";
    }

    bonjour();

    echo '<br>';

    function aloha ($name) {
        echo "Aloha $name";
    }
    aloha('Cacahuète');
    echo '<br>';
    aloha('Anas');
    echo '<br>';

    echo "<h3>Global VS local</h3>";

    function jourSemaine() {
        $jour = "mardi";
        return $jour;
    }

    echo jourSemaine();

    echo '<br>';

    $pays = "France";

    function affichePays(){
        global $pays;
        echo $pays;
    }

    affichePays();

?>


<hr> <!-- _____________________________________________ -->

<h1>10. Boucle ou structure intérative</h1>

<?php 

    #Répétition de portion de code >> boutique ecommerce, liste d'amis sur un RS,...

    #DRY >> don't repeat yourself VERSUS WET >> write everything twice

    // 4 types de boucles : while, dowhile, for, foreach

    $i = 0;
    while ($i <= 9){

        $i++;
        
        if ($i < 10) {
            echo "Bonjour $i - ";
        } else {
            echo "Bonjour $i";
        }
    }

    echo '<br>';

    echo "<h3>For</h3>";

    for( $i=0 ; $i<=15 ; $i++ ){
        echo "Tour n°$i <br>";
    }

    echo '<br>';

    echo "<select>";
        echo "<option>1920</option>";
        echo "<option>1921</option>";
    echo "</select>";

    echo "<select>";
    for ($i= date('Y'); $i >= 1900 ; $i--) {
        echo "<option>$i</option>";
    }
    echo "</select>";

    echo '<br>'; echo '<br>';

    echo "<table border=1>";
    for ($i= 0 ; $i < 100 ; $i++) {

        if($i ==0){
            echo "<td>$i</td>";
        }elseif($i %100 == 0){
            echo "<td>$i</td>";
            echo "</tr>";
        }elseif ($i %10 ==0) {
            echo "<tr>";
            echo "<td>$i</td>";
        } else {
            echo "<td>$i</td>";       
                 
        }
        
    }
    echo "</table>";

?>

<hr> <!-- _____________________________________________ -->

<h1>11. Inclusion de fichiers</h1>

<?php 

    // include("fichier.txt");
    // include_once("fichier.txt"); // Permet d'afficher une seule fois le fichier. S'il n'est pas trouvé, la page ne plante pas.


    // require ("fichier.txt");
    // require_once("fichier.txt"); //Bloque l'execution du code si le fichier n'est pas trouvé

?>