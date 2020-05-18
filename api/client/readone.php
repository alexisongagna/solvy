<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/dbclass.php';
include_once '../class/client.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$client = new Client($connection);

$client->idClient = isset($_GET['id']) ? $_GET['id'] : die();



$stmt = $client->getClientById();

if($client->nomClient != null){
        // create array
        $p  = array(
              "id"             => $client->idClient,
              "typeClient"     => $client->typeClient,
              "nomClient"      => $client->nomClient,
              "prenomClient"   => $client->prenomClient,
              "dateNaissance"  => $client->dateNaissance,
              "villeNaissance" => $client->villeNaissance,
              "paysNaissance"  => $client->paysNaissance,
              "villeResidence" => $client->villeResidence,
              "paysResidence"  => $client->paysResidence,
              "adresseClient"  => $client->adresseClient,
              "codePostal"     => $client->codePostal,
              "telephone"      => $client->telephone,
              "secteurActivite"=> $client->secteurActivite
        );
      
        http_response_code(200);
        echo json_encode($p);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>