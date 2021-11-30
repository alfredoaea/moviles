$(document).ready(function()
{
  //cargar el carro
   function load_cart()
   {
       var wrapper = $('#cart_wrapper'),
       action = 'get';

      //peticion ajax
      $.ajax({
          url: 'app/ajax.php',
          type: 'GET'
      });
   };

    load_cart();
});

