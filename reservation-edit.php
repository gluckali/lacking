<?php
include "./database/database.php";
$db = new database();


$reservationId = $_GET['reservationId'];

$reservation = $db->select('SELECT * FROM `reservering` WHERE id=:id', [
    'id'=> $reservationId 
]);


if($_SERVER['REQUEST_METHOD'] == "POST"){

    $reservationCreateSql = 'UPDATE `reservering` set (`tafel`, `datum`, `tijd`, `klant_id`, `aantal`, `status`, `aantal_k`, `allergieen`, `opmerking`)
    VALUES
    (:tafel, :datum, :tijd, :klant_id, :aantal, :status, :aantal_k, :allergieen, :opmerking) where id=:id';

    $reservationCreatePlaceholder = [
        'klant_id'=>$customerId,
        'tafel'=>$_POST['tafel'],
        'datum'=>$_POST['datum'],
        'tijd'=>$_POST['tijd'],
        'aantal'=>$_POST['aantal'],
        'status'=>$_POST['status'],
        'aantal_k'=>$_POST['aantal_k'],
        'allergieen'=>$_POST['allergieen'],
        'opmerking'=>$_POST['opmerking'],
        'id'=>$reservationId 
    ];
    
    $db->add($reservationCreateSql ,$reservationCreatePlaceholder);

    print('addeD!');
}

?>

<form action="" method="post">
    <h2>Customer</h2>


   <?php
    $customerInfo = $db->select('SELECT `id`, `naam`, `telefoon`, `email` FROM `klanten` WHERE id=:id', [
        'id'=>$reservation[0]['klant_id']
    ]);

    $name = $customerInfo[0]['naam'];
    $phoneNumber = $customerInfo[0]['telefoon'];
    $email = $customerInfo[0]['email'];

    echo "
        <b>Naam</b>: $name  </br>
        <b>Telefoon</b>: $phoneNumber </br>
        <b>email</b>: $email   </br>
    ";

    $customerId = $customerInfo[0]['id'];
    echo "<a href='./customer-edit.php?customerId=$customerId'> edit customer</a>";
   ?>

    <h2>Reservation</h2>  
    <input type="date" name='datum' placeholder="datum" required>
    
    <?php
        $tafel = $reservation[0]['tafel'];
        echo "<input type=text name='tafel' placeholder=tafel value=$tafel required>";
        $datum = $reservation[0]['datum'];
        echo "<input type=text name='datum' placeholder=datum value=$datum required>";
        $tijd = $reservation[0]['tijd'];
        echo "<input type=text name='tijd' placeholder=tijd value=$tijd required>";
        $aantal = $reservation[0]['aantal'];
        echo "<input type=text name='aantal' placeholder=aantal value=$aantal required>";
        $status = $reservation[0]['status'];
        echo "<input type=text name='status' placeholder=status value=$status required>";
        $aantal_k = $reservation[0]['aantal_k'];
        echo "<input type=text name='aantal_k' placeholder=aantal_k value=$aantal_k required>";
        $allergieen = $reservation[0]['allergieen'];
        echo "<input type=text name='allergieen' placeholder=allergieen value=$allergieen >";
        $opmerking = $reservation[0]['opmerking'];
        echo "<input type=text name='opmerking' placeholder=opmerking value=$opmerking >";
    ?>
    
    <button>edit Reservation</button>
</form>