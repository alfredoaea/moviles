<?php
function get_products() //se renderiza vista  de los productos
{
    $products = require APP.'products.php';
    return $products;
}

function get_product_by_id($id) //reutilizando la funcion para reconocer el id
{
    $products = get_products();
    foreach($products as $i => $v)
    {
        if ($v['id'] === $id) 
        {
            return $products[$i];
        }
    }
    return false;
}

function render_view($view, $data = []) //se renderiza vista del carrito
{
   if(!is_file(VIEWS.$view.'.php'))
   {
    echo 'no exite la vista '. $view;
    die;
   }

   require_once VIEWS.$view. '.php';
}

function format_currency($number, $symbol = '$') //funcion para darle formato al precio
{
    if(!is_float($number) && !is_integer($number))
    {
        $number = 0;
    }
    return $symbol.number_format($number,2,'.',',');
}

//-----------------------------------------------
//
// FUNCIONES DEL CARRITO
//
//-----------------------------------------------

function get_cart()
{
//products,ID,SKU,IMAGEN,NOMBRE,PRECIO,CANTIDAD,total del producto,subtotal,shipment, total,payment url

    if (isset($_SESSION['cart'])) 
    {
        return $_SESSION['cart'];
    }


    $cart =
    [
        'products' => [],
        'total_products' => 0,
        'subtotal' => 0,
        'shipment' => 0,
        'total' => 0,
        'payment_url' => null
    ];

    $_SESSION['cart'] = $cart;
    return $_SESSION['cart'];

}

function json_output($estatus = 200, $msg = '', $data = [])
{
    http_response_code($estatus);
    $r =
    [
        'estatus' => $estatus,
        'msg' => $msg,
        'data' => $data
    ];
    echo json_encode($r);
    die;
}