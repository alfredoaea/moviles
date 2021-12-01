$(document).ready(function()
{
  //cargar el carro
   function load_cart()
   {
       var load_wrapper = $('#load_wrapper'),
       wrapper = $('#cart_wrapper'),
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
              load_wrapper.waitMe();
          }

      }).done(function(res){

        if(res.estatus === 200)
        {
            setTimeout(() =>{
            wrapper.html(res.data);
            load_wrapper.waitMe('hide');
        }, 2000);
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
        cantidad = $(this).data('cantidad'),
        action = 'post';

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data:
            {
                action,
                id,
                cantidad
            },
            beforeSend: function()
            {
                console.log('Agregando....');
            }
        
        }).done(function(res) {
            if(res.estatus === 201)
            {
                swal.fire('!Bien Hecho!', 'Producto Agregado al Carrito','success');
                load_cart();
                return;
            }
            else
            {
                swal.fire('Upss!',res.msg,'error');
                return;
            }

        }).fail(function(err) {

        }).always(function() {

        });
    });
});

