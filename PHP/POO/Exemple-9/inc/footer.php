</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script>
      $form=$("form");

      function postForm()
      {
        
          //e.preventDefault(); // Pout être sûr qu'il n'y aura pas d'autres méthodes submit appelées
          
          /* 
          $.ajax({ 

              url: '...', 
              method: 'POST', 
              data: $form.serialize()
          })
          .done(function(data){})
          */

          $.post(
              'enregistrerAjax.php', 
              $form.serialize() /* {Form: $Form.val(), ...} */, 
              function(data)
              {
                $('.message').html('<span class="' + data.code + '">' + data.message + '</span>');
              }
              , 'json'
          );

          return false; // évite le rechargement de la page
      }

      $form.submit(postForm);
    </script>
  </body>
</html>