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


        //console.log($(this).data('cantidad'));

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
    

    $('body').on('click', '.do_destroy_cart', destroy_cart);
    function destroy_cart(event)
    {
        var action = 'destroy',
        confirmation;

        confirmation = confirm('Estas seguro?');

        if(!confirmation) return;

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data:
            {
              action
            },
  
        }).done(function(res){
            if(res.estatus === 200)
            {
                swal.fire('Carrito Borrado con Exito!');
                load_cart();
                return;
            }
  
        }).fail(function(err){
  
              swal.fire('Upss!','Hubo un Error, Intenta de Nuevo','error');
              return false;
  
        }).always(function(){
  
        });
    }

    //borrar elemento del carro
    $('body').on('click', '.do_delete_from_cart', delete_from_cart);
    function delete_from_cart(event)
    {
        var confirmation,
        id = $(this).data('id'),
        action = 'delete';

        confirmation = confirm('Estas Seguro?');

        if(!confirmation) return;

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data:
            {
              action,
              id
            },
  
        }).done(function(res){
            if(res.estatus === 200)
            {
                swal.fire('Elemento Borrado con Exito!');
                load_cart();
                return;
            }
            else
            {
                swal.fire('upss!', res.msg,'error');
                return;
            }
  
        }).fail(function(err){
              swal.fire('Upss!','Hubo un Error, Intenta de Nuevo','error');
        }).always(function(){
  
        });


    }
});

