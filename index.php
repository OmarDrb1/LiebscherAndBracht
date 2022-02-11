<?php
require_once('src/Address.php');
require_once('src/AddressActions.php');
require_once('src/User.php');
require_once('src/UserActions.php');
require_once('src/DBConnection.php');

if ($_POST){
    $vorname = @$_POST["vorname"];
    $nachname = @$_POST["nachname"];
    $strasse = @$_POST["strasse"];
    $hausnummer = @$_POST["hausnummer"];
    $postleitzahl = @$_POST["postleitzahl"];
    $ort = @$_POST["ort"];
    $telefon = @$_POST["telefon"];
    $email = @$_POST["email"];
    $beschreibung = @$_POST["beschreibung"];

    try {
        $dbConnection = DbConnection::getInstance();

        $address = new Address($strasse, $hausnummer);
        $address->setPostleitzahl($postleitzahl)->setOrt($ort);
        // print_r($address->getAddressDataArray());

        $user = new User($vorname, $nachname, $email);
        $user->setTelefon($telefon)->setBeschreibung($beschreibung)->setAnschrift($address);
        // print_r($user->getUserDataArray());

        $UserActions = new UserActions($user);
        $UserActions->addToDB($dbConnection);
        echo "User added successfully";

    } catch (\Throwable $error) {
        echo $error->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liebscher & Bracht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1>New User Form</h1>
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    <form action="?" method="post" style="width:500px;margin:30px">
        <div class="mb-3">
            <label class="form-label">Vorname</label>
            <input type="text" name="vorname" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nachname</label>
            <input type="text" name="nachname" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Straße</label>
            <input type="text" name="strasse" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Hausnummer</label>
            <input type="text" name="hausnummer" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Postleitzahl</label>
            <input type="text" name="postleitzahl" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Ort</label>
            <input type="text" name="ort" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Telefon</label>
            <input type="text" name="telefon" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Beschreibung</label>
            <input type="text" name="beschreibung" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>