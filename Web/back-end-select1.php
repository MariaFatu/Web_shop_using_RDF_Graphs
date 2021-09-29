<?php
require 'vendor/autoload.php';
header('Content-type:application/json');
$client2=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");

$interogare ="prefix : <http://maria.ro#> SELECT ?id {?id a :Categorie}";
$rezultate = $client2->query($interogare); 
$date = array();
foreach ($rezultate as $rezultat)
{
    array_push($date, array('id'=>''.$rezultat->id));
} 
echo json_encode($date);

?> 