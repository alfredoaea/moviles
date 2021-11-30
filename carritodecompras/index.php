<?php 
require_once 'app/config.php';

$data =
[
    'title' => 'Bienvenido al Carrito',
    'products' => get_products()
];



render_view('carrito_view', $data);