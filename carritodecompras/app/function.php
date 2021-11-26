<?php
function get_products()
{
    $products = require_once APP.'products.php';
    return $products;
}

function render_view($view, $data = [])
{
   if(!is_file(VIEWS.$view.'.php'))
   {
    echo 'no exite la vista '. $view;
    die;
   }

   require_once VIEWS.$view. '.php';
}