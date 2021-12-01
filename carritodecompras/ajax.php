<?php
require_once 'app/config.php';
//respuesta que regresa a ajax


//funcion para sacar un json en pantalla
//echo json_encode($response);

//que tipo de peticion esta solicitando ajax
if(!isset($_POST['action']))
{
     http_response_code(403);
     echo json_encode(['estatus' => 403]);
     die;
}

//GET

$action = $_POST['action'];

switch($action)
{
     case 'get':
          $cart = get_cart();
          $output = '';
          if(!empty($cart['products']))
          {
               $output .= '
               <div class="table-responsive">
                    <table class="table table-hover table-striperd table-sm">
                         <thead>
                         <tr>
                         <th>Producto</th>
                         <th class="text-center">Precio</th>
                         <th class="text-center">Cantidad</th>
                         <th class="text-right">Total</th>
                         <th class="text-right"></th>
                         </tr>
                         </thead>
                    <tbody>';
                    foreach($cart['products'] as $p)
                    {
                         $output .=
                         '<tr>
                              <td class="align-middle" width="25%">
                              <span class="d-block text-truncate">'.$p['nombre'].'</span>
                                   <small class="d-block text-muted">'.$p['sku'].'</small>
                              </td>
                              <td class="align-middle text-center">'.format_currency($p['precio']).'</td>
                              <td class="align-middle text-center" width="5%">
                                   <input type="number" min="0" max="50" class="form-control form-control-sm" value="'.$p['cantidad'].'">
                              </td>
                              <td class="align-middle text-right">'.format_currency(floatval($p['cantidad'] * $p['precio'])).'</td>
                              <td class="text-right align-middle"><i class="fas fa-times text-danger"></i></td>
                         </tr>';
                    }
                    
                    $output .= 
                    '</tbody>     
                    </table>
               </div>
               <button class="btn btn-sm btn-danger">Vaciar Carrito</button>';
          }else
          {
               $output.= '
               <div class="text-center py-5">
               <img src="'.IMAGES.'empty-cart.png'.'" title="no hay productos" class="img-fluid mb-3" style="width: 80px;">
               <p class="text-muted">No hay Productos en el Carrito</p>
               </div>';
          }
          
          $output .='
        <br><br>

        <div class="container-fluid">
          <table class="table">
            <tr>
              <th>Subtotal</th>
              <td class="text-success text-end">'.format_currency($cart['cart_totals']['subtotal']) .'</td>
              <tr>
                <th>Envio</th>
                <td class="text-success text-end">'.format_currency($cart['cart_totals']['shipment']) .'</td>
              </tr>
              <tr>
                <th>Total</th>
                <td class="text-success text-end"><h3 class="font-weight-bold">'.format_currency($cart['cart_totals']['total']) .'</h3></td>
              </tr>
              </tr>
          </table>
               <button type="button" class="btn btn-info col-12" disabled>Pagar Ahora</button>
        </div>';

          json_output(200, 'ok' , $output);
          break;
}
?>