<?php
require_once('Address.php');
require_once('DBConnection.php');

class AddressActions
{
    private $address;

    function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    public function addToDB(DbConnection $dbConnection)
    {
        $conn = $dbConnection->getConnection();

        $strasse = $this->address->strasse;
        $hausnummer = $this->address->hausnummer;
        $postleitzahl = $this->address->postleitzahl;
        $ort = $this->address->ort;

        $sql = "INSERT INTO addresses (strasse, hausnummer, postleitzahl, ort) 
            VALUES ('$strasse', '$hausnummer', '$postleitzahl', '$ort')";
        
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            return $last_id;
        } else {
            throw new Exception("Error occurred while adding address", 1);
            
        }
    }
}

// $address = new Address("address", "1");
// $address->setPostleitzahl("01234")->setOrt("Lola");
// print_r($address->getAddressDataArray());

// $dbConnection = DbConnection::getInstance();

// $addressActions = new AddressActions($address);
// echo $addressActions->addToDB($dbConnection);
