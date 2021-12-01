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
        else
        {
            swal.fire('Upss!','Ocurrio un error','error');
            wrapper.html('!Intenta de nuevo, por favor!');
            return true;
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

    //agregar al carro al dar click en el boton
    //actualizar la cantidad del carro si el producto ya existe dentro
    $('.do_add_to_cart').on('click', function(event)
    {
        //pueden utilizar para prevenir alguna accion
        //submit / redireccion
        event.preventDefault();
        var id = $(this).data('id'),
        action = 'post';

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data:
            {
                action,
                id
            },
            beforeSend: function()
            {
                console.log('Agregando....');
            }
        
        }).done(function(res) {

        }).fail(function(err) {

        }).always(function() {

        });
    });
});

