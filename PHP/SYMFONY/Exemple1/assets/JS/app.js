import 'bootstrap';

$(document).ready(function(){

    var $form = $('#follow-form');

    $form.submit(function(){

        var $self = $(this); // Récupère l'objet jQuery form

        $.post($self.attr('action'), $self.serialize(), function(data){

            $self.closest('article').find('.follower-count').html(data.message);

            if (data.isFollow) {
                // Ajoute la classe "bg-danger", supprime la classe "bg-muted"
                $self
                    .find('button[type="submit"]')
                    .addClass('bg-danger')
                    .removeClass('bg-muted');
            }
            else {
               // Ajoute la classe "bg-muted", supprime la classe "bg-danger"
               $self
                    .find('button[type="submit"]')
                    .addClass('bg-muted') 
                    .removeClass('bg-danger');
            }

        }, 'json');

        return false;
    });

});