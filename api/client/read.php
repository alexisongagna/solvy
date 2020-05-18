<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/dbclass.php';
include_once '../class/client.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$client = new Client($connection);

$stmt = $client->findAll();
$count = $stmt->rowCount();

//echo json_encode($count); 

if($count > 0){

    $clients = array();
    $clients["body"] = array();
    $clients["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $p  = array(
              "id" => $IDENTIFIANT_CLIENT,
              "typeClient" => $TYPE_CLIENT,
              "nomClient" => $NOM_CLIENT,
              "prenomClient" => $PRENOM_CLIENT,
              "dateNaissance" => $DATE_NAISSANCE,
              "villeNaissance" => $VILLE_NAISSANCE,
              "paysNaissance" => $PAYS_NAISSANCE,
              "villeResidence" => $VILLE_RESIDENCE,
              "paysResidence" => $PAYS_RESIDENCE,
              "adresseClient" => $ADRESSE_CLIENT,
              "codePostal" => $CODE_POSTAL,
              "telephone" => $TELEPHONE,
              "secteurActivite" => $SECTEUR_ACTIVITE
        );

        array_push($clients["body"], $p);    
		
    }

    echo json_encode($clients);
}

else {

    echo json_encode(
        array("body" => array(), "count" => 0)
    );
}
?>