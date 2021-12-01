<?php require_once 'includes/inc_header.php'?>

<?php require_once 'includes/inc_buscador.php'?>
  
    <!--contenido del sitio-->
      <div class="container-fluid py-5">
        <div class="row">
          <div class="col-xl-8">
            <h1>Productos</h1>
            <div class="row">
              <?php foreach($data['products'] as $p): ?> <!--loop de imagenes -->
                <div class="col-3 mb-3">
                  <div class="card">
                    <img src="<?php echo IMAGES.$p['imagen']; ?>" alt="<?php echo $p['nombre']; ?>" class="card-img-top">
                    <div class="card-body p-2">
                      <h5 class="card-title text-truncate"><?php echo $p['nombre'] ?></h5>
                      <p class="text-success"><?php echo format_currency($p['precio']); ?></p>
                      <button class="btn btn-sm btn-success do_add_to_cart" data-toggle="tooltip" data-id="<?php echo $p['id'] ?>" title="Agregar al Carrito"><i class="fas fa-plus"></i> Agregar al Carrito</button>
                    </div>
                  </div>
                </div>  
              <?php endforeach; ?>
            </div>
          </div>

          <!--contenido del carrito-->
          <div class="col-xl-4 bg-light">
            <h1>Carrito</h1>
          <!-- contenido del carro -->  
          <div id="cart_wrapper">
          </div>         
        <!--</div>-->
      </div>
      </div>
    

<?php require_once 'includes/inc_footer.php'?>

