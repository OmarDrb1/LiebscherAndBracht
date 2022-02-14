<?php
require_once('Address.php');
require_once('AddressActions.php');
require_once('User.php');
require_once('DBConnection.php');

class UserActions
{
    private $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function addToDB(DbConnection $dbConnection)
    {
        // $conn = $dbConnection->getConnection();

        $vorname = $this->user->vorname;
        $nachname = $this->user->nachname;
        $email = $this->user->email;
        $telefon = $this->user->telefon;
        $anschrift = $this->user->anschrift;
        $beschreibung = $this->user->beschreibung;

        if ($anschrift) {
            $addressActions = new AddressActions($anschrift);
            $addressId = $addressActions->addToDB($dbConnection);
        } else
            $addressId = null;

        $sql = "INSERT INTO users (vorname, nachname, email, telefon, beschreibung, address_id, add_date) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $type = "sssssi";
        $rows = [$vorname, $nachname, $email, $telefon, $beschreibung, $addressId];

        try {
            $last_id = $dbConnection->insertToDB($sql, $type, $rows);
            return $last_id;
        } catch (\Throwable $th) {
            throw new Exception("Error occurred while adding user", 1);
        }
    }
}

// try {
//     $dbConnection = DbConnection::getInstance();

//     $address = new Address("address", "1");
//     $address->setPostleitzahl("01234")->setOrt("Lola");

//     $user = new User("Omar", "Diar", "oa@s.com");
//     $user->setTelefon("01234")->setBeschreibung("Some text")->setAnschrift($address);

//     $UserActions = new UserActions($user);
//     $UserActions->addToDB($dbConnection);
// } catch (\Throwable $error) {
//     echo $error->getMessage();
// }