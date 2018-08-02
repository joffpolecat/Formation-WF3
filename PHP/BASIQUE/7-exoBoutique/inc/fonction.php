<?php

// Création d'une fonction pour afficher les var_dump() & print_r()
function debug($var, $mode = 1)
{
    // Version Bootstrap
    echo '<div class="text-light font-weight-bold p-3 mb-5" style="background: #' . rand(111, 999) .'">';

    // Version manuelle
    // echo '<div style="color: white; font-weight: bold; padding: 20px; background: #' . rand(111, 999) .'">' 
    
    $trace = debug_backtrace();
    // La fonction debug_backtrace() va permettre de tracer l'endroit où une fonction est appelée / executée => MULTIDIMENSIONNEL

    $trace = array_shift($trace);
    // La fonction array_shift() me permet de casser le 1er rang d'un ARRAY MULTI pour renvoyer les 1ers résultats.

    echo "Le débug à été demandé dans le fichier $trace[file] à la ligne $trace[line] <hr>";

    echo '<pre>';

        switch ($mode) 
        {
            case '1':
                var_dump($var);
                break;
            
            default:
                print_r($var);
                break;
        }

    echo '</pre>';

    echo '</div>';
}



// Fonction pour vérifier que l'user est connecté
function userConnect()
{
    /*
        if(!isset($_SESSION['membre']))
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    */

    // Équivaut à la même chose, seul la syntaxe est différente

    if(isset($_SESSION['membre'])) return TRUE;
    else return FALSE;
}




// Fonction pour vérifier que l'user = ADMIN
function userAdmin()
{
    if(userConnect() && $_SESSION['membre']['statut'] ==1) return TRUE;
    else return FALSE;
}