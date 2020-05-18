<?php
class Client{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "SOLVY_IDENTITES";

    // table columns
	public $idClient;
    public $typeClient;
    public $nomClient;
    public $prenomClient;
    public $dateNaissance;
    public $villeNaissance;
    public $paysNaissance;
    public $villeResidence;
    public $paysResidence;
    public $adresseClient;
    public $codePostal;
    public $telephone;
    public $secteurActivite;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
    }
    //R
    public function findAll(){
        $query = "SELECT
					  client.IDENTIFIANT_CLIENT
					, client.TYPE_CLIENT
					, client.NOM_CLIENT
					, client.PRENOM_CLIENT
					, client.DATE_NAISSANCE
					, client.VILLE_NAISSANCE
					, client.PAYS_NAISSANCE
					, client.VILLE_RESIDENCE
					, client.PAYS_RESIDENCE
					, client.ADRESSE_CLIENT
					, client.CODE_POSTAL
					, client.TELEPHONE
					, client.SECTEUR_ACTIVITE
				FROM " . $this->table_name . " client";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    
	

    // READ single
    public function getClientById(){
          $sqlQuery = "SELECT                       
					  client.IDENTIFIANT_CLIENT
					, client.TYPE_CLIENT
					, client.NOM_CLIENT
					, client.PRENOM_CLIENT
					, client.DATE_NAISSANCE
					, client.VILLE_NAISSANCE
					, client.PAYS_NAISSANCE
					, client.VILLE_RESIDENCE
					, client.PAYS_RESIDENCE
					, client.ADRESSE_CLIENT
					, client.CODE_POSTAL
					, client.TELEPHONE
					, client.SECTEUR_ACTIVITE
                    	FROM ". $this->table_name ." client
                  	WHERE  client.Identifiant_Client = ?";

        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idClient);			
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
        $this->idClient= $dataRow['IDENTIFIANT_CLIENT'] ;
		$this->typeClient= $dataRow['TYPE_CLIENT'] ;
		$this->nomClient= $dataRow['NOM_CLIENT'] ;
		$this->prenomClient= $dataRow['PRENOM_CLIENT'] ;
		$this->dateNaissance= $dataRow['DATE_NAISSANCE'] ;
		$this->villeNaissance= $dataRow['VILLE_NAISSANCE'] ;
		$this->paysNaissance= $dataRow['PAYS_NAISSANCE'] ;
		$this->villeResidence= $dataRow['VILLE_RESIDENCE'] ;
		$this->paysResidence= $dataRow['PAYS_RESIDENCE'] ;
		$this->adresseClient= $dataRow['ADRESSE_CLIENT'] ;
		$this->codePostal= $dataRow['CODE_POSTAL'] ;
		$this->telephone= $dataRow['TELEPHONE'] ;
		$this->secteurActivite= $dataRow['SECTEUR_ACTIVITE'] ;
        }        

	// CREATE
    public function createClient(){
        $sqlQuery = "INSERT INTO ". $this->table_name ."
                    	SET                        
						TYPE_CLIENT=:type ,
						NOM_CLIENT=:nom ,
						PRENOM_CLIENT=:prenom ,
						DATE_NAISSANCE=:dtNais ,
						VILLE_NAISSANCE=:villeNAis ,
						PAYS_NAISSANCE=:paysNais ,
						VILLE_RESIDENCE=:villeResi ,
						PAYS_RESIDENCE=:paysResi ,
						ADRESSE_CLIENT=:adrs ,
						CODE_POSTAL=:cp ,
						TELEPHONE=:tel ,
						SECTEUR_ACTIVITE=:activite ";
        
        $stmt = $this->connection->prepare($sqlQuery);
        
        // sanitize        
        $this->typeClient=htmlspecialchars(strip_tags($this->typeClient));
		$this->nomClient=htmlspecialchars(strip_tags($this->nomClient));
        $this->prenomClient=htmlspecialchars(strip_tags($this->prenomClient));
		$this->dateNaissance=htmlspecialchars(strip_tags($this->dateNaissance));
		$this->villeNaissance=htmlspecialchars(strip_tags($this->villeNaissance));
		$this->paysNaissance=htmlspecialchars(strip_tags($this->paysNaissance));
		$this->villeResidence=htmlspecialchars(strip_tags($this->villeResidence));
        $this->paysResidence=htmlspecialchars(strip_tags($this->paysResidence));
		$this->adresseClient=htmlspecialchars(strip_tags($this->adresseClient));
		$this->codePostal=htmlspecialchars(strip_tags($this->codePostal));
		$this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->secteurActivite=htmlspecialchars(strip_tags($this->secteurActivite));
        
        // bind data
        $stmt->bindParam(":type", $this->typeClient);
        $stmt->bindParam(":nom", $this->nomClient);
        $stmt->bindParam(":prenom", $this->prenomClient);
        $stmt->bindParam(":dtNais", $this->dateNaissance);
        $stmt->bindParam(":villeNAis", $this->villeNaissance);
		$stmt->bindParam(":paysNais", $this->paysNaissance);
        $stmt->bindParam(":villeResi", $this->villeResidence);
        $stmt->bindParam(":paysResi", $this->paysResidence);
        $stmt->bindParam(":adrs", $this->adresseClient);
        $stmt->bindParam(":cp", $this->codePostal);
		$stmt->bindParam(":tel", $this->telephone);
        $stmt->bindParam(":activite", $this->secteurActivite);
        
        if($stmt->execute()){
        	return true;
        }
        
		return false;
	}
	
   

        // DELETE
        function deleteClientById(){
            $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->connection->prepare($sqlQuery);
        
            $this->idClient=htmlspecialchars(strip_tags($this->idClient));
        
            $stmt->bindParam(1, $this->idClient);
        
            if($stmt->execute()){
                return true;
            }
			
            return false;
        }

    }
?>