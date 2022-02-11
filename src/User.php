<?php
require_once('Address.php');

class User
{
    private $vorname, $nachname, $email, $telefon, $anschrift, $beschreibung;
    
    function __construct(String $vorname, String $nachname, String $email)
    {
        if (!$vorname || !$nachname || !$email) {
            throw new Exception("Vorname and Nachname and Email must be filled", 1);
        }
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->email = $this->validateEmail($email);
    }

    public function setTelefon(String $telefon)
    {
        $this->telefon = $this->validateTelefon($telefon);
        return $this;
    }

    public function setBeschreibung(String $beschreibung)
    {
        $this->beschreibung = $this->validateBeschreibung($beschreibung);
        return $this;
    }

    public function setAnschrift(Address $anschrift)
    {
        $this->anschrift = $anschrift;
        return $this;
    }

    public function validateEmail(String $email)
    {
        $regex = '/([a-zA-Z0-9_-]|(\\.[a-zA-Z0-9_-]+)+)+@[a-zA-Z0-9_-]+\\.(com|de|at)+/i';
        if (preg_match($regex, $email)) {
            return $email;
        } else {
            throw new Exception("The email is not valid", 1);
        }
    }

    public function validateTelefon(String $telefon)
    {
        if (preg_match('/^[0-9]+$/', $telefon)) {
            return $telefon;
        } else {
            throw new Exception("The telefon is not valid", 1);
        }
    }

    public function validateBeschreibung(String $beschreibung)
    {
        if (strlen($beschreibung) <= 300) {
            return $beschreibung;
        } else {
            throw new Exception("The description is so long", 1);
        }
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
    }
    
    public function getUserDataArray()
    {
        return [
            "vorname" => $this->vorname,
            "nachname" => $this->nachname,
            "email" => $this->email,
            "telefon" => $this->telefon,
            "anschrift" => (!is_null($this->anschrift))? $this->anschrift->getAddressDataArray(): [],
            "beschreibung" => $this->beschreibung
        ];
    }
}

// try {
//     $address = new Address("address", "");
//     $address->setPostleitzahl("01234")->setOrt("Lola");

//     $user = new User("Omar", "Diar", "oa@s.com");
//     $user->setTelefon("01234")->setBeschreibung("Some text")->setAnschrift($address);
//     print_r($user->getUserDataArray());
// } catch (\Throwable $error) {
//     echo $error->getMessage();
// }

