
<?php
require 'vendor/autoload.php';
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen/statements");
$client_ask=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");

   

// QueryString e deserializat automat in $_GET
$interogare_ask = "prefix : <http://maria.ro#>
ASK{?x :denumire '".$_POST["denumire"]."'}";
//print $_POST["denumire"];
$raspuns = $client_ask->query($interogare_ask);
print $raspuns->getBoolean();

if($raspuns->getBoolean()){

$interogare_insert = "prefix : <http://maria.ro#>
                        INSERT
                        {?URInou a :Produs;
                        :denumire '".$_POST["denumire"]."';
                        :pret ".$_POST["pret"].";
                        :Categorie ?cat}
                        WHERE
                        {
                        {
                        SELECT (MAX(xsd:integer((STRAFTER(STR(?x),'_')))+1) AS ?nr)
                        WHERE {?x a :Produs.}
                        }
                        BIND(IRI(CONCAT('http://maria.ro#".trim(str_replace(" ","",$_POST["denumire"]))."_',STR(?nr))) AS ?URInou)
                        BIND(IRI('http://maria.ro#".$_POST["categorie"]."') AS ?cat)
                        }

";
}
else
    $interogare_insert = "prefix : <http://maria.ro#>
                        INSERT
                        {?URInou a :Produs;
                        :denumire '".$_POST["denumire"]."';
                        :pret ".$_POST["pret"].";
                        :Categorie ?cat}
                        WHERE
                        {
                        BIND(IRI(CONCAT('http://maria.ro#".$_POST["denumire"]."_',STR(1))) AS ?URInou)
                        BIND(IRI('http://maria.ro#".$_POST["categorie"]."') AS ?cat)
                        }
                        ";
// raspuns returnat in format default
print $client->update($interogare_insert)->getStatus(); 
     

?>