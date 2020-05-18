<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/dbclass.php';
include_once '../class/client.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$client = new Client($connection);

$_POST = json_decode(file_get_contents('php://input'), true);

echo json_encode($_POST); 

$client->typeClient = $_POST['typeClient'] ;
$client->nomClient  = $_POST['nomClient'] ;
$client->prenomClient = $_POST['prenomClient'] ;
$client->dateNaissance = $_POST['dateNaissance'] ;
$client->villeNaissance = $_POST['villeNaissance'] ;
$client->paysNaissance = $_POST['paysNaissance'] ;
$client->villeResidence = $_POST['villeResidence'] ;
$client->paysResidence = $_POST['paysResidence'] ;
$client->adresseClient = $_POST['adresseClient'] ;
$client->codePostal = $_POST['codePostal'] ;
$client->telephone = $_POST['telephone'] ;
$client->secteurActivite = $_POST['secteurActivite'] ;

if($client->createClient()){
        echo 'Client crée avec.';
    } else{
        echo 'Erreur lors de la création du client';
    }
?>