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



if($client->deleteClientById()){

 echo json_encode("Client supprimé");
    } else{
        echo json_encode("Erreur lors de la suppression du client");
    }
?>