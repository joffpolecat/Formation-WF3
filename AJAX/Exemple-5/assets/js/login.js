$(function(){

var url = 'src/checkUser.php';
var $username = $('#register-form [name="username"]');
var $email = $('#register-form [name="email"]');
$('#register-form .form-error').hide();

function checkUser(e)
{
    // $form = $('#register-form');
    // $data = $form.serialize();
    $.getJSON(url, {username: $username.val(), email: $email.val()} /* data */, function(result){
        
        if(!result.success)
        {
            $('#register-form .form-error').html(result.message);
            $('#register-form .form-error').show();
            $('#register-form [name="register"]').addClass('disabled');
            $('#register-form [name="register"]').prop('disabled', true);
        }
        else
        {
            $('#register-form .form-error').html("");
            $('#register-form .form-error').hide();
            $('#register-form [name="register"]').removeClass('disabled');
            $('#register-form [name="register"]').prop('disabled', false);
        }
    });
}

$username.keyup(checkUser);
$email.keyup(checkUser);

});