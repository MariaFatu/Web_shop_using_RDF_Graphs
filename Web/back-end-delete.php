<?php
require 'vendor/autoload.php';
header('Content-type:text/plain');
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen/statements");

$interogare = 'prefix : <http://maria.ro#> 
            DELETE 
            {<http://maria.ro#'.$_GET['id'].'>  a  :Produs;
            :denumire ?denumire;
            :pret ?pret;
            :Categorie ?categorie.
                }
            WHERE{
                <http://maria.ro#'.$_GET['id'].'>  a  :Produs;
            :denumire ?denumire;
            :pret ?pret;
            :Categorie ?categorie.
            }
            ';

print $client->update($interogare)->getStatus();
?>