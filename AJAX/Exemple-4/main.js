// Déclaration des variables

var url = "http://api.zippopotam.us/fr/";
var $cpInput = $('#codePostal');
var $villeInput = $('#ville');

$cpInput.keyup(function()
{
    if($cpInput.val().length != 5)
    {
        return;
    }

    // AJAX
    // var xhr = $.ajax({
    //     method: "GET",
    //     url: url+ $cpInput.val(),
    //     dataType : 'json'
    // });

    // xhr.done(function(data){
        
    //     console.log(data);
        
    //     $villeInput.prop('disabled', false);
    //     $villeInput.html('');

    //     $.each(data.places, function(index, value)
    //     {
    //         $villeInput.append('<option value="' + value["place name"] + '">' + value["place name"] + '</option>');
    //     });
    // });

    // xhr.fail(function()
    // {
    //     console.log("Erreur AJAX");
    // })

    $.getJSON(url + $cpInput.val(), function(data)
    {
        $villeInput.prop('disabled', false);
        $villeInput.html('');
        $.each(data.places, function(index, value)
        {
            $villeInput.append('<option value="' + value["place name"] + '">' + value["place name"] + '</option>');
        });
    }).fail(function()
        {
            console.log('Erreur AJAX')
        })
})