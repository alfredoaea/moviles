$(document).ready(function()
{
  //cargar el carro
   function load_cart()
   {
       var wrapper = $('#cart_wrapper'),
       action = 'get';

      //peticion ajax
      $.ajax({
          url: 'ajax.php',
          type: 'POST',
          dataType: 'JSON',
          data:
          {
            action
          },

          beforeSend: function()
          {
              wrapper.waitMe();
          }

      }).done(function(res){

        if(res.estatus === 200)
        {
            wrapper.html(res.data);
        }

      }).fail(function(err){

            swal.fire('Upss!','Ocurrio un error','error');
            return false;

      }).always(function(){

          setTimeout(() => {
              wrapper.waitMe('hide');
          }, 1500);

      });
   };

    load_cart();
});

