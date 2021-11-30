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
                      <button class="btn btn-sm btn-success" data-toggle="tooltip" title="Agregar al Carrito"><i class="fas fa-plus"></i> Agregar al Carrito</button>
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
                <div div class="table-responsive">
                  <table class="table table-hover table-striperd table-sm">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Total</th>
                        <th class="text-right"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="align-middle">Producto 1
                          <small class="d-block text-muted">sku 123456789</small>
                        </td>
                        <td class="align-middle text-center" width="5%">
                          <input type="number" min="0" max="50" value="1" class="form-control form-control-sm">
                        </td>
                        <td class="align-middle text-center"> $150.00</td>
                        <td class="text-right align-middle"><i class="fas fa-times text-danger"></i></td>
                      </tr>
                      <tr>
                        <td class="align-middle">Producto 2
                          <small class="d-block text-muted">sku 123456789</small>
                        </td>
                        <td class="align-middle text-center" width="5%">
                          <input type="number" min="0" max="50" value="1" class="form-control form-control-sm">
                        </td>
                        <td class="align-middle text-center"> $250.00</td>
                        <td class="text-right align-middle"><i class="fas fa-times text-danger"></i></td>
                      </tr>
                      <tr>
                        <td class="align-middle">Producto 3
                          <small class="d-block text-muted">sku 123456789</small>
                        </td>
                        <td class="align-middle text-center" width="5%">
                          <input type="number" min="0" max="50" value="1" class="form-control form-control-sm">
                        </td>
                        <td class="align-middle text-center"> $350.00</td>
                        <td class="text-right align-middle"><i class="fas fa-times text-danger"></i></td>
                      </tr>
                    </tbody>     
                  </table>
                </div>
                <button class="btn btn-sm btn-danger">Vaciar Carrito</button>
                <br><br>

                <div class="container-fluid">
                  <table class="table">
                    <tr>
                      <th>Subtotal</th>
                      <td class="text-success text-end">$250</td>
                      <tr>
                        <th>Envio</th>
                        <td class="text-success text-end">$<?php echo SHIPPING_COST ?></td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td class="text-success text-end"><h3 class="font-weight-bold">$300</h3></td>
                      </tr>
                      </tr>
                  </table>
                  <button type="button" class="btn btn-info col-12">Pagar Ahora</button>
                </div>
          </div>         
        <!--</div>-->
      </div>
      </div>
    

<?php require_once 'includes/inc_footer.php'?>

