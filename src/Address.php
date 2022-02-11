<?php
class Address
{
    private $strasse, $hausnummer, $postleitzahl, $ort;

    function __construct(String $strasse, String $hausnummer)
    {
        if (!$strasse || !$hausnummer) {
            throw new Exception("Strasse and hausnummer must be filled", 1);
        }
        $this->strasse = $strasse;
        $this->hausnummer = $hausnummer;
    }
    
    public function setPostleitzahl(String $postleitzahl)
    {
        $this->postleitzahl = $postleitzahl;
        return $this;
    }

    public function setOrt(String $ort)
    {
        $this->ort = $ort;
        return $this;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
    }

    public function getAddressDataArray()
    {
        return [
            "strasse" => $this->strasse,
            "hausnummer" => $this->hausnummer,
            "postleitzahl" => $this->postleitzahl,
            "ort" => $this->ort
        ];
    }
}

// $address = new Address("addroess", "1");
// $address->setPostleitzahl("01234")->setOrt("Lola");
// echo $address->strasse;
// print_r($address->getAddressDataArray());
