<?php
require 'vendor/autoload.php';
header('Content-type:application/json');
$client2=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");

$date = array();
 $interogare = 'prefix : <http://maria.ro#> 
                SELECT ?id ?denumire ?pret
                {?id  a  :Produs;
                 :denumire ?denumire;
                 :pret ?pret;
                 :Categorie :'.$_GET['id'].' .
                }';

$rezultate = $client2->query($interogare);
foreach ($rezultate as $rezultat)
{
    array_push($date, array('id'=>''.$rezultat->id, 'denumire'=>''.$rezultat->denumire, 'pret'=>''.$rezultat->pret));
} 
echo json_encode($date);
                
?>