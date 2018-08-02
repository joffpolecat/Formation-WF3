$(function()
{
    var $form = $('#message-form');
    var lastId = 0;
    var $messageMe = $('#messages .me');
    var $messageNotMe = $('#messages .not-me');

    function showMessages(data)
    {
        $.each(data.messages, function(index, value){
            $message = (data.user.id == value.user? $messageMe.clone(): $messageNotMe.clone()); // ATTENTION !!!!!! Si la BDD c'est user_id, bien penser à rajouter le _id !!!
            $message.find('.avatar img').attr('src', 'uploads/' + value.avatar);
            $message.find('.content').html(value.content);
            $message.find('.infos').html(value.username + ' - ' + formatDate(value.date));
            $message.removeClass('d-none');
            $('#messages').append($message);
        });
    }

    function formatDate(timestamp)
    {
        var date = new Date(timestamp * 1000);
        return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' ' + date.getHours() + 'h' + date.getMinutes();
    }

    function postMessage()
    {
        // $.ajax({ url: '...', method: 'POST', data: $form.serialize()}).done(function(data){})
        $.post(
            'src/postMessage.php', 
            $form.serialize() /* {message: $message.val(), ...} */, 
            function(data)
            {
                $form.find('[name="message"]').val('');
            }
            , 'json'
        );

        return false;
    }

    $form.submit(postMessage);

    function getMessage()
    {
        $.getJSON('src/getMessage.php', {lastId: lastId}, function(data){
            
            if (data.messages.length == 0) {
                return;
            }

            showMessages(data);

            // Récupère l'id du dernier message
            lastId = data.messages[data.messages.length - 1].id;
            console.log(lastId);

            // Scroll en bas de la page
            $('html').animate({scrollTop: $(document).height()}, 'slow');
        })
    }

    getMessage();
    setInterval(getMessage, 1000);
});