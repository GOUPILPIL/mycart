<?php

require __DIR__.'/models/Product.php';
require __DIR__.'/models/Basket.php';

$data = Basket::getInstance();
$products = Product::readAll();

if(isset($_POST["submit"]))
{
    $data->addtobakset($_POST["submit"], 1);
    header("Location: index.php");
    
}if(isset($_POST["delete"]))
{
    $data->removefrombasket($_POST["delete"], 1);
    header("Location: index.php");
}if(isset($_post["pushtobasket"]))
{
        $returnid = $data->pushbaskettobdd();
        echo $returnid;
}
if($_SESSION)
{
    foreach($_SESSION['cart'] as $element)
    {
        if(isset($element['id']))
        {
            echo $element['id'];
        }
        else
        {
            echo 'bug';
        }
        echo '  ';
        if(isset($element['num']))
        {
            echo $element['num'];
        }
        else
        {
            echo 'bug';
        }
        echo '<br>';
    }
var_dump($_SESSION['cart']);
}
$test = $data->baskettobdd();
$mdr = $data->bddtobasket($test);
echo '<br> <br>';
var_dump($mdr);
//echo $test;
// + 1 / 1, + 2 / 1, - 1 / -1, +1 / +1, -1 /-1, +1 / +1 bug / 1
//$data->destroy();

require __DIR__.'/views/products/browse.php';

