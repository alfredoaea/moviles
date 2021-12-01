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
        if (intval($v['id']) === (int)$id) 
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
        $_SESSION['cart']['cart_totals'] = calculate_cart_totals();
        return $_SESSION['cart'];
    }


    $cart =
    [
        'products' => [],
        'cart_totals' => calculate_cart_totals(),
        'payment_url' => null
    ];

    $_SESSION['cart'] = $cart;
    return $_SESSION['cart'];

}

function calculate_cart_totals()
{
    //si el carro so existe se inicializa
    //si no hay productos aun pero el carrito si existe ya
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart']['products']))
    {
        $cart_totals =
    [
        
        'subtotal' => 0,
        'shipment' => 0,
        'total' => 0
        
    ];
    
    return $cart_totals;

    }

    //calcular los totales segun los productos en carrito
    $subtotal = 0;
    $shipment = SHIPPING_COST;
    $total = 0;

    //si ya hay productos hay que sumar las cantidades
    foreach($_SESSION['cart']['products'] as $p)
    {
        $_total = floatval($p['cantidad'] * $p['precio']);
        $subtotal = floatval($subtotal + $_total);
    }

    $total = floatval($subtotal + $shipment);
    $cart_totals = 
    [
        
        'subtotal' => $subtotal,
        'shipment' => $shipment,
        'total' => $total
        
    ];

    return $cart_totals;
}

function add_to_cart($id_producto, $cantidad = 1)
{
    $new_product =
    [
        'id' => NULL,
        'sku' => NULL,
        'nombre' => NULL,
        'cantidad' => NULL,
        'precio' => NULL,
        'imagen' => NULL
    ];
    
    $product = get_product_by_id($id_producto);
    //algp paso o no existe el producto
    if (!$product) 
    {
        return false;
    }

    $new_product =
    [
        'id' => $product['id'],
        'sku' => $product['sku'],
        'nombre' => $product['nombre'],
        'cantidad' => $cantidad,
        'precio' => $product['precio'],
        'imagen' => $product['imagen']
    ];

    //si no existe el carro, es ocvio que no existe el producto
    // entoncew lo agregamos directamente
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart']['products']))
    {
        $_SESSION['cart']['products'][] = $new_product;
    return true;

    }

    // si se agrega pero vamos primero a loopear en el array de todos los productos
    // para buscar uno con el mismo id si existe
    foreach($_SESSION['cart']['products'] as $i => $p)
    {
        if($id_producto === $p['id'])
        {
            $_cantidad = $p['cantidad'] + $cantidad;
            $p['cantidad'] = $_cantidad;
            $_SESSION['cart']['products'][$i] = $p;
            return true;
        }
    }

    $_SESSION['cart']['products'][] = $new_product;
    return true;

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