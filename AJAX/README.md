# Mémo

- [AJAX](https://github.com/Piotezaza/CoursNumericall/tree/master/AJAX#AJAX)
- [PHP](https://github.com/Piotezaza/CoursNumericall/tree/master/AJAX#PHP)

## Cours

- [Openclassrooms](https://openclassrooms.com/courses/245710-ajax-et-lechange-de-donnees-en-javascript)

## AJAX

### JAVASCRIPT

- `var hxr = new XMLHttpRequest` : fais un appel AJAX en natif
- `xhr.open(METHOD, URL, ASYNC)` : prépare la requête
- `this.status` : status de la réponse serveur
- `this.readyState` : état de la requête, 200 = OK // 4 = requête finir, le serveur a répondu
- `this.responseText` : contenu de la réponse
- `JSON.parse(STRING)` : transforme une chaîne (JSON) en objet JS
- `JSON.stringify(OBJECT)` : transforme un objet en chaîne (JSON)
- `xhr.send()` : envoi de la requête

#### CODE TYPE

```
var hxr = new XMLHttpRequest;
xhr.open(METHOD, URL, ASYNC);

xhr.onreadystatechange = function()
{
    this.status;
    this.readyState;
    this.responseText;
    JSON.parse(STRING);
    JSON.stringify(OBJECT);
}

xhr.send();
```

### JQUERY

- `url: ''` : lien vers le script à appeler
- `method: 'POST'` : ou GET
- `data: {}` : **OBJET** `{ username: 'Bob', password: '1234' }` ou **CHAÎNE** `( "username=Bob&password=1234" )`
- `dataType: 'html'` : ou JSON
- `console.log(data);` : affichage du contenu de la réponse

#### CODE TYPE

```
$.ajax({

    url: '',
    method: 'POST',
    data: {},
    dataType: 'html',
    beforeSend: function(){

    },
}).done(function(data){

    console.log(data);

}).fail(function(xhr, textStatus){

    // Erreur

});
```

---

#### Permet de paramétrer toutes les prochaînes requêtes AJAX (et donc de gagner du temps)


```
$.ajaxSetup({
    url: 'script.php'
});

$.ajax({}).done(...);
```

---

#### Requête GET & POST

```
$.get(URL, DATA, function(data){}, DATATYPE); // Requête GET
$.post(URL, DATA, function(data){}, DATATYPE); // Requête POST
$.getJSON(URL, DATA, function(data){}); // Requête GET type JSON
$.post(URL, DATA, function(data){}, 'json'); // Requête GET type JSON
```

--- 

- `$('form').serialize()` : retourne les données d'un formulaire sous forme de chaîne encodée pour les URL

---

## PHP

- `header('Content-Type: application/json')` : indique dans le header que la réponse sera sous forme de JSON
- `json_encode(array)` : retourne une chaîne JSON à partir d'un tableau
- `json_decode(string, /* true: retourne un array*/` : retourne un objet PHP à partir d'une chaîne JSON