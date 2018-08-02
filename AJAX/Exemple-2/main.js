// DÉCLARATION DES VARIABLES

var url ="lastArticles.json?r="; 
var refreshButton = document.getElementById('refresh');
var lastNews = document.getElementById('last-news');
var lastNewsFooter = document.getElementById('last-news-footer');
var articleTemplate = lastNews.querySelector('li.media');
var xhttp = new XMLHttpRequest();

articleTemplate.remove();

refreshButton.onclick = function(){
    document.getElementById('refresh-icon').classList.add("fa-spin");

    // Préparation de la requête
    xhttp.open("GET", url + Math.random()); 

    xhttp.onreadystatechange = function()
    {

        if(this.readyState == 4 && this.status == 200)
        {
            // RESET
            lastNews.innerHTML = "";

            // Transforme la réponse en objet JSON
            var data = JSON.parse(this.responseText); 

            // Affichage du nombre d'articles
            lastNewsFooter.innerHTML = data.count + " articles";

            // Affichage des articles
            data.articles.forEach(function(article)
            {
                var newArticleHTML = articleTemplate.cloneNode(true);

                newArticleHTML.querySelector('img').src = article.img;
                newArticleHTML.querySelector('h5').innerHTML = article.title;
                newArticleHTML.querySelector('p').innerHTML = article.description;
                lastNews.appendChild(newArticleHTML);
            });

            document
                .getElementById('refresh-icon')
                .classList.remove('fa-spin');
        }
    };

    xhttp.send(); // Envoie la requête au serveur
};