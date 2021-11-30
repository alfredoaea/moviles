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
               <button class="btn btn-sm btn-danger">Vaciar Carrito</button>';
          }else
          {
               $output.= 'No hay Productos en el Carrito';
          }
          
          $output .='
        <br><br>

        <div class="container-fluid">
          <table class="table">
            <tr>
              <th>Subtotal</th>
              <td class="text-success text-end">'.format_currency($cart['subtotal']) .'</td>
              <tr>
                <th>Envio</th>
                <td class="text-success text-end">'.format_currency($cart['shipment']) .'</td>
              </tr>
              <tr>
                <th>Total</th>
                <td class="text-success text-end"><h3 class="font-weight-bold">'.format_currency($cart['total']) .'</h3></td>
              </tr>
              </tr>
          </table>
               <button type="button" class="btn btn-info col-12" disabled>Pagar Ahora</button>
        </div>';

          json_output(200, 'ok' , $output);
          break;
}
?>