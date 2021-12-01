<?php 
require_once 'app/config.php';

$data =
[
    'title' => 'Bienvenido al Carrito',
    'products' => get_products()
];


//session_destroy();
//add_to_cart(3);

render_view('carrito_view', $data);