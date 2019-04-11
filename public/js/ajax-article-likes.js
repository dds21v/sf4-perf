console.log('JS Bien Chargé');



// language=JQuery-CSS
$('#likes button').on('click', function(){
    //Récupération de l'id
    const slug= $('#likes button').first().data('slug');

    const params = {
        url: 'http://sf4perf.local/api/article/likes/' + slug
    };

    // Lancement de l'appel Ajax
    $.ajax(params).done(displayNewLikes);
});







function displayNewLikes(json)
{
    //Afficher une nouvelle valeur du nombre de likes
    $('#likes span').text(json.cpt);
}

