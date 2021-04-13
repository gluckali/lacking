<?php
include "./database/database.php";
$db = new database();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $customerCreateSql = "INSERT INTO `klanten`(`naam`, `telefoon`, `email`) VALUES (:naam,:telefoon,:email)";

    $customerPlaceholder = [ 
        'naam'=>$_POST['customerName'],
        'email'=>$_POST['customerEmail'],
        'telefoon'=>$_POST['customerPhonenumber']
    ];

    $customerId = $db->addAndGetLastId($customerCreateSql, $customerPlaceholder);
    print_r($customerId);

    $reservationCreateSql = 'INSERT INTO `reservering`(`tafel`, `datum`, `tijd`, `klant_id`, `aantal`, `status`, `datum_toegevoegd`, `aantal_k`, `allergieen`, `opmerking`)
    VALUES
    (:tafel, :datum, :tijd, :klant_id, :aantal, :status, :datum_toegevoegd, :aantal_k, :allergieen, :opmerking)';

    $reservationCreatePlaceholder = [
        'klant_id'=>$customerId,
        'tafel'=>$_POST['tafel'],
        'datum'=>$_POST['datum'],
        'tijd'=>$_POST['tijd'],
        'aantal'=>$_POST['aantal'],
        'status'=>$_POST['status'],
        'datum_toegevoegd'=>date("Y/m/d"),
        'aantal_k'=>$_POST['aantal_k'],
        'allergieen'=>$_POST['allergieen'],
        'opmerking'=>$_POST['opmerking']
    ];
    
    $db->add($reservationCreateSql ,$reservationCreatePlaceholder);

    print('is the id of the klant!');
}

?>

<form action="" method="post">
    <h2>Customer</h2>

    <input type="text" name='customerName' required>
    <br>
    <input type="email" name='customerEmail' required>
    <br>
    <input type="tel" name='customerPhonenumber' required>

    <h2>Reservation</h2>  
    <input type="date" name='datum' placeholder="datum" required>
    <input type="text" name='tafel' placeholder="tafel" required>
    <br>
    <input type="time" name='tijd' placeholder="tijd" required>
    <input type="number" name='aantal'  placeholder="aantal mensen" required>
    <br>
    <input type="text" name='status'  placeholder="status" required>
    <br>
    <input type="number" name='aantal_k' placeholder="aantal_k" required>
    <br>
    <input type="text" name='allergieen' placeholder="allergieen" >
    <br>
    <input type="text" name='opmerking' placeholder="opmerking" >
    
    <button>Add Reservation</button>
</form>